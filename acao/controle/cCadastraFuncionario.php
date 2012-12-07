<?php

include_once 'cFuncoes.php';
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";

include_once '../modelo/Modelo.php';
include_once '../bd/LoginDAO.php';


$usuario = $_POST['usuario'];
$senha = $_POST['senha'];
$nivel = $_POST['nivel'];


$login = new Login($usuario, $senha, $nivel);
$loginDAO = new LoginDAO();
$retorno = $loginDAO->cadastraLogin($login);

if ($retorno != TRUE) {
    echo "<script>alert('Falha ao cadastrar!');location.href='../visao/vCadastroFuncionario.php';</script>";
} else {
    echo "<script>alert('Cadastrado com sucesso!');location.href='../visao/vAtentente.php';</script>";
}
?>