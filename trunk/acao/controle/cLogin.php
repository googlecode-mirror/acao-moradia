<?php	
    include_once '../bd/LoginDAO.php';
    include_once '../bd/DBConnection.php';
    include_once '../modelo/Modelo.php';    

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
            header("Location: ../visao/vAtendente.php");
        elseif ($lTemp->getNivel() === "ADMIN") {
            header("Location: ../visao/vAdmin.php");
        }
    }    

    elseif(sizeof($vet)<2){            
       header("Location: ../visao/vLogin.php?mess= login ou senha incorreta");//resultado vazio de consulta		
       echo 'nao encontrado';           
    }else{		
             header("Location: ../visao/vLogin.php?mess= login ou senha incorreta");//erro desconhecido ounulo
    }		
    //$vet= null;
?>
