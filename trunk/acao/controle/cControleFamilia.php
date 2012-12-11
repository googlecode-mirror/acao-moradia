<?php

    $query= $_POST['id_familia'];
    
    $tamanhoPesquisa = strlen($query);    
    $parametro = substr($query, $tamanhoPesquisa-1, $tamanhoPesquisa - 1);//detecta q operação deve-se fazer: (a= add pessoa à familia, e= editar familia e d= deletar familia)
    $id_familia = substr($query, 0, $tamanhoPesquisa-1);
    echo $query.'</br>';
    echo $parametro.'</br>';
    echo $id_familia;
    
    if($parametro === 'a'){
        session_start();
        $_SESSION['id_familia']= $id_familia;
        header("Location: ../visao/vCadastroPessoaComFamilia2.php");
    }
     elseif($parametro === 'e'){
        session_start();
        $_SESSION['id_familia']= $id_familia;
        header("Location: ../visao/vEditaFamilia.php");
    }
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
