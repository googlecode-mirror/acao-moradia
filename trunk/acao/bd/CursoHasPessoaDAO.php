<?php

include_once 'Debug.php';
include_once 'DBConnection.php';
DataBase::createConection();

class CursoHasPessoaDAO {

    private $_ins = "INSERT INTO curso_has_pessoa (`id_pessoa`,`id_curso`) VALUES";

    //private $_rem= "DELETE FROM curso_has_pessoa WHERE";
    //private $_alt= "UPDATE curso_has_pessoa set";
    //private $_sel= "SELECT * FROM curso_has_pessoa";                 

    public function cadastraCursoHasPessoa($idPessoa, $idCurso) {
        $this->_ins.= " ($idPessoa,$idCurso)";
        $_res = mysql_query($this->_ins);
        Debug::gravaEmArquivo($this->_ins);
        if ($_res != TRUE)
            echo 'falha na operação';
        else {
            echo 'Pessoa inserida com sucesso';
        }
    }

}

?>
