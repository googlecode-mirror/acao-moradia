<?php

include_once 'cFuncoes.php';
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";

include_once '../modelo/Modelo.php';
include_once '../bd/CursoHasPessoaDAO.php';

$idPessoa = $_POST['idPessoa'];
$idCurso = $_POST['idCurso'];

$cursoHasPessoaDAO = new CursoHasPessoaDAO();
$cursoHasPessoaDAO->cadastraCursoHasPessoa($idPessoa, $idCurso);
header("Location: ../visao/vRelatorioCurso.php?id_curso=$idCurso");
?>
