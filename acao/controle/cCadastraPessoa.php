<?php

    include_once '../modelo/Modelo.php';
    include_once '../bd/BairroDAO.php';
    include_once '../bd/CidadeDAO.php';
    include_once '../bd/DBConnection.php';
    include_once '../bd/FamiliaDAO.php';
    include_once '../bd/PessoaDAO.php';
    include_once '../bd/PessoHasProgramaDAO.php';
    include_once 'cListaProgramas.php';
    include_once 'cFuncoes.php';    
        
    if(!isset($_POST['idFamilia'])){//se nao existe familia        
        //cadastra o bairro
        $bairroDAO = new BairroDAO();
        $bairroDAO->cadastraBairro($_POST['bairro']);        
                        
        //cadastra a familia
        $familia = new Familia($_POST['cep'],$_POST['logradouro'],$_POST['numero'],$_POST['bairro'],$_POST['cidade']);
        
        $familiaDAO = new FamiliaDAO();
        $res = $familiaDAO->cadastraFamilia_2($familia);
        
        if($res === FALSE){
            echo "Erro ao cadastrar familia";
            exit();
        }                
    }else{
        echo $_POST['idFamilia'];
        $familia = new Familia("","","","","");
        $familia->setIdFamilia($_POST['idFamilia']);
    }
        
    //se existe grauParentesco não estou cadastrando um TITULAR!
    if(isset($_POST['grauParentesco'])){    
        $grauParentesco = $_POST['grauParentesco'];
    }else{
        $grauParentesco = "TITULAR";
    }
    
    $dataNascimento = Funcoes::toMySqlDate($_POST['dataNascimento']);
    echo $dataNascimento;
    include_once '../bd/Debug.php';
    Debug::gravaEmArquivo($dataNascimento);
    //cadastra a pessoa
    $pessoa = new Pessoa(
            $familia->getIdFamilia(), $_POST['cidadeNatal'],$_POST['nome'], $_POST['cpf'], 
            $_POST['rg'], $_POST['sexo'], $dataNascimento, $_POST['telefone'], $grauParentesco,
            $_POST['estadoCivil'],$_POST['raca'],$_POST['religiao'], $_POST['carteiraProfissional'],
            $_POST['tituloEleitor'],$_POST['certidaoNascimento']);

    $pessoaDAO = new PessoaDAO();
    $res = $pessoaDAO->cadastraPessoa_2($pessoa);

    if($res === FALSE){
        echo "Erro ao cadastrar";
        exit();
    }

    //cadastra os programas que o titular participa
    if(isset($_POST['programa'])){//se existem programas            
        $programas = $_POST['programa'];
        foreach ($programas as $programa){
            $pessoaHasProgramaDAO = new pessoaHasProgramaDAO();
            $pessoaHasProgramaDAO->cadastraPessoaHasPrograma($pessoa->getIdPessoa(), $programa);
        }
    }                     
                        
    $etapa_concluida = $_POST['et'];
    echo $etapa_concluida ;
    
    if($etapa_concluida == "2"){//o usuario quer incluir outras pessoas
        header("Location: ../visao/vCadastroPessoa.php?et=".$etapa_concluida."&family=".$familia->getIdFamilia()."&titular=".$pessoa->getNome());                        
    }else{
        if($etapa_concluida == "3"){//o usuario vai para etapa de pesquisa                                            
            header("Location: ../visao/vPesquisa.php");
        }
    }
    

/*
    include_once 'cFuncoes.php';
    echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
    include_once '../modelo/Modelo.php';
    include_once '../bd/BairroDAO.php';
    include_once '../bd/PessoaDAO.php';
    include_once '../bd/DBConnection.php';
    
    session_start();
    $_SESSION['nome']= $_POST['nome'];//
    $_SESSION['cpf']= $_POST['cpf'];//
    $_SESSION['rg']= $_POST['rg'];//
    $sexo= $_POST['sexo'];
    
    if($sexo === "Masculino")
        $_SESSION['sexo']= 'M';//
    elseif ($sexo === "Feminino") 
        $_SESSION['sexo']= 'F';//  
    
    $dataNascimento= $_POST['dataNascimento'];
    $_SESSION['dataNascimento']= Date::toMySqlDate($dataNascimento);

    //pegando a data de cadastro do sistema
    //date_default_timezone_set('America/Sao_Paulo');
    //$dataCadastro= date('m/d/Y');
    
    $_SESSION['telefone']= $_POST['telefone'];
  */  
    //header("Location: cCadastraCursos.php");//mudar p cadastro pt 2
    /*
    $logradouro= $_POST['logradouro'];
    $numero= $_POST['numero'];
    $cidadeNome= $_POST['cidade'];
    $bairroNome= $_POST['bairro'];
    $cidadeEstado= $_POST['estado'];
    $cep= $_POST['cep'];
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
        //if($tep === true){*/
?>