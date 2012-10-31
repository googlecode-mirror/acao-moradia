<?php /*INSTALA O BANCO DE DADOS*/

########DADOS PARA CONEXÃO COM O MYSQL
$server = "localhost";
$database = "acao_moradia";
$username = "root";		#alterar conforme seu usuário do banco de dados mysql()
$password = "root";		#alterar conforme a senha de seu usuário do banco de dados mysql()

$SQL = mysql_connect($server, $username, $password) or trigger_error(mysql_error(),E_USER_ERROR);	#se nao conectar, escreve uma msg de erro
mysql_select_db($database, $SQL);	#seleciona o banco de dados para uso posterior


#########Define o conjunto de caracteres que será usado
mysql_query("SET NAMES 'utf8'");
mysql_query('SET character_set_connection=utf8');
mysql_query('SET character_set_client=utf8');
mysql_query('SET character_set_results=utf8');
mysql_query('SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO"');

########CRIA O BANCO
mysql_query('DROP DATABASE IF EXISTS acao_moradia');
mysql_query('CREATE DATABASE acao_moradia');				
mysql_query('USE acao_moradia');

#---------------------------------------------------CRIA AS TABELAS------------------------------------------------------
mysql_query("
CREATE TABLE IF NOT EXISTS `login` (
  `usuario` VARCHAR(50) PRIMARY KEY,
  `senha` VARCHAR(40) NOT NULL, 	
  `nivel` TEXT NOT NULL CHECK(nivel IN ('ATENDENTE','ADMIN'))
) ENGINE=InnoDB;
") or die(mysql_error());

echo "Tabela login Instalada com sucesso<br>";

mysql_query("
CREATE TABLE IF NOT EXISTS `curso` (
  `id` INT AUTO_INCREMENT NOT NULL,
  `nome` VARCHAR(100) NOT NULL,			#upper
  `vagas` SMALLINT,
  `data_inicio` DATE NOT NULL,
  `carga_horaria` FLOAT4,
  `pre_requisitos` TEXT,				#upper
  `dias_semana` TEXT,					#upper
  `data_termino` DATE NOT NULL CHECK(`data_termino` >= `data_inicio`),
  CONSTRAINT `curso_pk` PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1;
") or die(mysql_error());

echo "Tabela curso Instalada com sucesso<br>";

mysql_query("
CREATE TABLE IF NOT EXISTS `programa` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,			#upper
  CONSTRAINT `programa_pk` PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1;
") or die(mysql_error());

echo "Tabela programa Instalada com sucesso<br>";

mysql_query("
CREATE TABLE IF NOT EXISTS `bairro` (
  `nome` VARCHAR(100) PRIMARY KEY		#upper
) ENGINE=InnoDB;
") or die(mysql_error());

echo "Tabela bairro Instalada com sucesso<br>";

mysql_query("
CREATE TABLE IF NOT EXISTS `cidade` (
  `nome` VARCHAR(100) NOT NULL,			#upper
  `estado` VARCHAR(2) NOT NULL,			#upper
  CONSTRAINT `cidade_pk` PRIMARY KEY (`nome`, `estado`)
) ENGINE=InnoDB;
") or die(mysql_error()); 

echo "Tabela cidade Instalada com sucesso<br>";

mysql_query("
CREATE TABLE IF NOT EXISTS `endereco` (
  `cep` VARCHAR(9),
  `logradouro` VARCHAR(100) NOT NULL,  #upper
  `numero` INT(11) NOT NULL,
  `bairro` VARCHAR(100) NOT NULL,	#essas três são chaves estrangeiras, portanto, já são upper
  `cidade` VARCHAR(100) NOT NULL,  
  `estado` VARCHAR(2) NOT NULL,  
  CONSTRAINT `endereco_pk` PRIMARY KEY (`cep`, `logradouro`, `numero`),
  CONSTRAINT `bairro_nome_fk` FOREIGN KEY (`bairro`) REFERENCES bairro(`nome`) ON UPDATE CASCADE,
  CONSTRAINT `cidade_fk` FOREIGN KEY (`cidade`, `estado`) REFERENCES cidade(`nome`, `estado`) ON UPDATE CASCADE
) ENGINE=InnoDB;
") or die(mysql_error());

echo "Tabela endereco Instalada com sucesso<br>";

mysql_query("
CREATE TABLE IF NOT EXISTS `pessoa` (
  `id` INT AUTO_INCREMENT NOT NULL,
  `cpf` VARCHAR(14),
  `nome` VARCHAR(100) NOT NULL,			#upper
  `rg` VARCHAR(45),
  `sexo` CHAR CHECK(`sexo`IN('M','F')),	#upper
  `data_nascimento` DATE,
  `data_cadastro` DATE,
  `data_saida` DATE,    
  `id_conjuge` INT,
  `cep` VARCHAR(9) NOT NULL,
  `logradouro` VARCHAR(100) NOT NULL ,	
  `numero` INT(11) NOT NULL ,
  CONSTRAINT `pessoa_pk` PRIMARY KEY (`id`),
  CONSTRAINT `conjuge_fk` FOREIGN KEY (`id_conjuge`) REFERENCES pessoa(`id`),
  CONSTRAINT `endereco_cep_fk` FOREIGN KEY (`cep`, `logradouro`, `numero`) REFERENCES endereco(`cep`, `logradouro`, `numero`)
) ENGINE=InnoDB AUTO_INCREMENT=1;
") or die(mysql_error());

echo "Tabela pessoa Instalada com sucesso<br>";

mysql_query("
CREATE TABLE IF NOT EXISTS `telefone` (
  `id_pessoa` INT NOT NULL,
  `numero` VARCHAR(15) NOT NULL,
  CONSTRAINT `telefone_pk` PRIMARY KEY (`id_pessoa`, `numero`),
  CONSTRAINT `telefone_id_pessoa_fk` FOREIGN KEY(`id_pessoa`) REFERENCES pessoa(`id`)
) ENGINE=InnoDB;
") or die(mysql_error());

echo "Tabela telefone Instalada com sucesso<br>";

mysql_query("
CREATE TABLE IF NOT EXISTS `pessoa_has_programa` (
  `id_pessoa` INT NOT NULL,
  `id_programa` INT NOT NULL,
  CONSTRAINT `pessoa_has_programa_pk` PRIMARY KEY (`id_pessoa`, `id_programa`),
  CONSTRAINT `pessoa_has_programa_id_pessoa_fk` FOREIGN KEY(`id_pessoa`) REFERENCES pessoa(`id`),
  CONSTRAINT `pessoa_has_programa_id_programa_fk` FOREIGN KEY(`id_programa`) REFERENCES programa(`id`)
) ENGINE=InnoDB;
") or die(mysql_error());

echo "Tabela pesssoa_has_programa Instalada com sucesso<br>";

mysql_query("
CREATE TABLE IF NOT EXISTS `pessoa_has_pessoa` (
  `id_pessoa` INT NOT NULL,
  `id_parente` INT NOT NULL,
  `parentesco` VARCHAR(45) NOT NULL,	#upper
  CONSTRAINT `pessoa_has_pessoa_pk` PRIMARY KEY(`id_pessoa`, `id_parente`),
  CONSTRAINT `pessoa_has_pessoa_id_pessoa_fk` FOREIGN KEY(`id_pessoa`) REFERENCES pessoa(`id`),
  CONSTRAINT `pessoa_has_pessoa_id_parente_fk` FOREIGN KEY(`id_parente`) REFERENCES pessoa(`id`)
) ENGINE=InnoDB;
") or die(mysql_error());

echo "Tabela pessoa_has_pessoa Instalada com sucesso<br>";

mysql_query("
CREATE TABLE IF NOT EXISTS `curso_has_pessoa` (
  `id_curso` INT NOT NULL,
  `id_pessoa` INT NOT NULL,  
  `situacao_matricula` TINYTEXT NOT NULL,		#upper
  CONSTRAINT `curso_has_pessoa_pk` PRIMARY KEY(`id_pessoa`, `id_curso`),
  CONSTRAINT `curso_has_pessoa_id_pessoa_fk` FOREIGN KEY(`id_pessoa`) REFERENCES pessoa(`id`),
  CONSTRAINT `curso_has_pessoa_id_curso_fk` FOREIGN KEY(`id_curso`) REFERENCES curso(`id`)
) ENGINE=InnoDB;
") or die(mysql_error());

echo "Tabela curso_has_pessoa Instalada com sucesso<br>";

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


#---------LETRAS Maiúsculas em `ENDEREÇO` ------------
#INSERT
mysql_query("
CREATE TRIGGER insere_endereco BEFORE INSERT ON endereco
  FOR EACH ROW BEGIN    
	set NEW.logradouro = upper(NEW.logradouro);	
  END;
") or die(mysql_error());

echo "Trigger ao inserir endereço Instalada com sucesso<br>";

#UPDATE
mysql_query("
CREATE TRIGGER atualiza_endereco BEFORE UPDATE ON endereco
  FOR EACH ROW BEGIN    
	set NEW.logradouro = upper(NEW.logradouro);	
  END;
") or die(mysql_error());

echo "Trigger ao atualizar endereço Instalada com sucesso<br>";


#-----------LETRAS Maiúsculas em `PESSOA` ------------
#INSERT
mysql_query("
CREATE TRIGGER insere_pessoa BEFORE INSERT ON pessoa
  FOR EACH ROW BEGIN    
	set NEW.nome = upper(NEW.nome);	
	set NEW.sexo = upper(NEW.sexo);
	set NEW.data_cadastro = date(now());
  END;
") or die(mysql_error());

echo "Trigger ao inserir pessoa Instalada com sucesso<br>";

#UPDATE
mysql_query("
CREATE TRIGGER atualiza_pessoa BEFORE UPDATE ON pessoa
  FOR EACH ROW BEGIN    
	set NEW.nome = upper(NEW.nome);	
	set NEW.sexo = upper(NEW.sexo);		
  END;
") or die(mysql_error());

echo "Trigger ao atualizar pessoa Instalada com sucesso<br>";


#-----------DEFINE SITUAÇÃO_MATRICULA EM`CURSO_HAS_PESSOA` ------------
#INSERT
mysql_query("
CREATE TRIGGER insere_aluno_em_curso BEFORE INSERT ON curso_has_pessoa
  FOR EACH ROW BEGIN	
    DECLARE qtd_vagas_ocupadas, qtd_vagas_curso INT;

    SELECT COUNT(*) FROM curso_has_pessoa WHERE id_curso = NEW.id_curso INTO qtd_vagas_ocupadas;
    SELECT COUNT(*) FROM curso WHERE id = NEW.id_curso INTO qtd_vagas_curso;
    
    IF(qtd_vagas_curso > qtd_vagas_ocupadas) THEN
         set NEW.situacao_matricula = 'MATRICULADO';
    ELSE
         set NEW.situacao_matricula = 'LISTA_ESPERA';
           
    END IF;
  END;
") or die(mysql_error());

echo "Trigger para definir situação_matricuça em curso_has_pessoa Instalada com sucesso<br>";


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
mysql_query("insert into cidade(nome, estado) values ('UBERLÂNDIA','MG')") or die(mysql_error());
echo "Tabela cidade populada com sucesso<br>";

#ENDEREÇO
mysql_query("insert into endereco(cep,logradouro,numero,bairro,cidade,estado) values ('38408-100','AVENIDA: joão naves de ávila', 2121,'santa mônica','uberlândia','MG')") or die(mysql_error());
echo "Tabela cidade populada com sucesso<br>";

#PESSOA
mysql_query("insert into pessoa(cpf,nome,rg,sexo,data_nascimento,id_conjuge,cep,logradouro,numero) 
values ('101.101.101-00','João da silva', 2121,'m','1970-10-31',null,'38408-100','AVENIDA: joão naves de ávila', 2121)") or die(mysql_error());
echo "Tabela cidade populada com sucesso<br>";

#TELEFONE
mysql_query("insert into telefone(id_pessoa, numero) 
values (1,'(34) 9690-1101')") or die(mysql_error());
echo "Tabela telefone populada com sucesso<br>";

#PESSOA_HAS_PROGRAMA
mysql_query("insert into pessoa_has_programa(id_pessoa, id_programa) values (1,1)") or die(mysql_error());
echo "Tabela pesssoa_has_programa Instalada com sucesso<br>";

#CURSO_HAS_PESSOA
mysql_query("insert into curso_has_pessoa(id_curso, id_pessoa) values (1,1)") or die(mysql_error());
echo "Tabela curso_has_pessoa Instalada com sucesso<br>";


#PESSOA_HAS_PESSOA



echo "<br>BANCO INSTALADO COM SUCESSO<br>";


?>