<?php

//galera, estou editando aqui, esta errado pq eu estou aprendendo, assim que estiver certo eu dou outro subversion --bruno

    include_once 'cFuncoes.php';
    echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";

    include_once 'modelo/Modelo.php';
    include_once 'bd/BDConnection.php';
    
    $usuario= $_GET['usuario'];
    $senha= $_GET['senha'];
    $nivel= $_GET['nivel'];
       
       // corrigir isso aqui depois 
       // $pDAO = new pDAO();
       // $tep= $pDAO->cadastraFuncionario( $usuario, $senha, $nivel);

     
?>