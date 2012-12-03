<?php

    include_once 'cFuncoes.php';
    echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";

    include_once '../modelo/Modelo.php';
    include_once '../bd/CursoDAO.php';
    
    
    $nome= $_POST['nome'];
    $vagas= $_POST['vagas'];
    $dataInicio= $_POST['dataInicio'];
    $cargaHoraria= $_POST['cargaHoraria'];
    $preRequisitos= $_POST['preRequisitos'];
    $dias = "";   
    if(isset($_POST['diasSemana'])){
        $diasSemana = $_POST['diasSemana'];
        foreach ($diasSemana as $diaSemana){            
            $dias.=$diaSemana." ";
        }
    }
    
    $dataTermino= $_POST['dataTermino'];
    
    
    $curso = new Curso($nome, $vagas, $dataInicio, $cargaHoraria, $preRequisitos, $dias, $dataTermino);
    $cursoDAO = new CursoDAO();
    $cursoDAO->cadastraCurso2($curso);
    
?>