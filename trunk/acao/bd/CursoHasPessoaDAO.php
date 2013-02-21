<?php

include_once 'DBConnection.php';
DataBase::createConection();

class CursoHasPessoaDAO {

    private $_ins = "INSERT INTO curso_has_pessoa (`id_pessoa`,`id_curso`) VALUES";

    //private $_rem= "DELETE FROM curso_has_pessoa WHERE";
    //private $_alt= "UPDATE curso_has_pessoa set";
    //private $_sel= "SELECT * FROM curso_has_pessoa";                 

    public function cadastraCursoHasPessoa($idPessoa, $idCurso) {
        $this->_ins.= " ($idPessoa,$idCurso)";
        $res = mysql_query($this->_ins);

        if ($res != TRUE)
            echo 'falha na operação';
        else {
            echo 'Pessoa inserida com sucesso';
        }
    }
    
    public function buscaAlunosDoCurso($idCurso){
        $select = "SELECT c.situacao_matricula, DATE_FORMAT(c.data_inscricao, '%d/%m/%Y %h:%i:%s') as data_inscricao, p.*
           FROM curso_has_pessoa c, pessoa p 
           WHERE c.id_curso=$idCurso and p.id_pessoa = c.id_pessoa
           ORDER BY c.data_inscricao";
        
        $res = mysql_query($select);
        if ($res != TRUE)
            echo 'falha na operação';
        else {
            return $res;
        }
    }

}

?>
