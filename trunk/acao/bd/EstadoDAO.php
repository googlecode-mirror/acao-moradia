<?php    
    include_once 'DBConnection.php';
    DataBase::createConection();
    class EstadoDAO{
        private $_sel= "SELECT * FROM estado";
        
        public function buscaEstados(){            
            $sql = "SELECT cod_estado, sigla
                        FROM estado
                        ORDER BY sigla";
            $res = mysql_query( $sql );            
            if($res === FALSE){
                echo "falha na consulta";
                return null;
            }else{                
                return $res;
            }            
        }      
        /*
        private $_ins= "INSERT INTO  cidade (`nome`, `estado`) VALUES";
        private $_rem= "DELETE FROM cidade WHERE";
        private $_alt= "UPDATE cidade set";        
        
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
        
        public function alteraCidade($nome,$estado){
            $this->_rem.= " nome= $nome AND estado= $estado";
            $_res= mysql_query($this->rem);
            this.testeInsert($_res);
        }   */
    }
?>


