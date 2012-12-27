<?php
    include_once '../bd/FamiliaDAO.php';
    $query= $_POST['id_familia'];    
    $tamanhoPesquisa = strlen($query);    
    $parametro = substr($query, $tamanhoPesquisa-1, $tamanhoPesquisa - 1);//detecta q operação deve-se fazer: (a= add pessoa à familia, e= editar familia e d= deletar familia)
    $id_familia = substr($query, 0, $tamanhoPesquisa-1);
    echo $query.'</br>';
    echo $parametro.'</br>';
    echo $id_familia.'</br>';
    
    if($parametro === 'a'){
        session_start();
        $_SESSION['id_familia']= $id_familia;
        header("Location: ../visao/vCadastroPessoaComFamilia2.php");
    }elseif($parametro === 'e'){
        session_start();
        $_SESSION['id_familia']= $id_familia;
        header("Location: ../visao/vEditaFamilia.php");
    }elseif($parametro === 'd'){
        $familiaDAO = new FamiliaDAO();
        $res = $familiaDAO->removeFamiliaById($id_familia);
        if($res){
            echo 'Família removida com sucesso';
        }else{
            echo 'Erro ao remover família '.$res;
        }
    }
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>