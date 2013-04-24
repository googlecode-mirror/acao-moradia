<?php
    $id_pessoa = $_GET['id_pessoa'];
    $id_programa  = $_GET['id_programa'];
   
    require_once '../bd/PessoaHasProgramaDAO.php';
    $pessoaHasProgramaDAO = new PessoaHasProgramaDAO();    
   
        
    $pessoaHasProgramaDAO->remove($id_pessoa,$id_programa) or die(mysql_error());
    header("Location: ../visao/vRelatorioPrograma.php?id_programa=$id_programa");    
?>
