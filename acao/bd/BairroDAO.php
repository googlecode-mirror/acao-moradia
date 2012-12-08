<?php
    include_once 'DBConnection.php';
    DataBase::createConection();
    class BairroDAO{
        
        private $_ins= "INSERT INTO  bairro (`nome`) VALUES";
        private $_rem= "DELETE FROM bairro WHERE";
        private $_alt= "UPDATE bairro set";
        private $_sel= "SELECT * FROM bairro";
        
         public function testeInsert($_res){
            if($_res != TRUE)
                echo 'falha na operação';  
        }
        
        public function cadastraBairro($b){       
            $this->_ins.= " ('$b')"; 
            $_res= mysql_query($this->_ins);
            //if($_res != TRUE)
                //echo 'falha na operação B'; 
        }             
        
        public function removeBairro($nome){            
            $this->_rem.= " nome = '$nome'";
            $_res= mysql_query($this->rem);
            this.testeInsert($_res);
        }   
        
        public function buscaBairro($bairro){
            $this->_sel.= " WHERE nome= '$bairro'";
            $res= mysql_query($this->_sel);
            if($res === FALSE){
                echo "bairro desconhecido";
                return null;
            }else{
                $arrived= mysql_fetch_assoc($res);
                return $arrived;
            }            
        }      
        
        public function alteraBairro($bairro_novo, $bairro_antigo){            
            $this->_rem.= " nome = '$bairro_novo' where nome = '$bairro_antigo'";
            $_res = mysql_query($this->rem);
            if($res === FALSE){
                echo "Este bairro já é existente ou ocorreu um erro";
                return null;
            }else{
                $arrived= mysql_fetch_assoc($res);
                return $arrived;
            }            
        }   
        
        
    }
?>

