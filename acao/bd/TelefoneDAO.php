<?php
    include_once 'DBConnection.php';
    DataBase::createConection();
    class TelefoneDAO{        
        private $_ins= "INSERT INTO telefone (`telefone`, `id_familia`, `recado_com`) VALUES";
        private $_rem= "DELETE FROM telefone WHERE";
        private $_alt= "UPDATE telefone set";
        private $_sel= "SELECT * FROM telefone";                                 
        
        public function cadastraTelefone($telefone, $id_familia, $recado_com){       
            $this->_ins.= " ('$telefone', $id_familia, '$recado_com')";            
            $_res= mysql_query($this->_ins) or mysql_errno();                        
            
            if($_res != TRUE)
                echo 'falha na operação'; 
            return $_res;
        }                             
        
        public function removeTelefoneById($telefone){            
            $this->_rem.= " telefone=$telefone";
            $_res= mysql_query($this->rem);
            if($_res != TRUE)
                echo 'falha na operação'; 
            return $_res;
        }   
        
        public function buscaTelefoneByIdFamilia($idFamilia){
            $this->_sel .= " WHERE id_familia = $idFamilia";
            $_res= mysql_query($this->_sel);
            if($_res != TRUE)
                echo 'falha na operação'; 
            return $_res;
        }
    }
        
?>

