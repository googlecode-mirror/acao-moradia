<?php 
    echo "Data de início: " .date("d/m/Y")." ".date("H:i:s")."<br>";
    /*################################
     *### INSTALA O BANCO DE DADOS ###
     *################################*/
    require_once 'bd.php';
    $senha = new Senha();
    echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">";
    
    ########DADOS PARA CONEXÃO COM O MYSQL
    $server = "localhost";
    $database = "acao_moradia";
    $username = "root";		#alterar conforme seu usuário do banco de dados mysql()
    $password = $senha->getSenha();		#alterar conforme a senha de seu usuário do banco de dados mysql()

    $SQL = mysql_connect($server, $username, $password) or trigger_error(mysql_error(),E_USER_ERROR);	#se nao conectar, escreve uma msg de erro
    mysql_select_db($database, $SQL);	#seleciona o banco de dados para uso posterior


    #########Define o conjunto de caracteres que será usado
    mysql_query("SET NAMES 'utf8'");
    mysql_query('SET character_set_connection=utf8');
    mysql_query('SET character_set_client=utf8');
    mysql_query('SET character_set_results=utf8');
    mysql_query('SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO"');

    $charset = mysql_set_charset('utf8');

    ########CRIA O BANCO
    mysql_query('DROP DATABASE IF EXISTS acao_moradia');
    mysql_query('CREATE DATABASE acao_moradia');

    mysql_query('USE acao_moradia');

    #---------------------------------------------------CRIA AS TABELAS------------------------------------------------------

    mysql_query("
    -- -----------------------------------------------------
    -- Table `curso`
    -- -----------------------------------------------------
    CREATE  TABLE IF NOT EXISTS `curso` (
      `id_curso` INT NOT NULL AUTO_INCREMENT ,
      `nome` VARCHAR(100) NOT NULL ,	#upper
      `vagas` SMALLINT NOT NULL,
      `data_inicio` DATE NOT NULL ,
      `carga_horaria` FLOAT NULL ,
      `pre_requisitos` TEXT NULL ,  	#upper
      `seg` bool NOT NULL DEFAULT FALSE,
      `ter` bool NOT NULL DEFAULT FALSE,
      `qua` bool NOT NULL DEFAULT FALSE,
      `qui` bool NOT NULL DEFAULT FALSE,
      `sex` bool NOT NULL DEFAULT FALSE,
      `sab` bool NOT NULL DEFAULT FALSE,
      `dom` bool NOT NULL DEFAULT FALSE,
      `data_termino` DATE NOT NULL CHECK(`data_termino` >= `data_inicio`),
      PRIMARY KEY (`id_curso`) )
    ENGINE = InnoDB;
    ") or die(mysql_error());

    mysql_query("
    -- -----------------------------------------------------
    -- Table `bairro`
    -- -----------------------------------------------------
    CREATE  TABLE IF NOT EXISTS `bairro` (
      `nome` VARCHAR(100) NOT NULL ,	#upper
      PRIMARY KEY (`nome`) )
    ENGINE = InnoDB;
    ") or die(mysql_error());

    mysql_query("
    -- -----------------------------------------------------
    -- Table `estado`
    -- -----------------------------------------------------
    CREATE  TABLE IF NOT EXISTS `estado` (
      `cod_estado` INT(2) ,
      `sigla` VARCHAR(2) NOT NULL ,
      `nome` VARCHAR(100) ,
      PRIMARY KEY (`cod_estado`) )
    ENGINE = InnoDB;
    ") or die(mysql_error());
    
    mysql_query("
    -- -----------------------------------------------------
    -- Table `cidade`
    -- -----------------------------------------------------
    CREATE  TABLE IF NOT EXISTS `cidade` (
      `cod_cidade` INT(11) ,
      `nome` VARCHAR(100) NOT NULL ,	#upper
      `cep` VARCHAR(9) ,                #vai ser tirada esta coluna, ela é apenas para manter compatibilidade com as linhas              
      `cod_estado` INT(2) NOT NULL ,      
      CONSTRAINT `fk_estado`
        FOREIGN KEY (`cod_estado` )
        REFERENCES `estado` (`cod_estado` )
        ON DELETE NO ACTION
        ON UPDATE NO ACTION,
      PRIMARY KEY (`cod_cidade`) )
    ENGINE = InnoDB;
    ") or die(mysql_error());

    mysql_query("
    -- -----------------------------------------------------
    -- Table `familia`
    -- -----------------------------------------------------
    CREATE  TABLE IF NOT EXISTS `familia` (
      `id_familia` INT NOT NULL AUTO_INCREMENT ,
      `cep` VARCHAR(9) NOT NULL ,
      `logradouro` VARCHAR(100) NOT NULL ,			#upper
      `numero` INT UNSIGNED NOT NULL ,
      `bairro` VARCHAR(100) ,                                   #upper      
      `cod_cidade` INT(11) NOT NULL ,	
      INDEX `fk_Endereço_Bairro1_idx` (`bairro` ASC) ,      
      PRIMARY KEY (`id_familia`) ,
      CONSTRAINT `fk_Endereço_Bairro1`
        FOREIGN KEY (`bairro` )
        REFERENCES `bairro` (`nome` )
        ON DELETE NO ACTION
        ON UPDATE NO ACTION,
      CONSTRAINT `fk_Endereço_Cidade1`
        FOREIGN KEY (`cod_cidade` )
        REFERENCES `cidade` (`cod_cidade` )
        ON DELETE NO ACTION
        ON UPDATE NO ACTION)
    ENGINE = InnoDB;
    ") or die(mysql_error());

    mysql_query("
    -- -----------------------------------------------------
    -- Table `pessoa`
    -- -----------------------------------------------------
    CREATE  TABLE IF NOT EXISTS `pessoa` (
      `id_pessoa` INT NOT NULL AUTO_INCREMENT ,
      `id_familia` INT NOT NULL ,
      `cidade_natal` INT(11) ,
      `nome` VARCHAR(100) NOT NULL ,		#upper
      `cpf` VARCHAR(14) NULL UNIQUE,
      `rg` VARCHAR(45) NULL ,
      `sexo` CHAR CHECK(`sexo`IN('M','F')),	#upper
      `data_nascimento` DATE NULL ,
      `data_cadastro` DATE NULL ,
      `data_saida` TIMESTAMP NULL ,
      `last_modified` TIMESTAMP NULL,
      `telefone` VARCHAR(15) NULL ,
      `grau_parentesco` VARCHAR(45) NOT NULL CHECK(`grau_parentesco` IN('TITULAR','CÔNJUGE(MARIDO OU ESPOSA)','COMPANHEIRO(A)','FILHO(A)','IRMÃ(O)','PAI/MÃE','CUNHADO(A)','GENRO/NORA','SOGRO(A)','ENTEADO(A)','NETO(A)','PADRASTO/MADRASTA','AGREGADO(A)','AVÔ(Ó)','EX-COMPANHEIRO(A)','EX-MARIDO/EX-ESPOSA','PRIMO(A)','SOBRINHO(A)','TIO(A)')),	#upper
      `estado_civil` VARCHAR(45) NULL CHECK(`estado_civil` IN('SOLTEIRO(A)','CASADO(A)','SEPARADO(A)','DIVORCIADO(A)','VIÚVO(A)','AMASIADO(A)')),		#upper  
      `raca` VARCHAR(45) CHECK(`raca` IN('NÃO DECLARADA','BRANCA','PARDA','NEGRA','AMARELA','INDÍGENA','MULATA','CABOCLO','CABRA')) ,	#upper
      `religiao` VARCHAR(45) NULL,							#upper
      `carteira_profissional` CHAR(1) NOT NULL ,			#upper
      `titulo_eleitor` VARCHAR(12) NULL ,
      `certidao_nascimento` CHAR(1) NOT NULL ,				#upper      
      `ativo` BOOL NOT NULL DEFAULT TRUE,
      PRIMARY KEY (`id_pessoa`), 
      INDEX `fk_Pessoa_familia1_idx` (`id_familia` ASC) ,      
      CONSTRAINT `fk_Pessoa_familia1`
        FOREIGN KEY (`id_familia` )
        REFERENCES `familia` (`id_familia` )
        ON DELETE CASCADE   #permite deletar uma família
        ON UPDATE NO ACTION,
      CONSTRAINT `fk_pessoa_cidade1`
        FOREIGN KEY (`cidade_natal` )
        REFERENCES `cidade` (`cod_cidade` )
        ON DELETE NO ACTION
        ON UPDATE NO ACTION)
    ENGINE = InnoDB;   
    ") or die(mysql_error());

    mysql_query("
    -- -----------------------------------------------------
    -- Table `telefone`
    -- -----------------------------------------------------
    CREATE  TABLE IF NOT EXISTS `telefone` (
      `telefone` VARCHAR(15) NOT NULL ,
      `id_familia` INT NOT NULL ,
      `recado_com` VARCHAR(45) NULL ,		#upper
      PRIMARY KEY (`telefone`) ,
      INDEX `fk_Telefone_familia1_idx` (`id_familia` ASC) ,
      CONSTRAINT `fk_Telefone_familia1`
        FOREIGN KEY (`id_familia` )
        REFERENCES `familia` (`id_familia` )
        ON DELETE CASCADE
        ON UPDATE NO ACTION)
    ENGINE = InnoDB;
    ") or die(mysql_error());

    mysql_query("
    -- -----------------------------------------------------
    -- Table `curso_has_pessoa`
    -- -----------------------------------------------------
    CREATE  TABLE IF NOT EXISTS `curso_has_pessoa` (
      `id_curso` INT NOT NULL ,
      `id_pessoa` INT NOT NULL ,
      `data_inscricao` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ,
      `situacao_matricula` TINYTEXT NOT NULL CHECK(`situacao_matricula` IN('MATRICULADO', 'LISTA DE ESPERA', 'CONCLUÍDO', 'DESISTIU')),		#upper
      PRIMARY KEY (`id_curso`, `id_pessoa`) ,
      INDEX `fk_Curso_has_Pessoa_Pessoa1_idx` (`id_pessoa` ASC) ,
      INDEX `fk_Curso_has_Pessoa_Curso1_idx` (`id_curso` ASC) ,
      CONSTRAINT `fk_Curso_has_Pessoa_Curso1`
        FOREIGN KEY (`id_curso` )
        REFERENCES `curso` (`id_curso` )
        ON DELETE CASCADE
        ON UPDATE NO ACTION,
      CONSTRAINT `fk_Curso_has_Pessoa_Pessoa1`
        FOREIGN KEY (`id_pessoa` )
        REFERENCES `pessoa` (`id_pessoa` )
        ON DELETE CASCADE   #permite que ao deletar uma pessoa, delete os cursos q ela fez tb
        ON UPDATE NO ACTION)
    ENGINE = InnoDB;
    ") or die(mysql_error());

    mysql_query("
    -- -----------------------------------------------------
    -- Table `programa`
    -- -----------------------------------------------------
    CREATE  TABLE IF NOT EXISTS `programa` (
      `id_programa` INT NOT NULL AUTO_INCREMENT ,
      `nome` VARCHAR(100) NOT NULL UNIQUE,			#upper
      PRIMARY KEY (`id_programa`))  
    ENGINE = InnoDB;
    ") or die(mysql_error());

    mysql_query("
    -- -----------------------------------------------------
    -- Table `pessoa_has_programa`
    -- -----------------------------------------------------
    CREATE  TABLE IF NOT EXISTS `pessoa_has_programa` (
      `id_pessoa` INT NOT NULL ,
      `id_programa` INT NOT NULL ,
      PRIMARY KEY (`id_pessoa`, `id_programa`) ,
      INDEX `fk_Pessoa_has_Programa_Programa1_idx` (`id_programa` ASC) ,
      INDEX `fk_Pessoa_has_Programa_Pessoa1_idx` (`id_pessoa` ASC) ,
      CONSTRAINT `fk_Pessoa_has_Programa_Pessoa1`
        FOREIGN KEY (`id_pessoa` )
        REFERENCES `pessoa` (`id_pessoa` )
        ON DELETE CASCADE   #permite q ao deletar uma pessoa delete os programas dela
        ON UPDATE NO ACTION,
      CONSTRAINT `fk_Pessoa_has_Programa_Programa1`
        FOREIGN KEY (`id_programa` )
        REFERENCES `programa` (`id_programa` )
        ON DELETE NO ACTION
        ON UPDATE NO ACTION)
    ENGINE = InnoDB;
    ") or die(mysql_error());

    mysql_query("
    -- -----------------------------------------------------
    -- Table `login`
    -- -----------------------------------------------------
    CREATE  TABLE IF NOT EXISTS `login` (
      `usuario` VARCHAR(50),
      `senha` VARCHAR(32) NOT NULL ,	
      `nivel` TEXT NOT NULL CHECK(nivel IN ('ATENDENTE','ADMINISTRADOR')),
      PRIMARY KEY (`usuario`))
    ENGINE = InnoDB;
    ") or die(mysql_error());
    #--------------------------------------------------------TRIGGERS-------------------------------------------------------
	#Tratamento de erros
	#http://www.devshed.com/c/a/MySQL/Error-Handling/
	#http://dev.mysql.com/doc/refman/5.6/en/get-diagnostics.html
	#http://dev.mysql.com/doc/refman/5.0/en/declare-handler.html


    #------------LETRAS Maiúsculas em `curso` -------------
    echo "<br>";
    #INSERT
    mysql_query("
    CREATE TRIGGER insere_curso BEFORE INSERT ON curso
      FOR EACH ROW BEGIN    
            declare msg varchar(255);
            set NEW.nome = upper(NEW.nome);
            set NEW.pre_requisitos = upper(NEW.pre_requisitos);
            IF(NEW.data_termino < NEW.data_inicio) THEN
                /*CALL insere_curso('Erro: A data de término não pode ser menor do que a data de início');*/
                set msg = \"Erro: A data de término não pode ser menor do que a data de início\";
                SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = msg;
            END IF;
            IF(NEW.vagas < 1) THEN
                /*CALL insere_curso('Erro: A data de término não pode ser menor do que a data de início');*/
                set msg = \"Erro: O número de vagas deve ser maior do que 0\";
                SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = msg;
            END IF;
      END;
    ") or die(mysql_error());

    echo "Trigger ao inserir curso Instalada com sucesso<br>";

    #UPDATE
    mysql_query("
    CREATE TRIGGER atualiza_curso BEFORE UPDATE ON curso
      FOR EACH ROW BEGIN    
            DECLARE msg varchar(255);            
            DECLARE i INTEGER;            
            DECLARE done INT DEFAULT FALSE;
            
            DECLARE id_pes INTEGER;
            DECLARE pessoas INTEGER;            
            
            DECLARE cur CURSOR FOR SELECT id_pessoa FROM curso_has_pessoa WHERE id_curso = OLD.id_curso AND situacao_matricula = 'LISTA DE ESPERA' ORDER BY data_inscricao;
            DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
                        
            SELECT COUNT(*) INTO pessoas FROM curso_has_pessoa WHERE id_curso = OLD.id_curso AND situacao_matricula = 'LISTA DE ESPERA';
            
            set NEW.nome = upper(NEW.nome);
            set NEW.pre_requisitos = upper(NEW.pre_requisitos);
            IF(NEW.data_termino < NEW.data_inicio) THEN
                set msg = \"Erro: A data de término não pode ser menor do que a data de início\";
                SIGNAL SQLSTATE 'HY000' SET MESSAGE_TEXT = msg;
            END IF;
            IF(NEW.vagas < 1) THEN
                /*CALL insere_curso('Erro: A data de término não pode ser menor do que a data de início');*/
                set msg = \"Erro: O número de vagas deve ser maior do que 0\";
                SIGNAL SQLSTATE 'HY000' SET MESSAGE_TEXT = msg;
            END IF;
            
            /*VERIFICAR SE O NÚMERO DE VAGAS FOI ALTERADO*/            
            IF NEW.vagas > OLD.vagas THEN       /*SE O NUMERO DE VAGAS NOVO É MAIOR QUE O ANTIGO*/
                SET i = 0;
                OPEN cur;                                                
                lista_inscritos: LOOP                    
                    IF i < (NEW.vagas - OLD.vagas) AND (pessoas > 0 ) THEN /*SE I < DIFERENÇA ENTRE AS NOVAS VAGAS E AS ANTIGAS*/
                        FETCH cur INTO id_pes;                        
                        UPDATE curso_has_pessoa SET situacao_matricula = 'MATRICULADO' WHERE id_curso = OLD.id_curso AND id_pessoa = id_pes;
                        SET i = i + 1;
                        SET pessoas = pessoas - 1;
                        ITERATE lista_inscritos;
                    END IF;
                    CLOSE cur;
                    LEAVE lista_inscritos;
                END LOOP lista_inscritos;
            ELSEIF NEW.vagas < OLD.vagas THEN
                set msg = \"\";
            END IF;
            
            
      END;") or die(mysql_error());
    /*
     * SELECT * FROM curso_has_pessoa c WHERE c.id_curso = OLD.id_curso AND c.situacao_matricula = 'LISTA DE ESPERA';
            //pega o numero de vagas atual
            //pega o numero de vagas antigo            
            
            //ver se o numero de vagas aumentou
                //se aumentou, ver se tem alguém na lista de espera
                    //se tem alguém na lista de espera pega a diferença entre vagas atual e vagas antigo
           //se diminuiu
                //pega a diferença entre vagas antigo e vagas atual e tira quem se cadastrou por último
           */

    echo "Trigger ao atualizar curso Instalada com sucesso<br>";


    #-----------LETRAS Maiúsculas em `PROGRAMA` -----------
    #INSERT
    mysql_query("
    CREATE TRIGGER insere_programa BEFORE INSERT ON programa
      FOR EACH ROW BEGIN    
            set NEW.nome = upper(NEW.nome);
      END;
    ") or die(mysql_error());

    echo "Trigger ao inserir programa Instalada com sucesso<br>";

    #UPDATE
    mysql_query("
    CREATE TRIGGER atualiza_programa BEFORE UPDATE ON programa
      FOR EACH ROW BEGIN    
            set NEW.nome = upper(NEW.nome);
      END;
    ") or die(mysql_error());

    echo "Trigger ao atualizar programa Instalada com sucesso<br>";


    #----------LETRAS Maiúsculas em `BAIRRO` -------------
    #INSERT
    mysql_query("
    CREATE TRIGGER insere_bairro BEFORE INSERT ON bairro
      FOR EACH ROW BEGIN    
            set NEW.nome = upper(NEW.nome);
      END;
    ") or die(mysql_error());

    echo "Trigger ao inserir bairro Instalada com sucesso<br>";

    #UPDATE
    mysql_query("
    CREATE TRIGGER atualiza_bairro BEFORE UPDATE ON bairro
      FOR EACH ROW BEGIN    
            set NEW.nome = upper(NEW.nome);
      END;
    ") or die(mysql_error());

    echo "Trigger ao atualizar bairro Instalada com sucesso<br>";


    #---------LETRAS Maiúsculas em `CIDADE` --------------
    #INSERT
    mysql_query("
    CREATE TRIGGER insere_cidade BEFORE INSERT ON cidade
      FOR EACH ROW BEGIN    
            set NEW.nome = upper(NEW.nome);            
      END;
    ") or die(mysql_error());

    echo "Trigger ao inserir cidade Instalada com sucesso<br>";

    #UPDATE
    mysql_query("
    CREATE TRIGGER atualiza_cidade BEFORE UPDATE ON cidade
      FOR EACH ROW BEGIN    
            set NEW.nome = upper(NEW.nome);            
      END;
    ") or die(mysql_error());

    echo "Trigger ao atualizar cidade Instalada com sucesso<br>";


    #---------LETRAS Maiúsculas em `FAMILIA` ------------
    #INSERT
    mysql_query("
    CREATE TRIGGER insere_familia BEFORE INSERT ON familia
      FOR EACH ROW BEGIN     
            set NEW.logradouro = upper(NEW.logradouro);	
            set NEW.bairro = upper(NEW.bairro);	                        
      END;
    ") or die(mysql_error());

    echo "Trigger ao inserir familia Instalada com sucesso<br>";

    #UPDATE
    mysql_query("
    CREATE TRIGGER atualiza_familia BEFORE UPDATE ON familia
      FOR EACH ROW BEGIN    
            set NEW.logradouro = upper(NEW.logradouro);	
            set NEW.bairro = upper(NEW.bairro);	                        
      END;
    ") or die(mysql_error());

    echo "Trigger ao atualizar familia Instalada com sucesso<br>";


    #-----------LETRAS Maiúsculas em `PESSOA` ------------
    #INSERT
    mysql_query("
    CREATE TRIGGER insere_pessoa BEFORE INSERT ON pessoa
      FOR EACH ROW BEGIN    
            set NEW.nome = upper(NEW.nome);	
            set NEW.sexo = upper(NEW.sexo);
            set NEW.data_cadastro = date(now());	
            set NEW.last_modified = now();
            set NEW.grau_parentesco = upper(NEW.grau_parentesco);	
            set NEW.estado_civil = upper(NEW.estado_civil);	
            set NEW.raca = upper(NEW.raca);	
            set NEW.religiao = upper(NEW.religiao);	
            set NEW.carteira_profissional = upper(NEW.carteira_profissional);		   	
            set NEW.certidao_nascimento = upper(NEW.certidao_nascimento);		   
      END;
    ") or die(mysql_error());

    echo "Trigger ao inserir pessoa Instalada com sucesso<br>";   

    #UPDATE
    mysql_query("
    CREATE TRIGGER atualiza_pessoa BEFORE UPDATE ON pessoa
      FOR EACH ROW BEGIN    
            IF (NEW.ativo <> OLD.ativo) THEN
                IF(NEW.ativo = TRUE) THEN
                    set NEW.data_saida = NULL;
                ELSE
                    set NEW.data_saida = NOW();
                END IF;
            END IF;
        
            set NEW.nome = upper(NEW.nome);	
            set NEW.sexo = upper(NEW.sexo);            
            set NEW.last_modified = now();            
            set NEW.grau_parentesco = upper(NEW.grau_parentesco);	
            set NEW.estado_civil = upper(NEW.estado_civil);	
            set NEW.raca = upper(NEW.raca);	
            set NEW.religiao = upper(NEW.religiao);	
            set NEW.carteira_profissional = upper(NEW.carteira_profissional);		   	
            set NEW.certidao_nascimento = upper(NEW.certidao_nascimento);		   
      END;
    ") or die(mysql_error());

    echo "Trigger ao atualizar pessoa Instalada com sucesso<br>";

    #-----------LETRAS Maiúsculas em `TELEFONE` ------------
    #INSERT
    mysql_query("
    CREATE TRIGGER insere_telefone BEFORE INSERT ON telefone
      FOR EACH ROW BEGIN    
            set NEW.recado_com = upper(NEW.recado_com);
      END;
    ") or die(mysql_error());

    echo "Trigger ao inserir telefone Instalada com sucesso<br>";   

    #UPDATE
    mysql_query("
    CREATE TRIGGER atualiza_telefone BEFORE UPDATE ON telefone
      FOR EACH ROW BEGIN    
            set NEW.recado_com = upper(NEW.recado_com);
      END;
    ") or die(mysql_error());

    echo "Trigger ao atualizar telefone Instalada com sucesso<br>";

    #-----------DEFINE SITUAÇÃO_MATRICULA EM`CURSO_HAS_PESSOA` ------------
    #INSERT
    mysql_query("
    CREATE TRIGGER insere_aluno_em_curso BEFORE INSERT ON curso_has_pessoa
      FOR EACH ROW BEGIN	
        DECLARE qtd_vagas_ocupadas, qtd_vagas_curso INT;

        SELECT COUNT(*) FROM curso_has_pessoa WHERE id_curso = NEW.id_curso INTO qtd_vagas_ocupadas;
        SELECT vagas FROM curso WHERE id_curso = NEW.id_curso INTO qtd_vagas_curso;

        IF(qtd_vagas_curso > qtd_vagas_ocupadas) THEN
             set NEW.situacao_matricula = 'MATRICULADO';
        ELSE
             set NEW.situacao_matricula = 'LISTA DE ESPERA';

        END IF;
        
        set NEW.data_inscricao = NOW();

      END;
    ") or die(mysql_error());

    echo "Trigger para definir situação_matricula em curso_has_pessoa Instalada com sucesso<br>";
    
    
    #-----------LETRAS Maiúsculas em `CURSO_HAS_PESSOA` ------------
    #UPDATE
    mysql_query("
    CREATE TRIGGER atualiza_curso_has_pessoa BEFORE UPDATE ON curso_has_pessoa
      FOR EACH ROW BEGIN    
            set NEW.situacao_matricula = upper(NEW.situacao_matricula);                        
      END;
    ") or die(mysql_error());

    echo "Trigger ao atualizar curso_has_pessoa Instalada com sucesso<br>";


    #-----------ENCRIPTOGRAFAR SENHA NO LOGIN ------------
    #INSERT
    mysql_query("
    CREATE TRIGGER insere_login BEFORE INSERT ON login
      FOR EACH ROW BEGIN    
            set NEW.senha = md5(NEW.senha);
      END;
    ") or die(mysql_error());

    echo "Trigger ao inserir login Instalada com sucesso<br>";

    #UPDATE
    mysql_query("
    CREATE TRIGGER altera_login BEFORE UPDATE ON login
      FOR EACH ROW BEGIN    
            set NEW.senha = md5(NEW.senha);
      END;
    ") or die(mysql_error());


    #---------------------------------------------------POPULAR O BANCO-------------------------------------------------------
    echo "<br>";
    #CURSO
    mysql_query("insert into curso(nome,vagas,data_inicio,carga_horaria,pre_requisitos,ter,qui,data_termino) values
    ('informática',2,'2013-01-10',45,'',true, true,'2013-03-10')") or die(mysql_error());
    echo "Tabela curso populada com sucesso<br>";

    #PROGRAMA
    mysql_query("insert into programa(nome) values ('criança feliz'),('formação infantil'),('fábrica de tijolos')") or die(mysql_error());
    echo "Tabela programa populada com sucesso<br>";

    #BAIRRO
    mysql_query("insert into bairro(nome) values ('MOrUMBI'),('ACLImAÇÃO'),('santa mônica')") or die(mysql_error());
    echo "Tabela bairro populada com sucesso<br>";

    #CIDADE
    include_once 'install_cidades_estados.php';    
    echo "Tabela cidade e estado populada com sucesso<br>";

    #FAMILIA
    mysql_query("insert into familia(cep,logradouro,numero,bairro,cod_cidade) values 
        ('38408-100','AVENIDA: joão naves de ávila', 2121,'santa mônica',4048)") or die(mysql_error());
    echo "Tabela familia populada com sucesso<br>";
    
    #TELEFONE
    mysql_query("insert into telefone(id_familia, telefone, recado_com) 
    values (1,'(34) 3230-1101', 'JoÃO')") or die(mysql_error());
    echo "Tabela telefone populada com sucesso<br>";

    #PESSOA
    mysql_query("insert into pessoa
    (id_familia,cidade_natal,nome,cpf,rg,sexo,data_nascimento,telefone,grau_parentesco,estado_civil,raca,religiao,carteira_profissional,titulo_eleitor,certidao_nascimento) values 
    (1,4048,'João da silva','101.101.101-00','SSP-DF 2.573.224','m','1970-10-31','9998-0099','TiTULAR','SoLTEIRO(A)','BrANCO','CATÓlICO','s','000011112222','s')") or die(mysql_error());
    echo "Tabela cidade populada com sucesso<br>"; 

    #PESSOA_HAS_PROGRAMA
    mysql_query("insert into pessoa_has_programa(id_pessoa, id_programa) values (1,1)") or die(mysql_error());
    echo "Tabela pesssoa_has_programa populada com sucesso<br>";
        
    #CURSO_HAS_PESSOA
    mysql_query("insert into curso_has_pessoa(id_curso, id_pessoa) values (1,1)") or die(mysql_error());
    echo "Tabela curso_has_pessoa populada com sucesso<br>";


    #LOGIN
    mysql_query("insert into login(usuario, senha, nivel) values ('ADMIN','ADMIN','ADMINISTRADOR')") or die(mysql_error());
    mysql_query("insert into login(usuario, senha, nivel) values ('ATENDENTE','ATENDENTE','ATENDENTE')") or die(mysql_error());   
    mysql_query("insert into login(usuario, senha, nivel) values ('at','at','ATENDENTE')") or die(mysql_error());
    echo "Tabela login populada com sucesso<br>";

    #mate-2.2 plugin
    mysql_query("
    --
    -- Create this table in your database if you want to use show/hide columns or order columns.
    --
    CREATE TABLE IF NOT EXISTS `mate_columns` (
      `id` mediumint(8) unsigned NOT NULL auto_increment,
      `mate_user_id` varchar(75) collate utf8_unicode_ci NOT NULL,
      `mate_var_prefix` varchar(100) collate utf8_unicode_ci NOT NULL,
      `mate_column` varchar(75) collate utf8_unicode_ci NOT NULL,
      `hidden` varchar(3) collate utf8_unicode_ci NOT NULL default 'No',
      `order_num` mediumint(4) unsigned NOT NULL,
      `date_updated` datetime NOT NULL,
      PRIMARY KEY  (`id`),
      KEY `mate_user_id` (`mate_user_id`)
    ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;") or die(mysql_error());


    echo "<br>BANCO INSTALADO COM SUCESSO<br><br>";    
    echo "Data de Fim: " .date("d/m/Y")." ".date("H:i:s")."<br><br>";
?>