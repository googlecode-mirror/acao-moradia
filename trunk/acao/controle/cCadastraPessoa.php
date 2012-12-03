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
    
    DataBase::createConection();    
    //$etapa_concluida = $_GET['et'];
    $CPrograma = new CPrograma();
    $programas = $CPrograma->buscaTodosProgramas(); 
    $pD= new PessoaDAO();
    
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
    $id_familia= Familia::$id_familia;
     echo 'locura: '.$id_familia.'</br>';
    $pD->cadastraPessoa($id_familia, $cod_cidade_Natal, $nome, $cpf, $rg, $sexo, $dataNascimento, $telefone, $grauParentesco, $estadoCivil, $raca, $religiao, $carteiraProfissional, $tituloEleitor, $certidaoNascimento);
     /*
    while($programa = mysql_fetch_array($programas)){
         echo $_GET[$programa['id_programa']];
    }*/
    
    
    /*
    if($etapa_concluida == 2){//se ele fez até a etapa de cadastro familiar                                                                               
        
        //cadastra o bairro
        $bairroDAO = new BairroDAO();
        $bairroDAO->cadastraBairro($_GET['bairro']);        
                        
        //cadastra a familia
        $familia = new Familia($_GET['cep'],$_GET['logradouro'],$_GET['numero'],$_GET['bairro'],$_GET['cidade']);
        
        $familiaDAO = new FamiliaDAO();
        $res = $familiaDAO->cadastraFamilia_2($familia);
        
        if($res === FALSE){
            echo "Erro ao cadastrar familia";
            exit();
        }
        
        //cadastra a pessoa(que neste caso e o titular)
        $pessoa = new Pessoa(
                $familia->getIdFamilia(), $_GET['cidadeNatal'],$_GET['nome'], $_GET['cpf'], 
                $_GET['rg'], $_GET['sexo'], $_GET['dataNascimento'], $_GET['telefone'], 'TITULAR',
                $_GET['estadoCivil'],$_GET['raca'],$_GET['religiao'], $_GET['carteiraProfissional'],
                $_GET['tituloEleitor'],$_GET['certidaoNascimento']);
        
        $pessoaDAO = new PessoaDAO();
        $res = $pessoaDAO->cadastraPessoa_2($pessoa);
        
        if($res === FALSE){
            echo "Erro ao cadastrar familia";
            exit();
        }
        
        //cadastra os programas que o titular participa
        if(isset($_GET['programas'])){//se existem programas            
            $programas = $_GET['programas'];
            foreach ($programas as $programa){
                $pessoaHasProgramaDAO = new pessoaHasProgramaDAO();
                $pessoaHasProgramaDAO->cadastraPessoaHasPrograma($pessoa->getIdPessoa(), $programa);
            }
        }                     
                
    }else{
        if($etapa_concluida == 3){//se ele fez até a etapa de pesquisa socio-economica
            
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
  */  
    //header("Location: cCadastraCursos.php");//mudar p cadastro pt 2
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
        //if($tep === true){*/
?>