<?php
    class FamiliaDAO{        
        private $_ins= "INSERT INTO familia (`cep`, `logradouro`, `numero`, `bairro`, `cidade`, `estado`) VALUES";
        private $_rem= "DELETE FROM familia WHERE";
        private $_alt= "UPDATE familia set";
        private $_sel= "SELECT * FROM familia";                 
        
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
            $select= "SELECT * FROM familia WHERE id_familia= $idFamilia";
            $res= mysql_query($select);
            if($res === FALSE){
                echo "familia não encontrada";
                return null;
            }else{
                //$arrived= mysql_fetch_assoc($res);
                return $res;
            }            
        }    
        
        public function buscaFamiliaExceptId($idFamilia){
            $select= "SELECT * FROM familia WHERE id_familia <> $idFamilia";
            $res= mysql_query($select);
            if($res === FALSE){
                echo "familia não encontrada";
                return null;
            }else{
                //$arrived= mysql_fetch_assoc($res);
                return $res;
            }            
        }  
        
        public function buscaLogradouro($idFamilia){
            $select= "SELECT logradouro FROM familia WHERE id_familia = $idFamilia";
            $res= mysql_query($select);
            $a= mysql_fetch_assoc($res);
            if($res === FALSE){
                echo "familia não encontrada";
                return null;
            }else{
                //$arrived= mysql_fetch_assoc($res);
                return $a['logradouro'];
            }            
        } 
        
        public function buscaNumero($idFamilia){
            $select= "SELECT numero FROM familia WHERE id_familia = $idFamilia";
            $res= mysql_query($select);
            $a  = mysql_fetch_assoc($res);
            if($res === FALSE){
                echo "familia não encontrada";
                return null;
            }else{
                //$arrived= mysql_fetch_assoc($res);
                return $a['numero'];
            }            
        }
        
        public function buscaFamiliabyLogradouro($nome){            
            $select= "SELECT * FROM familia WHERE logradouro like '%$nome%'"; //add um: AND id_familia de pessoa not in (select do while anterior em monta tabela)
            $res= mysql_query($select)or die(mysql_error());
            //$a  = mysql_fetch_assoc($res);
            
            if($res === FALSE){
                echo "pessoa não encontrada";
                return null;
            }else{
                //$arived= mysql_fetch_row($res);               
                return $res;
            } 
        }
        
        public function buscaFamilia(){
            //$this->_sel.= " WHERE id_familia= $idFamilia";
            $res= mysql_query($this->_sel);
            if($res === FALSE){
                echo "familia não encontrada";
                return null;
            }else{
                //$arrived= mysql_fetch_assoc($res);
                return $res;
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

