<?php
    include_once 'controleData.php';
    echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";

    include_once 'modelo.php';
    include_once 'bairroDAO.php';
    include_once 'pessoaDAO.php';
    include_once 'dBConection.php';
    
    $nome= $_GET['nome'];
    $cpf= $_GET['cpf'];
    $rg= $_GET['rg'];
    $sexo= $_GET['sexo'];
    
    if($sexo === "Masculino")
        $sexo= 'M';
    elseif ($sexo === "Feminino") 
        $sexo= 'F';   

    
    $dataNascimento= $_GET['dataNascimento'];
    $dataNascimento= Date::toMySqlDate($dataNascimento);

    //pegando a data de cadastro do sistema
    //date_default_timezone_set('America/Sao_Paulo');
    //$dataCadastro= date('m/d/Y');
    
    $telefone= $_GET['telefone'];
    
    $logradouro= $_GET['logradouro'];
    $numero= $_GET['numero'];
    $cidadeNome= $_GET['cidade'];
    $bairroNome= $_GET['bairro'];
    $cidadeEstado= $_GET['estado'];
    $cep= $_GET['cep'];
    $idConjuge = "NULL";

    
    
    //$idPessoa= 01;
    
    DataBase::createConection();
    


    /*
     procura se ja existe uma familia com este endereço, se jah, retorna tds os atributos dela p preencher os campos...
     * se naum, da a opção de criar a familia
     */

    
    //enquanto endereços
    $bairroClass= new Bairro($bairroNome);//persistir bairro
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
        $tep= $pDAO->cadastraPessoa( $cpf, $nome, $rg, $sexo, $dataNascimento, $idConjuge, $cep, $logradouro, $numero);
        if($tep === true){
            header("Location: cCadastraCursos.php");
        }
        
    }       
?>