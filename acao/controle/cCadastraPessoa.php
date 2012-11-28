<?php
    include_once 'cFuncoes.php';
    echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
    include_once '../modelo/Modelo.php';
    include_once '../bd/BairroDAO.php';
    include_once '../bd/PessoaDAO.php';
    include_once '../bd/DBConnection.php';
    
    session_start();
    $_SESSION['nome']= $_GET['nome'];//
    $_SESSION['cpf']= $_GET['cpf'];//
    $_SESSION['rg']= $_GET['rg'];//
    $sexo= $_GET['sexo'];
    
    if($sexo === "Masculino")
        $_SESSION['sexo']= 'M';//
    elseif ($sexo === "Feminino") 
        $_SESSION['sexo']= 'F';//  
    
    $dataNascimento= $_GET['dataNascimento'];
    $_SESSION['dataNascimento']= Date::toMySqlDate($dataNascimento);

    //pegando a data de cadastro do sistema
    //date_default_timezone_set('America/Sao_Paulo');
    //$dataCadastro= date('m/d/Y');
    
    $_SESSION['telefone']= $_GET['telefone'];
    
     header("Location: cCadastraCursos.php");//mudar p cadastro pt 2
    /*
    $logradouro= $_GET['logradouro'];
    $numero= $_GET['numero'];
    $cidadeNome= $_GET['cidade'];
    $bairroNome= $_GET['bairro'];
    $cidadeEstado= $_GET['estado'];
    $cep= $_GET['cep'];
    $idConjuge = "NULL";
    */
    //$idPessoa= 01;
    
   /* DataBase::createConection();
    
    /*
     procura se ja existe uma familia com este endereço, se jah, retorna tds os atributos dela p preencher os campos...
     * se naum, da a opção de criar a familia
     */
    
    //enquanto endereços
    /*$bairroClass= new Bairro($bairroNome);//persistir bairro
    $bDao= new BairroDAO();
    $vet= $bDao->buscaBairro($bairroNome);
    if(sizeof($vet)>0){    
        //echo $vet['nome'];
        $cidadeClass= new Cidade($cidadeNome, $cidadeEstado);//persistir cidade
        //enquanto telefones
        //$telefonrClass= new Telefone($idPessoa, $numero);//persistir telefone
    
        //$endereco= new Endereco($cep, $logradouro, $numero, $bairroClass, $cidadeClass, $cidadeEstado);//persistir endereço
   
        //fazer uma validação de cpf...    
    
        //$pessoa= new Pessoa($idPessoa, $cpf, $nome, $rg, $sexo, $dataNascimento, $dataCadastro, $dataSaida, $cep, null);
        $pDAO= new PessoaDAO();
        $tep= $pDAO->cadastraPessoa( $cpf, $nome, $rg, $sexo, $dataNascimento, $idConjuge, $cep, $logradouro, $numero);*/
        //if($tep === true){
?>