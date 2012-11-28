<?php
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
            if($_res != TRUE)
                echo 'falha na operação B'; 
        }             
        
        public function removeBairro($nome){            
            $this->_rem.= " usuario= $user AND senha= $pass AND nivel= $level";
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
                $arived= mysql_fetch_assoc($res);
                return $arived;
            }            
        }      
    }
?>

