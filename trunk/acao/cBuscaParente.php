<?php

include_once 'dBConection.php';
include_once 'pessoaDAO.php';
DataBase::createConection();
$nome = $_GET['parente'];
$pessoaDAO = new PessoaDAO();
$vet = $pessoaDAO->buscaPessoa($nome);

$_POST['vetor'] = '$vet';
header("Location: vCadastroPessoa.php?mess= login ou senha incorreta");
?>
