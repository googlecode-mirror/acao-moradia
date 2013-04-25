<?php

include_once 'cFuncoes.php';
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";

include_once '../modelo/Modelo.php';
include_once '../bd/PessoaHasProgramaDAO.php';

$idPessoa = $_POST['idPessoa'];
$idPrograma = $_POST['idPrograma'];

$pessoaHasProgramaDAO = new PessoaHasProgramaDAO();
$pessoaHasProgramaDAO->cadastraPessoaHasPrograma($idPessoa, $idPrograma);
header("Location: ../visao/vRelatorioPrograma.php?id_programa=$idPrograma&id_pessoa=$idPessoa");
?>
