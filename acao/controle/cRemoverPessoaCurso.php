<?php
    $id_pessoa = $_GET['id_pessoa'];
    $id_curso  = $_GET['id_curso'];
   
    require_once '../bd/CursoHasPessoaDAO.php';
    $cursoHasPessoaDAO = new CursoHasPessoaDAO();    
    
    if($cursoHasPessoaDAO->isMatriculado($id_pessoa,$id_curso) > 0){                
        $res = mysql_query("SELECT id_pessoa FROM curso_has_pessoa WHERE id_curso = $id_curso AND situacao_matricula = 'LISTA DE ESPERA' ORDER BY data_inscricao LIMIT 1");
        if($res){
            $pessoa = mysql_fetch_assoc($res);        
            mysql_query("UPDATE curso_has_pessoa SET situacao_matricula = 'MATRICULADO' WHERE id_curso = $id_curso AND id_pessoa = $pessoa[id_pessoa]");
        } else{
            echo "ERRO";
        }    
    }                    
    $cursoHasPessoaDAO->remove($id_pessoa,$id_curso);
    header("Location: ../visao/vRelatorioCurso.php?id_curso=$id_curso");    
?>
