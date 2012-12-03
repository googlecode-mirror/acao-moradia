<?php
    include_once '../modelo/Modelo.php';
    include_once '../bd/BairroDAO.php';
    include_once '../bd/CidadeDAO.php';
    include_once '../bd/DBConnection.php';
    include_once '../bd/FamiliaDAO.php';
    include_once '../bd/PessoaDAO.php';
    include_once '../bd/PessoHasProgramaDAO.php';
    include_once '../controle/cListaProgramas.php';
    include_once '../modelo/Modelo.php';
    include_once '../bd/PessoHasProgramaDAO.php';
    
    
    DataBase::createConection();    
    //$etapa_concluida = $_GET['et'];
    $CPrograma = new CPrograma();
   
    $pD= new PessoaDAO();
    $pHasp= new PessoaHasProgramaDAO();
    
    echo $nome= $_GET['nome'];
    echo $grauParentesco= $_GET['parentesco'];
    echo $cpf= $_GET['cpf'];
    echo $rg= $_GET['rg'];
    echo $sexo= $_GET['sexo'];
    echo $telefone= $_GET['telefone'];
    echo $dataNascimento= $_GET['dataNascimento'];
    echo $_GET['estadoNatal'];
    echo $cod_cidade_Natal= $_GET['cidadeNatal'];
    echo $estadoCivil= $_GET['estadoCivil'];
    echo $raca= $_GET['raca'];
    echo $religiao= $_GET['religiao'];
    echo $carteiraProfissional= $_GET['carteiraProfissional'];
    echo $certidaoNascimento= $_GET['certidaoNascimento'].'</br>';
    echo $tituloEleitor= $_GET['tituloEleitor'].'</br>';
    
   
    session_start();
    $id_familia= $_SESSION['id_familia'];
    echo 'locura: '.$id_familia.'</br>';
    
    $pessoa = new Pessoa(
                $id_familia, $_GET['cidadeNatal'],$_GET['nome'], $_GET['cpf'], 
                $_GET['rg'], $_GET['sexo'], $_GET['dataNascimento'], $_GET['telefone'], 'TITULAR',
                $_GET['estadoCivil'],$_GET['raca'],$_GET['religiao'], $_GET['carteiraProfissional'],
                $_GET['tituloEleitor'],$_GET['certidaoNascimento']);
    
    
    $pD->cadastraPessoa_2($pessoa);   
    
    if(isset($_GET['programa'])){//se existem programas            
        $programas = $_GET['programa'];
        foreach ($programas as $programa){
            $pessoaHasProgramaDAO = new pessoaHasProgramaDAO();
            $pessoaHasProgramaDAO->cadastraPessoaHasPrograma($pessoa->getIdPessoa(), $programa);
        }
    }
    //header("Location: ../visao/vCadastroCurso.php");
      
?>