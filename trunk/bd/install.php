<?/*INSTALA O BANCO DE DADOS*/

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

########CRIA AS TABELAS
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
  `nome` VARCHAR(100) NOT NULL,
  `vagas` SMALLINT,
  `data_inicio` DATE NOT NULL,
  `carga_horaria` FLOAT4,
  `pre_requisitos` TEXT,
  `dias_semana` TEXT,
  `data_termino` DATE NOT NULL,
  CONSTRAINT `curso_pk` PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1;
") or die(mysql_error());

echo "Tabela curso Instalada com sucesso<br>";

mysql_query("
CREATE TABLE IF NOT EXISTS `programa` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  CONSTRAINT `programa_pk` PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1;
") or die(mysql_error());

echo "Tabela programa Instalada com sucesso<br>";

mysql_query("
CREATE TABLE IF NOT EXISTS `bairro` (
  `nome` VARCHAR(100) PRIMARY KEY
) ENGINE=InnoDB;
") or die(mysql_error());

echo "Tabela bairro Instalada com sucesso<br>";

mysql_query("
CREATE TABLE IF NOT EXISTS `cidade` (
  `nome` VARCHAR(100) NOT NULL,
  `estado` VARCHAR(2) NOT NULL,
  CONSTRAINT `cidade_pk` PRIMARY KEY (`nome`, `estado`)
) ENGINE=InnoDB;
") or die(mysql_error()); 

echo "Tabela cidade Instalada com sucesso<br>";

mysql_query("
CREATE TABLE IF NOT EXISTS `endereco` (
  `cep` VARCHAR(8),
  `logradouro` VARCHAR(100) NOT NULL,  
  `numero` INT UNSIGNED NOT NULL,
  `bairro_nome` VARCHAR(100) NOT NULL,
  `cidade_nome` VARCHAR(100) NOT NULL,
  `cidade_estado` VARCHAR(2) NOT NULL,
  CONSTRAINT `endereco_pk` PRIMARY KEY (`cep`),
  CONSTRAINT `bairro_nome_fk` FOREIGN KEY (`bairro_nome`) REFERENCES bairro(`nome`) ON UPDATE CASCADE,
  CONSTRAINT `cidade_fk` FOREIGN KEY (`cidade_nome`, `cidade_estado`) REFERENCES cidade(`nome`, `estado`) ON UPDATE CASCADE
) ENGINE=InnoDB;
") or die(mysql_error());

echo "Tabela endereco Instalada com sucesso<br>";

mysql_query("
CREATE TABLE IF NOT EXISTS `pessoa` (
  `id` INT AUTO_INCREMENT NOT NULL,
  `cpf` VARCHAR(14),
  `nome` VARCHAR(100) NOT NULL,
  `rg` VARCHAR(45),
  `sexo` CHAR,
  `data_nascimento` DATE,
  `data_cadastro` DATE,
  `data_saida` DATE,  
  `endereco_cep` VARCHAR(8) NOT NULL,
  `id_conjuge` INT,
  CONSTRAINT `pessoa_pk` PRIMARY KEY (`id`),
  CONSTRAINT `conjuge_fk` FOREIGN KEY (`id_conjuge`) REFERENCES pessoa(`id`),
  CONSTRAINT `endereco_cep_fk` FOREIGN KEY (`endereco_cep`) REFERENCES endereco(`cep`)
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
CREATE TABLE IF NOT EXISTS `pesssoa_has_programa` (
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
  `parentesco` VARCHAR(45) NOT NULL,
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
  `situacao_matricula` TINYTEXT NOT NULL,
  CONSTRAINT `curso_has_pessoa_pk` PRIMARY KEY(`id_pessoa`, `id_curso`),
  CONSTRAINT `curso_has_pessoa_id_pessoa_fk` FOREIGN KEY(`id_pessoa`) REFERENCES pessoa(`id`),
  CONSTRAINT `curso_has_pessoa_id_curso_fk` FOREIGN KEY(`id_curso`) REFERENCES curso(`id`)
) ENGINE=InnoDB;
") or die(mysql_error());

echo "Tabela curso_has_pessoa Instalada com sucesso<br>";

?>