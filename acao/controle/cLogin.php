<?php	
    include_once '../bd/LoginDAO.php';    
    include_once '../modelo/Modelo.php';    

    $login = $_POST['log'];
    $pass = $_POST['password'];
    
    $lDao= new LoginDAO();
    $vet= $lDao->buscaLogin($login, $pass);

    if(sizeof($vet)>1){//resultado de consulta com usuário valido encontrado
        $lTemp= new Login($vet['usuario'], $vet['senha'], $vet['nivel']);
        session_start();
        $_SESSION['nivel']= $lTemp->getNivel();
        $_SESSION['usuario']= $lTemp->getUser();
        
        if($lTemp->getNivel() === "ATENDENTE")
            header("Location: ../visao/vAtendente.php");
        elseif ($lTemp->getNivel() === "ADMIN") {
            header("Location: ../visao/vAtendente.php");
            //header("Location: ../visao/vAdmin.php");
        }
    }elseif(sizeof($vet)<2){            
       header("Location: ../visao/vLogin.php?mess= login ou senha incorreta");//resultado vazio de consulta
       echo 'nao encontrado';           
    }else{		
       header("Location: ../visao/vLogin.php?mess= login ou senha incorreta");//erro desconhecido ounulo
    }		    
?>
