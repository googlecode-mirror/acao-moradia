<?php
    class FamiliaDAO{        
        private $_ins= "INSERT INTO familia (`cep`, `logradouro`, `numero`, `bairro`, `cidade`, `estado`) VALUES";
        private $_rem= "DELETE FROM endereco WHERE";
        private $_alt= "UPDATE endereco set";
        private $_sel= "SELECT * FROM endereco";                 
        
        private $_sel_max_id= "SELECT max(id_familia) as max_id_familia FROM familia";                
        
        public function cadastraFamilia($cep, $logradouro, $numero, $bairro, $cidade, $estado){       
            $this->_ins.= " ('$cep', '$logradouro', $numero, '$bairro', '$cidade', '$estado')";            
            $_res= mysql_query($this->_ins) or mysql_errno();                        
            
            if($_res != TRUE)
                echo 'falha na operação'; 
        }                             
        
        public function removeFamiliaById($idFamilia){            
            $this->_rem.= " id=$idFamilia";
            $_res= mysql_query($this->rem);
            this.testeInsert($_res);
        }   
        
        public function buscaFamiliaById($idFamilia){
            $this->_sel.= " WHERE id_familia= $idFamilia";
            $res= mysql_query($this->_sel);
            if($res === FALSE){
                echo "familia não encontrada";
                return null;
            }else{
                $arrived= mysql_fetch_assoc($res);
                return $arrived;
            }            
        }               
        
        public function sel_max_id(){            
            $res= mysql_query($this->_sel_max_id);
            if($res === FALSE){
                echo "familia não encontrada";
                return null;
            }else{
                $arrived= mysql_fetch_assoc($res);
                return $arrived['max_id_familia'];
            }            
        }
        
        public function cadastraFamilia_2($familia){
            $this->cadastraFamilia($familia->getCep(), $familia->getLogradouro(), $familia->getNumero(), $familia->getBairro(), $familia->getCidade(), $familia->getEstado());
            $familia->setIdFamilia($this->sel_max_id());
        }
    }
?>

