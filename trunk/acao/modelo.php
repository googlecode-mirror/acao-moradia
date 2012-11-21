<?php
    class Login{
        
        private $usuario= "";
        private $senha= "";
        private $nivel= "";
        
        function __construct($usuario, $senha, $nivel) {
            $this->usuario = $usuario;
            $this->senha = $senha;
            $this->nivel = $nivel;
        }            
        
        public function getUser(){
            return $this->usuario;
        }   
        
        public function setUser($user){
            $this->usuario= $user;
        }
        
        public function getSenha(){
            return $this->senha;
        }  
        
        public function setSenha($pass){
            $this->senha= $pass;
        }
        
        public function getNivel(){
            return $this->nivel;
        }  
        
        public function setNivel($level){
            $this->nivel= $level;
        }
        
        public function isAdmin(){
            if($this->nivel === "admin"){
                return true;
        }
           return false;
        }
    }
    
    class Pessoa{
        
        private $id;
        private $cpf;
        private $nome;
        private $rg;
        private $sexo;
        private $dataNascimento;
        private $dataCadastro;
        private $dataSaida;
        private $idConjuge;
        private $enderecoCep;
        
        function __construct($id, $cpf, $nome, $rg, $sexo, $dataNascimento, $dataCadastro, $dataSaida, $idConjuge, $enderecoCep) {
            $this->id = $id;
            $this->cpf = $cpf;
            $this->nome = $nome;
            $this->rg = $rg;
            $this->sexo = $sexo;
            $this->dataNascimento = $dataNascimento;
            $this->dataCadastro = $dataCadastro;
            $this->dataSaida = $dataSaida;
            $this->idConjuge = $idConjuge;
            $this->enderecoCep = $enderecoCep;
        }      
      
        public function getId() {
            return $this->id;
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function getCpf() {
            return $this->cpf;
        }

        public function setCpf($cpf) {
            $this->cpf = $cpf;
        }

        public function getNome() {
            return $this->nome;
        }

        public function setNome($nome) {
            $this->nome = $nome;
        }

        public function getRg() {
            return $this->rg;
        }

        public function setRg($rg) {
            $this->rg = $rg;
        }

        public function getSexo() {
            return $this->sexo;
        }

        public function setSexo($sexo) {
            $this->sexo = $sexo;
        }

        public function getDataNascimento() {
            return $this->dataNascimento;
        }

        public function setDataNascimento($dataNascimento) {
            $this->dataNascimento = $dataNascimento;
        }

        public function getDataCadastro() {
            return $this->dataCadastro;
        }

        public function setDataCadastro($dataCadastro) {
            $this->dataCadastro = $dataCadastro;
        }

        public function getDataSaida() {
            return $this->dataSaida;
        }

        public function setDataSaida($dataSaida) {
            $this->dataSaida = $dataSaida;
        }

        public function getIdConjuge() {
            return $this->idConjuge;
        }

        public function setIdConjuge($idConjuge) {
            $this->idConjuge = $idConjuge;
        }

        public function getEnderecoCep() {
            return $this->enderecoCep;
        }

        public function setEnderecoCep($enderecoCep) {
            $this->enderecoCep = $enderecoCep;
        }        
    }
    
    class Curso{
        
        private $id;
        private $nome;
        private $vagas;
        private $dataInicio;
        private $cargaHoraria;
        private $preRequisitos;
        private $diasSemana;
        private $dataTermino;
        
        function __construct($id, $nome, $vagas, $dataInicio, $cargaHoraria, $preRequisitos, $diasSemana, $dataTermino) {
            $this->id = $id;
            $this->nome = $nome;
            $this->vagas = $vagas;
            $this->dataInicio = $dataInicio;
            $this->cargaHoraria = $cargaHoraria;
            $this->preRequisitos = $preRequisitos;
            $this->diasSemana = $diasSemana;
            $this->dataTermino = $dataTermino;
        }

        public function getId() {
            return $this->id;
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function getNome() {
            return $this->nome;
        }

        public function setNome($nome) {
            $this->nome = $nome;
        }

        public function getVagas() {
            return $this->vagas;
        }

        public function setVagas($vagas) {
            $this->vagas = $vagas;
        }

        public function getDataInicio() {
            return $this->dataInicio;
        }

        public function setDataInicio($dataInicio) {
            $this->dataInicio = $dataInicio;
        }

        public function getCargaHoraria() {
            return $this->cargaHoraria;
        }

        public function setCargaHoraria($cargaHoraria) {
            $this->cargaHoraria = $cargaHoraria;
        }

        public function getPreRequisitos() {
            return $this->preRequisitos;
        }

        public function setPreRequisitos($preRequisitos) {
            $this->preRequisitos = $preRequisitos;
        }

        public function getDiasSemana() {
            return $this->diasSemana;
        }

        public function setDiasSemana($diasSemana) {
            $this->diasSemana = $diasSemana;
        }

        public function getDataTermino() {
            return $this->dataTermino;
        }

        public function setDataTermino($dataTermino) {
            $this->dataTermino = $dataTermino;
        }
    }
    
    class Endereco{
        
        private $cep;
        private $logradouro;
        private $numero;
        private $bairroNome;
        private $cidadeNome;
        private $cidadeEstado;
        
        function __construct($cep, $logradouro, $numero, $bairroNome, $cidadeNome, $cidadeEstado) {
            $this->cep = $cep;
            $this->logradouro = $logradouro;
            $this->numero = $numero;
            $this->bairroNome = $bairroNome;
            $this->cidadeNome = $cidadeNome;
            $this->cidadeEstado = $cidadeEstado;
        }

        public function getCep() {
            return $this->cep;
        }

        public function setCep($cep) {
            $this->cep = $cep;
        }

        public function getLogradouro() {
            return $this->logradouro;
        }

        public function setLogradouro($logradouro) {
            $this->logradouro = $logradouro;
        }

        public function getNumero() {
            return $this->numero;
        }

        public function setNumero($numero) {
            $this->numero = $numero;
        }

        public function getBairroNome() {
            return $this->bairroNome;
        }

        public function setBairroNome($bairroNome) {
            $this->bairroNome = $bairroNome;
        }

        public function getCidadeNome() {
            return $this->cidadeNome;
        }

        public function setCidadeNome($cidadeNome) {
            $this->cidadeNome = $cidadeNome;
        }

        public function getCidadeEstado() {
            return $this->cidadeEstado;
        }

        public function setCidadeEstado($cidadeEstado) {
            $this->cidadeEstado = $cidadeEstado;
        }
    }
    
    class Bairro{
        
        private $nome;
        
        function __construct($nome) {
            $this->nome = $nome;
        }

        public function getNome() {
            return $this->nome;
        }

        public function setNome($nome) {
            $this->nome = $nome;
        }
    }
    
    class Cidade{
        
        private $nome;
        private $estado;
        
        function __construct($nome, $estado) {
            $this->nome = $nome;
            $this->estado = $estado;
        }
       
        public function getNome() {
            return $this->nome;
        }

        public function setNome($nome) {
            $this->nome = $nome;
        }

        public function getEstado() {
            return $this->estado;
        }

        public function setEstado($estado) {
            $this->estado = $estado;
        }

    }
    
    class Telefone{
        
        private $idPessoa;
        private $numero;
        
        function __construct($idPessoa, $numero) {
            $this->idPessoa = $idPessoa;
            $this->numero = $numero;
        }
        
        public function getIdPessoa() {
            return $this->idPessoa;
        }

        public function setIdPessoa($idPessoa) {
            $this->idPessoa = $idPessoa;
        }

        public function getNumero() {
            return $this->numero;
        }

        public function setNumero($numero) {
            $this->numero = $numero;
        }
    }
    
    class Programa{
        
        private $id;
        private $nome;
        
        function __construct($nome) {            
            $this->nome = $nome;
            //gerar o id usando um sequence;
        }
        
        function __construct2($id, $nome) {
            $this->id = $id;
            $this->nome = $nome;
        }

        public function getId() {
            return $this->id;
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function getNome() {
            return $this->nome;
        }

        public function setNome($nome) {
            $this->nome = $nome;
        }
    }
?>
