<?php
    $possui_familia_cadastrada = $_GET['op'];  //sim ou nao
    $familia = $_GET['familia'];    //nº da familia ou nome do titular
    
    echo $possui_familia_cadastrada;
    
    if($possui_familia_cadastrada == "sim"){//se possui familia cadastrada
        //buscar no banco a familia
    }else{
        header("Location: ../visao/vCadastroPessoa.php?msg=Do titular&etapas=3");
    }        
    
?>
