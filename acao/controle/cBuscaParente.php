<?php

include_once 'bd/DBConnection.php';
include_once 'bd/PessoaDAO.php';
DataBase::createConection();
$nome = $_GET['parente'];
$pessoaDAO = new PessoaDAO();
$vet = $pessoaDAO->buscaPessoa($nome);

$_POST['vetor'] = '$vet';
header("Location: visao/vCadastroPessoa.php?mess= login ou senha incorreta");
?>
