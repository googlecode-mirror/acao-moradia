<?php	
    include_once 'LoginDAO.php';
    include_once 'dBConection.php';
    include_once 'modelo.php';
    include_once 'sessao.php';

    $login = $_POST['log'];
    $pass = $_POST['password'];
    DataBase::createConection();
    $lDao= new LoginDAO();
    $vet= $lDao->buscaLogin($login, $pass);

    if(sizeof($vet)>1){//resultado de consulta com usuário valido encontrado
        echo sizeof($vet);
        echo $vet['usuario'];
        echo $vet['nivel'];

        $lTemp= new Login($vet['usuario'], $vet['senha'], $vet['nivel']);
        session_start();
        $_SESSION['nivel']= $lTemp->getNivel();
        $_SESSION['usuario']= $lTemp->getUser();
        echo $_SESSION['nivel'];
        /*$lTemp->setUser($vet['usuario']);
        $lTemp->setSenha($vet['senha']);
        $lTemp->setNivel($vet['nivel']);*/
        //sessao::initeSession($lTemp);///passar campos texto

        if($lTemp->getNivel() === "ATENDENTE")
            header("Location: atendente.php");
        elseif ($lTemp->getNivel() === "ADMIN") {
            header("Location: admin.php");
        }
    }    

    elseif(sizeof($vet)<2){            
       header("Location: login.php?mess= login ou senha incorreta");//resultado vazio de consulta		
       echo 'nao encontrado';           
    }else{		
             header("Location: login.php?mess= login ou senha incorreta");//erro desconhecido ounulo
    }		
    //$vet= null;
?>
