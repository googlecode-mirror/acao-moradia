<?php 
    include_once 'DBConnection.php';
    class ProgramaDAO{
        
        private $_ins= "INSERT INTO  programa (`nome`) VALUES";
        private $_rem= "DELETE FROM programa WHERE";
        private $_alt= "UPDATE programa set";
        private $_sel= "SELECT * FROM programa";
        
         public function testeInsert($_res){
            if($_res != TRUE)
                echo 'falha na operação';  
        }
        
        public function cadastraPrograma($p){       
            $this->_ins.= " ('$p')"; 
            $_res= mysql_query($this->_ins);
            if($_res != TRUE)
                echo 'falha na operação B'; 
        }             
        
        public function removePrograma($nome){            
            $this->_rem.= " nome= $nome";
            $_res= mysql_query($this->rem);
            this.testeInsert($_res);
        }   
        
        public function buscaPrograma($programa){
            $this->_sel.= " WHERE nome= '$programa'";
            $res= mysql_query($this->_sel);
            if($res === FALSE){
                echo "programa desconhecido";
                return null;
            }else{
                $arived= mysql_fetch_assoc($res);
                return $arived;
            }            
        }      
        
         public function buscaTodosProgramas(){           
             DataBase::createConection();
             $res= mysql_query($this->_sel);
             if($res === FALSE){
                 echo "programa desconhecido: ".$this->_sel;
                 return null;
             }else{                
                 return $res;
             }            
        }
    }
?>
