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
            $_res= mysql_query($this->_ins) or mysql_error();            
            if($_res != TRUE)
                echo 'falha na operação'; 
            return $_res;
        }                             
        
        public function removeTelefoneByNumero($telefone){            
            $this->_rem.= " telefone='$telefone'";
            $_res= mysql_query($this->_rem) or die(mysql_error(). "select = ".$this->_rem);
            if($_res != TRUE)
                echo 'falha na operação'; 
            return $_res;
        }   
        
        public function removeTelefoneByIdFamilia($id_familia){            
            $this->_rem.= " id_familia=$id_familia";
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
        
        public function alteraDadosTelefone($Telefone, $telefone_antigo){            
            $this->_alt.= " telefone = '".$Telefone->getNumero()."',id_familia =". $Telefone->getIdFamilia().",recado_com = '".$Telefone->getFalarCom()."' WHERE telefone='". $telefone_antigo."'";            
            $_res= mysql_query($this->_alt) or die(mysql_error()." select = ". $this->_alt);
            if($_res != TRUE)
                echo 'falha na operação'; 
            return $_res;
            
        }
    }
        
?>

