<?php
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";
    require_once '../bd/PessoaHasProgramaDAO.php';
    require_once '../bd/PessoaDAO.php';
    require_once '../bd/FamiliaDAO.php';
    require_once '../bd/BairroDAO.php';
    require_once '../bd/TelefoneDAO.php';
    require_once '../modelo/Modelo.php';
    require_once '../controle/cFuncoes.php';
    
    $ativo                  = $_POST['ativo'];    
    $id_pessoa              = $_POST['idPessoa'];
    $nome                   = $_POST['nome'];
    $cpf                    = $_POST['cpf'];
    $rg                     = $_POST['rg'];
    $sexo                   = $_POST['sexo'];    
    $telefone               = $_POST['telefone'];
    $dataNascimento         = Funcoes::toMySqlDate($_POST['dataNascimento']);
    //$estadoNatal            = $_POST['estadoNatal'];
    $cidadeNatal            = $_POST['cidadeNatal'];
    $estadoCivil            = $_POST['estadoCivil'];
    $raca                   = $_POST['raca'];
    $religiao               = $_POST['religiao'];
    $carteiraProfissional   = $_POST['carteiraProfissional'];    
    $certidaoNascimento     = $_POST['certidaoNascimento'];    
    $tituloEleitor          = $_POST['tituloEleitor'];
    $grauParentesco         = $_POST['grauParentesco'];
    $cep                    = $_POST['cep'];
    $logradouro             = $_POST['logradouro'];
    $numero                 = $_POST['numero'];
    //$estado                 = $_POST['estado'];
    $cidade                 = $_POST['cidade'];
    $bairro                 = $_POST['bairro'];
    $telefone_residencial   = $_POST['telefone_residencial'];
    $id_familia             = $_POST['idFamilia'];            
    $nis                    = $_POST['nis'];
    
    $pessoaHasProgramaDAO   = new PessoaHasProgramaDAO();
    $pessoaDAO              = new PessoaDAO();
    $familiaDAO             = new FamiliaDAO();
    $bairroDAO              = new BairroDAO();    
    
    //pegar todos os programas que a pessoa possui
    $programas_pessoas = $pessoaHasProgramaDAO->buscaProgramasById($id_pessoa);
    $programas_antigos = array();//programas antigos
    while($aux = mysql_fetch_assoc($programas_pessoas)){
        $programas_antigos[$aux['id_programa']] = $aux['id_programa'];
    }    
    //pega a lista de programas
    //
    //programas novos que nao estao em programas antigos são inseridos
    //
    //programas novos que estão em programs antigos não faz nada
    //
    //programas antigos que nao estao em novos sao removidos    
    //pega a lista de programas da pessoa
    if(isset($_POST['programa'])){//se existem programas
        $programas_novos = $_POST['programa'];//pega a lista de programas novos
        foreach ($programas_novos as $programa){
            if(!in_array($programa, $programas_antigos)){//se o programa novo não está na lista de programas antigos add
               $pessoaHasProgramaDAO->cadastraPessoaHasPrograma($id_pessoa, $programa);
               echo "O programa antigo não está na lista de programas novos<br>";
               echo "o programa novo não está na lista de programas antigos add<br>";
               
            }
        }    
        foreach ($programas_antigos as $programa){            
            if(!in_array($programa, $programas_novos)){//se o programa antigo não está na lista de programas novo rem
                $pessoaHasProgramaDAO->remove($id_pessoa, $programa);
                echo "O programa novo $programa não está na lista de programas antigos vamos inseri-lo";
                echo "o programa antigo não está na lista de programas novo rem<br>";
            }
        }
    }else{
        $pessoaHasProgramaDAO->removeTodosProgramas($id_pessoa);//remove todos os programas
        echo "DEletando tudo";
    }      
            
    $bairroDAO->cadastraBairro($bairro);
    
    $familia = new Familia($cep,$logradouro,$numero,$bairro,$cidade);
    $familia->setIdFamilia($id_familia);    

    $TelefoneDAO = new TelefoneDAO();
    $telefone_antigo = $TelefoneDAO->buscaTelefoneByIdFamilia($id_familia);

    if(mysql_numrows($telefone_antigo)>0){//se tinha telefone cadastrado        
        $tel_antigo = mysql_fetch_assoc($telefone_antigo);
        if($telefone_residencial == ''){//e agora não tem mais
            echo "agora não tem mais";
            $TelefoneDAO->removeTelefoneByNumero($tel_antigo['telefone']);//remove
        }else{//se ainda tem, atualiza
            echo "ainda tem";
            $Telefone_novo = new Telefone($id_familia, $telefone_residencial, '');
            $TelefoneDAO->alteraDadosTelefone($Telefone_novo,$tel_antigo['telefone']);
        }
    }else{//se nao tinha telefone
        echo "não tinha telefone";
        if($telefone_residencial != ""){//agora vai ter            
            $TelefoneDAO->cadastraTelefone($telefone_residencial, $id_familia, '');            
        }
    }
    
    $familiaDAO->alteraDadosFamilia($familia);
    
    
    //cadastra a pessoa
    $pessoa = new Pessoa(
            $id_familia, $cidadeNatal, $nome, $cpf, 
            $rg, $sexo, $dataNascimento, $telefone, $grauParentesco,
            $estadoCivil,$raca,$religiao, $carteiraProfissional,
            $tituloEleitor, $certidaoNascimento, $nis);
    $pessoa->setIdPessoa($id_pessoa);  
    $pessoa->setAtivo($ativo);
  
    $res = $pessoaDAO->alteraDadosPessoa($pessoa);

    if($res === FALSE){
        echo "Erro ao cadastrar";
        exit();
    }else{
        header("Location: ../visao/vPessoa.php");
    }
    
    /*
    //cadastra o bairro        

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
    }*/
                    
                        
/*
    include_once '../modelo/Modelo.php';
    include_once '../bd/BairroDAO.php';
    include_once '../bd/CidadeDAO.php';
    include_once '../bd/DBConnection.php';
    include_once '../bd/FamiliaDAO.php';
    include_once '../bd/PessoaDAO.php';
    include_once '../bd/PessoaHasProgramaDAO.php';
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