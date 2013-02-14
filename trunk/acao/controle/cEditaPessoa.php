<?php
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";

    $nome           = $_POST['nome'];
    $cpf            = $_POST['cpf'];
    $rg             = $_POST['rg'];
    $sexo           = $_POST['sexo'];
    $telefone       = $_POST['telefone'];
    $dataNascimento = $_POST['dataNascimento'];
    $estadoNatal    = $_POST['estadoNatal'];
    $cidadeNatal    = $_POST['cidadeNatal'];
    $estadoCivil    = $_POST['estadoCivil'];
    $raca           = $_POST['raca'];
    $religiao       = $_POST['religiao'];
    $carteiraProfissional   = $_POST['carteiraProfissional'];
    $certidaoNascimento     = $_POST['certidaoNascimento'];
    $tituloEleitor          = $_POST['tituloEleitor'];
    $grauParentesco         = $_POST['grauParentesco'];
    $cep                    = $_POST['cep'];
    $logradouro             = $_POST['logradouro'];
    $numero         = $_POST['numero'];
    $estado         = $_POST['estado'];
    $cidade         = $_POST['cidade'];
    $bairro         = $_POST['bairro'];
    $telefone_residencial   = $_POST['telefone_residencial'];
     
    //para programas:
    
    //pegar todos os programas que a pessoa possui
    //se eles estão na nova lista de programas 
        //nao faz nada
    //senão, remove eles    
    //pega todos os programas na nova lista e insere eles
    
    //cadastra os programas que o titular participa
//    if(isset($_POST['programa'])){//se existem programas            
//        $programas = $_POST['programa'];
//        foreach ($programas as $programa){
//            $pessoaHasProgramaDAO = new pessoaHasProgramaDAO();
//            $pessoaHasProgramaDAO->cadastraPessoaHasPrograma($pessoa->getIdPessoa(), $programa);
//        }
//    }
    
                        
/*
    include_once '../modelo/Modelo.php';
    include_once '../bd/BairroDAO.php';
    include_once '../bd/CidadeDAO.php';
    include_once '../bd/DBConnection.php';
    include_once '../bd/FamiliaDAO.php';
    include_once '../bd/PessoaDAO.php';
    include_once '../bd/PessoHasProgramaDAO.php';
    include_once '../bd/TelefoneDAO.php';
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
        }else{
            if(isset($_POST['telefone_residencial'])){
                $tel = $_POST['telefone_residencial'];
                $TelefoneDAO = new TelefoneDAO();
                $TelefoneDAO->cadastraTelefone($tel, $familia->getIdFamilia(), ''); 
            }
        }               
        
    }else{
        //echo $_POST['idFamilia'];
        $familia = new Familia("","","","","");
        $familia->setIdFamilia($_POST['idFamilia']);
    }
        
    //se existe grauParentesco não estou cadastrando um TITULAR!
    if(isset($_POST['grauParentesco'])){    
        $grauParentesco = $_POST['grauParentesco'];
    }else{
        $grauParentesco = "TITULAR";
    }
        
    //cadastra a pessoa
    $pessoa = new Pessoa(
            $familia->getIdFamilia(), $_POST['cidadeNatal'],$_POST['nome'], $_POST['cpf'], 
            $_POST['rg'], $_POST['sexo'], $_POST['dataNascimento'], $_POST['telefone'], $grauParentesco,
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
                        
    $proxima_etapa = $_POST['et'];
    
    if($proxima_etapa == "2"){//o usuario quer incluir outras pessoas
        $familiaDAO = new FamiliaDAO();
        header("Location: ../visao/vCadastroPessoa.php?et=".$proxima_etapa."&family=".$familia->getIdFamilia()."&titular=".$familiaDAO->getNomeTitularFamiliaByIdFamilia($familia->getIdFamilia()));                        
    }else{
        if($proxima_etapa == "3"){//o usuario vai para etapa de pesquisa                                            
            header("Location: ../visao/vPesquisaSocioEconomica.php");
        }
    }
  */  
?>