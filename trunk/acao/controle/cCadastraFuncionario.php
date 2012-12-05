<?php


    include_once 'cFuncoes.php';
    echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";

    include_once '../modelo/Modelo.php';
    include_once '../bd/LoginDAO.php';
    
    
    $usuario= $_POST['usuario'];
    $senha= $_POST['senha'];
    $nivel= $_POST['nivel'];
    
        
    $login = new Login($usuario, $senha, $nivel);
    $loginDAO = new LoginDAO();
    $loginDAO->cadastraLogin($login);
    $retorno = $loginDAO->cadastraLogin($_res);
    
    if($retorno != TRUE){          
                echo "<script>alert('Falha ao cadastrar!');</script>";
                header("Location:../visao/vCadastroFuncionario.php");
                
                }
                else{                    
                    echo "<script>alert('Cadastrado com sucesso!');</script>";
                    header("Location:../visao/vAtentente.php");
        
    }
    
    
    
    
?>