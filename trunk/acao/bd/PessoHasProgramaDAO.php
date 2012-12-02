<?php
    class PessoaHasProgramaDAO{
        private $_ins= "INSERT INTO pessoa_has_programa (`id_pessoa`, `id_programa`) VALUES";
        private $_rem= "DELETE FROM pessoa_has_programa WHERE";
        private $_alt= "UPDATE pessoa_has_programa set";
        private $_sel= "SELECT * FROM pessoa_has_programa";                 
        
        public function cadastraPessoaHasPrograma($idPessoa, $idPrograma){
            $this->_ins.= " ('$idPessoa','$idPrograma')";
            $_res= mysql_query($this->_ins);
            if($_res != TRUE)
                echo 'falha na operação';             
        }             
        
    }

?>
