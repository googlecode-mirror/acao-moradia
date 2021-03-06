<?php
    /**
     * Classes de modelo - apenas construtores, gets e sets.
     */
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
        private $idPessoa;
        private $idFamilia;
        private $cidadeNatal;        
        private $nome;
        private $cpf;
        private $rg;
        private $sexo;
        private $dataNascimento;
        private $dataCadastro;
        private $dataSaida;
        private $telefone;
        private $grauParentesco;
        private $estadoCivil;
        private $raca;
        private $religiao;
        private $carteiraProfissional;
        private $tituloEleitor;
        private $certidaoNascimento;                  
        private $ativo;
        private $nis;
        
        function __construct(
                $idFamilia, $cidadeNatal, $nome, $cpf, $rg, $sexo, $dataNascimento, 
                $telefone, $grauParentesco, $estadoCivil, $raca, $religiao, 
                $carteiraProfissional, $tituloEleitor, $certidaoNascimento, $nis) {            
            $this->idFamilia = $idFamilia;
            $this->cidadeNatal = $cidadeNatal;            
            $this->nome = $nome;
            $this->cpf = $cpf;
            $this->rg = $rg;
            $this->sexo = $sexo;
            $this->dataNascimento = $dataNascimento;
            $this->telefone = $telefone;
            $this->grauParentesco = $grauParentesco;
            $this->estadoCivil = $estadoCivil;
            $this->raca = $raca;
            $this->religiao = $religiao;
            $this->carteiraProfissional = $carteiraProfissional;
            $this->tituloEleitor = $tituloEleitor;
            $this->certidaoNascimento = $certidaoNascimento;
            $this->nis = $nis;
        }

        public function getAtivo() {
            return $this->ativo;
        }

        public function setAtivo($ativo) {
            $this->ativo = $ativo;
        }
        
        public function getIdPessoa() {
            return $this->idPessoa;
        }

        public function setIdPessoa($idPessoa) {
            $this->idPessoa = $idPessoa;
        }

        public function getIdFamilia() {
            return $this->idFamilia;
        }

        public function setIdFamilia($idFamilia) {
            $this->idFamilia = $idFamilia;
        }

        public function getCidadeNatal() {
            return $this->cidadeNatal;
        }

        public function setCidadeNatal($cidadeNatal) {
            $this->cidadeNatal = $cidadeNatal;
        }       

        public function getNome() {
            return $this->nome;
        }

        public function setNome($nome) {
            $this->nome = $nome;
        }

        public function getCpf() {
            return $this->cpf;
        }

        public function setCpf($cpf) {
            $this->cpf = $cpf;
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

        public function getTelefone() {
            return $this->telefone;
        }

        public function setTelefone($telefone) {
            $this->telefone = $telefone;
        }

        public function getGrauParentesco() {
            return $this->grauParentesco;
        }

        public function setGrauParentesco($grauParentesco) {
            $this->grauParentesco = $grauParentesco;
        }

        public function getEstadoCivil() {
            return $this->estadoCivil;
        }

        public function setEstadoCivil($estadoCivil) {
            $this->estadoCivil = $estadoCivil;
        }

        public function getRaca() {
            return $this->raca;
        }

        public function setRaca($raca) {
            $this->raca = $raca;
        }

        public function getReligiao() {
            return $this->religiao;
        }

        public function setReligiao($religiao) {
            $this->religiao = $religiao;
        }

        public function getCarteiraProfissional() {            
            return $this->carteiraProfissional;
        }

        public function setCarteiraProfissional($carteiraProfissional) {
            $this->carteiraProfissional = $carteiraProfissional;
        }

        public function getTituloEleitor() {
            return $this->tituloEleitor;
        }

        public function setTituloEleitor($tituloEleitor) {
            $this->tituloEleitor = $tituloEleitor;
        }

        public function getCertidaoNascimento() {
            return $this->certidaoNascimento;
        }

        public function setCertidaoNascimento($certidaoNascimento) {
            $this->certidaoNascimento = $certidaoNascimento;
        }
        
        public function getNIS() {
            return $this->nis;
        }

        public function setNIS($nis) {
            $this->nis = $nis;
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
        
        function __construct($nome, $vagas, $dataInicio, $cargaHoraria, $preRequisitos, $diasSemana, $dataTermino) {            
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
    
    class Telefone{
        
        private $id_familia;
        private $numero;
        private $falar_com;
        
        function __construct($id_familia, $numero, $falar_com) {
            $this->id_familia = $id_familia;
            $this->numero = $numero;
            $this->falar_com = $falar_com;
        }
        
        public function getIdFamilia() {
            return $this->id_familia;
        }

        public function setIdFamilia($id_familia) {
            $this->idPessoa = $id_familia;
        }

        public function getNumero() {
            return $this->numero;
        }

        public function setNumero($numero) {
            $this->numero = $numero;                    
        }

        public function getFalarCom() {
            return $this->falar_com;
        }

        public function setFalarCom($nome) {
            $this->falar_com = $nome;                    
        }
        
        
    }    
    
    class Familia{
        private $idFamilia;
        private $cep;
        private $logradouro;
        private $numero;
        private $bairro;
        private $cod_cidade;           
        public static $id_familia;
        
        function __construct($cep, $logradouro, $numero, $bairro, $cod_cidade) {            
            $this->cep = $cep;
            $this->logradouro = $logradouro;
            $this->numero = $numero;
            $this->bairro = $bairro;
            $this->cod_cidade = $cod_cidade;                        
        }
        
        public function getIdFamilia() {
            return $this->idFamilia;
        }

        public function setIdFamilia($idFamilia) {
            $this->idFamilia = $idFamilia;
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

        public function getBairro() {
            return $this->bairro;
        }

        public function setBairro($bairro) {
            $this->bairro = $bairro;
        }

        public function getCodCidade() {
            return $this->cod_cidade;
        }

        public function setCodCidade($cod_cidade) {
            $this->cod_cidade = $cod_cidade;
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
