<?php
    class CidadeDAO{
        
        private $_ins= "INSERT INTO  cidade (`nome`) VALUES (''),";
        private $_rem= "DELETE FROM cidade WHERE";
        private $_alt= "UPDATE cidade set";
        private $_sel= "SELECT * FROM cidade";
        
         public function testeInsert($_res){
            if($_res != TRUE)
                echo 'falaha na operação';  
        }
        
        public function cadastraCidade($cCidade, $cEstado){         
            $this->_ins.= " ('$cCidade')";          
            $_res= mysql_query($this->_ins);
            if($_res != TRUE)
                echo 'falaha na operação'; 
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
                echo "falha na consulta";
                return null;
            }else{
                $arived= mysql_fetch_assoc($res);
                return $arived;
            }            
        }      
    }
?>


