<?php
    include_once 'DBConnection.php';
    DataBase::createConection();
    class CidadeDAO{
        
        private $_ins= "INSERT INTO  cidade (`nome`, `estado`) VALUES";
        private $_rem= "DELETE FROM cidade WHERE";
        private $_alt= "UPDATE cidade set";
        private $_sel= "SELECT * FROM cidade";
        
         public function testeInsert($_res){
            if($_res != TRUE)
                echo 'falha na operação';  
        }
        
        public function cadastraCidade($cCidade, $cEstado){         
            $this->_ins.= " ('$cCidade','$cEstado')";
            $_res= mysql_query($this->_ins);
            //if($_res != TRUE)
                //echo 'falha na operação'; 
        }             
        
        public function removeCidade($nome,$estado){
            $this->_rem.= " nome= '$nome' AND estado= '$estado'";
            $_res= mysql_query($this->rem);
            this.testeInsert($_res);
        }   
        
          public function buscaCidade($nome){
            $this->_sel.= " WHERE nome= '$nome'";
            $res= mysql_query($this->_sel);
            if($res === FALSE){
                echo "falha na consulta";
                return null;
            }else{
                $arrived= mysql_fetch_assoc($res);
                return $arrived;
            }            
        } 
        
        public function buscaCidadebyCod($cod){
            $select = "select * from cidade WHERE cod_cidade= $cod";
            $res= mysql_query($select);
            if($res === FALSE){
                echo "falha na consulta query=".$select;
                return null;
            }else{
                //$arrived= mysql_fetch_assoc($res);
                return $res;
            }            
        } 
        
        public function alteraCidade($nome,$estado){
            $this->_rem.= " nome= $nome AND estado= $estado";
            $_res= mysql_query($this->rem);
            this.testeInsert($_res);
        }   
        
        public function buscaCidadesByEstado($cod_estado){
            $select = "select * from cidade WHERE cod_estado= $cod_estado";
            $res= mysql_query($select);
            if($res === FALSE){
                echo "falha na consulta query=".$select;
                return null;
            }else{                
                return $res;
            }
        }
    }
?>


