<?php

//galera, estou editando aqui, esta errado pq eu estou aprendendo, assim que estiver certo eu dou outro subversion --bruno

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
    
       // corrigir isso aqui depois 
       // $pDAO = new pDAO();
       // $tep= $pDAO->cadastraFuncionario( $usuario, $senha, $nivel);

     
?>