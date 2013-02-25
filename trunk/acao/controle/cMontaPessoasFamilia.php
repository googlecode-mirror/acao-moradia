<?php
    require_once '../bd/PessoaDAO.php';
    $pessoaDAO = new PessoaDAO();
    $id_familia = $_POST['id_familia'];    
    $pessoas = $pessoaDAO->buscaPessoabyIdFamilia($id_familia);
    while($pessoa = mysql_fetch_assoc($pessoas)){
        if($pessoa['grau_parentesco'] != TITULAR)
        echo $pessoa['nome']."<br>";
    }
    
?>
