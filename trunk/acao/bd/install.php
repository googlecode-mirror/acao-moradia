<?php 
    /*################################
     *### INSTALA O BANCO DE DADOS ###
     *################################*/
     
    echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">";
    
    ########DADOS PARA CONEXÃO COM O MYSQL
    $server = "localhost";
    $database = "acao_moradia";
    $username = "root";		#alterar conforme seu usuário do banco de dados mysql()
    $password = "";		#alterar conforme a senha de seu usuário do banco de dados mysql()

    $SQL = mysql_connect($server, $username, $password) or trigger_error(mysql_error(),E_USER_ERROR);	#se nao conectar, escreve uma msg de erro
    mysql_select_db($database, $SQL);	#seleciona o banco de dados para uso posterior


    #########Define o conjunto de caracteres que será usado
    mysql_query("SET NAMES 'utf8'");
    mysql_query('SET character_set_connection=utf8');
    mysql_query('SET character_set_client=utf8');
    mysql_query('SET character_set_results=utf8');
    mysql_query('SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO"');

    $charset = mysql_set_charset('utf8');
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
      `vagas` SMALLINT NOT NULL ,
      `data_inicio` DATE NOT NULL ,
      `carga_horaria` FLOAT NULL ,
      `pre_requisitos` TEXT NULL ,  	#upper
      `dias_semana` TEXT NULL ,			#upper
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
    -- Table `cidade`
    -- -----------------------------------------------------
    CREATE  TABLE IF NOT EXISTS `cidade` (
      `nome` VARCHAR(100) NOT NULL ,	#upper
      `estado` VARCHAR(2) NOT NULL ,	#upper
      PRIMARY KEY (`nome`, `estado`) )
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
      `bairro` VARCHAR(100) NOT NULL ,				#upper
      `cidade` VARCHAR(100) NOT NULL ,				#upper
      `estado` VARCHAR(2) NOT NULL ,				#upper
      INDEX `fk_Endereço_Bairro1_idx` (`bairro` ASC) ,
      INDEX `fk_Endereço_Cidade1_idx` (`cidade` ASC, `estado` ASC) ,
      PRIMARY KEY (`id_familia`) ,
      CONSTRAINT `fk_Endereço_Bairro1`
        FOREIGN KEY (`bairro` )
        REFERENCES `bairro` (`nome` )
        ON DELETE NO ACTION
        ON UPDATE NO ACTION,
      CONSTRAINT `fk_Endereço_Cidade1`
        FOREIGN KEY (`cidade` , `estado` )
        REFERENCES `cidade` (`nome` , `estado` )
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
      `nome` VARCHAR(100) NOT NULL ,		#upper
      `cpf` VARCHAR(14) NULL ,
      `rg` VARCHAR(45) NULL ,
      `sexo` CHAR CHECK(`sexo`IN('M','F')),	#upper
      `data_nascimento` DATE NULL ,
      `data_cadastro` DATE NULL ,
      `data_saida` DATE NULL ,
      `telefone` VARCHAR(15) NULL ,
      `grau_parentesco` VARCHAR(45) NOT NULL CHECK(`grau_parentesco` IN('TITULAR','CÔNJUGE(MARIDO OU ESPOSA)','COMPANHEIRO(A)','FILHO(A)','IRMÃ(O)','PAI/MÃE','CUNHADO(A)','GENRO/NORA','SOGRO(A)','ENTEADO(A)','NETO(A)','PADRASTO/MADRASTA','AGREGADO(A)','AVÔ(Ó)','EX-COMPANHEIRO(A)','EX-MARIDO/EX-ESPOSA','PRIMO(A)','SOBRINHO(A)','TIO(A)')),	#upper
      `estado_civil` VARCHAR(45) NULL CHECK(`estado_civil` IN('SOLTEIRO(A)','CASADO(A)','SEPARADO(A)','DIVORCIADO(A)','VIÚVO(A)')),		#upper  
      `raca` VARCHAR(45) CHECK(`raca` IN('NÃO DECLARADA','BRANCA','NEGRA','AMARELA','INDÍGENA','MULATA','CABOCLO','CABRA')) ,	#upper
      `religiao` VARCHAR(45) NULL,							#upper
      `carteira_profissional` CHAR(1) NOT NULL ,			#upper
      `titulo_eleitor` VARCHAR(12) NULL ,
      `certidao_nascimento` CHAR(1) NOT NULL ,				#upper
      `cidade_natal` VARCHAR(100) NOT NULL ,				#upper
      `estado_natal` VARCHAR(2) NOT NULL ,  				#upper
      PRIMARY KEY (`id_pessoa`), 
      INDEX `fk_Pessoa_familia1_idx` (`id_familia` ASC) ,
      INDEX `fk_pessoa_cidade1_idx` (`cidade_natal` ASC, `estado_natal` ASC) ,
      CONSTRAINT `fk_Pessoa_familia1`
        FOREIGN KEY (`id_familia` )
        REFERENCES `familia` (`id_familia` )
        ON DELETE NO ACTION
        ON UPDATE NO ACTION,
      CONSTRAINT `fk_pessoa_cidade1`
        FOREIGN KEY (`cidade_natal` , `estado_natal` )
        REFERENCES `cidade` (`nome` , `estado` )
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
        ON DELETE NO ACTION
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
      `situacao_matricula` TINYTEXT NOT NULL CHECK(`situacao_matricula` IN('MATRICULADO', 'LISTA DE ESPERA', 'CONCLUÍDO', 'DESISTIU')),		#upper
      PRIMARY KEY (`id_curso`, `id_pessoa`) ,
      INDEX `fk_Curso_has_Pessoa_Pessoa1_idx` (`id_pessoa` ASC) ,
      INDEX `fk_Curso_has_Pessoa_Curso1_idx` (`id_curso` ASC) ,
      CONSTRAINT `fk_Curso_has_Pessoa_Curso1`
        FOREIGN KEY (`id_curso` )
        REFERENCES `curso` (`id_curso` )
        ON DELETE NO ACTION
        ON UPDATE NO ACTION,
      CONSTRAINT `fk_Curso_has_Pessoa_Pessoa1`
        FOREIGN KEY (`id_pessoa` )
        REFERENCES `pessoa` (`id_pessoa` )
        ON DELETE NO ACTION
        ON UPDATE NO ACTION)
    ENGINE = InnoDB;
    ") or die(mysql_error());

    mysql_query("
    -- -----------------------------------------------------
    -- Table `programa`
    -- -----------------------------------------------------
    CREATE  TABLE IF NOT EXISTS `programa` (
      `id` INT NOT NULL AUTO_INCREMENT ,
      `nome` VARCHAR(100) NOT NULL ,			#upper
      PRIMARY KEY (`id`))  
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
        ON DELETE NO ACTION
        ON UPDATE NO ACTION,
      CONSTRAINT `fk_Pessoa_has_Programa_Programa1`
        FOREIGN KEY (`id_programa` )
        REFERENCES `programa` (`id` )
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

    #------------LETRAS Maiúsculas em `curso` -------------
    echo "<br>";
    #INSERT
    mysql_query("
    CREATE TRIGGER insere_curso BEFORE INSERT ON curso
      FOR EACH ROW BEGIN    
            set NEW.nome = upper(NEW.nome);
            set NEW.pre_requisitos = upper(NEW.pre_requisitos);
            set NEW.dias_semana = upper(NEW.dias_semana);		
      END;
    ") or die(mysql_error());

    echo "Trigger ao inserir curso Instalada com sucesso<br>";

    #UPDATE
    mysql_query("
    CREATE TRIGGER atualiza_curso BEFORE UPDATE ON curso
      FOR EACH ROW BEGIN    
            set NEW.nome = upper(NEW.nome);
            set NEW.pre_requisitos = upper(NEW.pre_requisitos);
            set NEW.dias_semana = upper(NEW.dias_semana);	
      END;
    ") or die(mysql_error());

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
            set NEW.estado = upper(NEW.estado);
      END;
    ") or die(mysql_error());

    echo "Trigger ao inserir cidade Instalada com sucesso<br>";

    #UPDATE
    mysql_query("
    CREATE TRIGGER atualiza_cidade BEFORE UPDATE ON cidade
      FOR EACH ROW BEGIN    
            set NEW.nome = upper(NEW.nome);
            set NEW.estado = upper(NEW.estado);
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
            set NEW.cidade = upper(NEW.cidade);	
            set NEW.estado = upper(NEW.estado);	
      END;
    ") or die(mysql_error());

    echo "Trigger ao inserir familia Instalada com sucesso<br>";

    #UPDATE
    mysql_query("
    CREATE TRIGGER atualiza_familia BEFORE UPDATE ON familia
      FOR EACH ROW BEGIN    
            set NEW.logradouro = upper(NEW.logradouro);	
            set NEW.bairro = upper(NEW.bairro);	
            set NEW.cidade = upper(NEW.cidade);	
            set NEW.estado = upper(NEW.estado);	
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
            set NEW.grau_parentesco = upper(NEW.grau_parentesco);	
            set NEW.estado_civil = upper(NEW.estado_civil);	
            set NEW.raca = upper(NEW.raca);	
            set NEW.religiao = upper(NEW.religiao);	
            set NEW.carteira_profissional = upper(NEW.carteira_profissional);		   	
            set NEW.certidao_nascimento = upper(NEW.certidao_nascimento);		   
            set NEW.cidade_natal = upper(NEW.cidade_natal);		   
            set NEW.estado_natal = upper(NEW.estado_natal);		   	
      END;
    ") or die(mysql_error());

    echo "Trigger ao inserir pessoa Instalada com sucesso<br>";   

    #UPDATE
    mysql_query("
    CREATE TRIGGER atualiza_pessoa BEFORE UPDATE ON pessoa
      FOR EACH ROW BEGIN    
            set NEW.nome = upper(NEW.nome);	
            set NEW.sexo = upper(NEW.sexo);
            set NEW.data_cadastro = date(now());	
            set NEW.grau_parentesco = upper(NEW.grau_parentesco);	
            set NEW.estado_civil = upper(NEW.estado_civil);	
            set NEW.raca = upper(NEW.raca);	
            set NEW.religiao = upper(NEW.religiao);	
            set NEW.carteira_profissional = upper(NEW.carteira_profissional);		   	
            set NEW.certidao_nascimento = upper(NEW.certidao_nascimento);		   
            set NEW.cidade_natal = upper(NEW.cidade_natal);		   
            set NEW.estado_natal = upper(NEW.estado_natal);		   	

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
        SELECT COUNT(*) FROM curso WHERE id_curso = NEW.id_curso INTO qtd_vagas_curso;

        IF(qtd_vagas_curso > qtd_vagas_ocupadas) THEN
             set NEW.situacao_matricula = 'MATRICULADO';
        ELSE
             set NEW.situacao_matricula = 'LISTA DE ESPERA';

        END IF;
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
    mysql_query("insert into curso(nome,vagas,data_inicio,carga_horaria,pre_requisitos,dias_semana,data_termino) values
    ('informática',2,'2013-01-10',45,'','terça e quinta', '2013-03-10')") or die(mysql_error());
    echo "Tabela curso populada com sucesso<br>";

    #PROGRAMA
    mysql_query("insert into programa(nome) values ('criança feliz'),('formação infantil')") or die(mysql_error());
    echo "Tabela programa populada com sucesso<br>";

    #BAIRRO
    mysql_query("insert into bairro(nome) values ('MOrUMBI'),('ACLImAÇÃO'),('santa mônica')") or die(mysql_error());
    echo "Tabela bairro populada com sucesso<br>";

    #CIDADE
    mysql_query("insert into cidade(nome, estado) values ('UBERlÂNDIA','MG')") or die(mysql_error());
    echo "Tabela cidade populada com sucesso<br>";

    #FAMILIA
    mysql_query("insert into familia(cep,logradouro,numero,bairro,cidade,estado) values ('38408-100','AVENIDA: joão naves de ávila', 2121,'santa mônica','uberlândia','MG')") or die(mysql_error());
    echo "Tabela familia populada com sucesso<br>";

    #TELEFONE
    mysql_query("insert into telefone(id_familia, telefone, recado_com) 
    values (1,'(34) 3230-1101', 'JoÃO')") or die(mysql_error());
    echo "Tabela telefone populada com sucesso<br>";

    #PESSOA
    mysql_query("insert into pessoa
    (cpf,nome,rg,sexo,data_nascimento,telefone,grau_parentesco,estado_civil,raca,religiao,cidade_natal,estado_natal,carteira_profissional,titulo_eleitor,certidao_nascimento,id_familia) values 
    ('101.101.101-00','João da silva', 'SSP-DF 2.573.224','m','1970-10-31','9998-0099','TiTULAR','SoLTEIRO(A)','BrANCO','CATÓlICO','uBERLÂNDIA','MG','s','000011112222','s',1)") or die(mysql_error());
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

    echo "<br>BANCO INSTALADO COM SUCESSO<br>";
?>