<?php
    include_once 'DBConnection.php';
    DataBase::createConection();
    class FamiliaDAO{        
        private $_ins= "INSERT INTO familia (`cep`, `logradouro`, `numero`, `bairro`, `cod_cidade`) VALUES";
        private $_rem= "DELETE FROM familia WHERE";
        private $_alt= "UPDATE familia set";
        private $_sel= "SELECT * FROM familia";                 
        
        private $_sel_max_id= "SELECT max(id_familia) as max_id_familia FROM familia";                
        
        public function cadastraFamilia($cep, $logradouro, $numero, $bairro, $cod_cidade){       
            $this->_ins.= " ('$cep', '$logradouro', $numero, '$bairro', '$cod_cidade')";            
            $_res= mysql_query($this->_ins) or mysql_errno();                        
            
            if($_res != TRUE)
                echo 'falha na operação'; 
            return $_res;
        }                             
        
        public function removeFamiliaById($idFamilia){            
            $this->_rem.= " id_familia=$idFamilia";
            return mysql_query($this->_rem) or die(mysql_error());
            //this.testeInsert($_res);
        }   
        
        public function buscaFamiliaById($idFamilia){
            $select= "SELECT * FROM familia WHERE id_familia= $idFamilia";
            $res= mysql_query($select);
            if($res === FALSE){
                echo "familia não encontrada ".$idFamilia;
                return null;
            }else{
                //$arrived= mysql_fetch_assoc($res);
                return $res;
            }            
        }    
        
        public function buscaFamiliaByNumero($numero){
            $select= "SELECT * FROM familia WHERE numero like '%$numero%' AND id_familia <> $numero";
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
            $select= "SELECT * FROM familia WHERE id_familia <> $idFamilia AND numero NOT IN (SELECT numero FROM familia WHERE numero like '%$idFamilia%')";
            $res= mysql_query($select);
            if($res === FALSE){
                echo "familia não encontrada";
                return null;
            }else{
                //$arrived= mysql_fetch_assoc($res);
                return $res;
            }
        }
        
         public function buscaAttribOfFamiliabyId($idFamilia){
            $select= "SELECT * FROM familia WHERE id_familia = $idFamilia";
            $res= mysql_query($select);
            if($res === FALSE){
                echo "familia não encontrada";
                return null;
            }else{
                //$arrived= mysql_fetch_assoc($res);
                return $res;
            }            
        } 
        
        public function buscaFamiliaExceptLogradouro($nome){
            $select= "SELECT * FROM familia WHERE id_familia NOT IN
                (SELECT id_familia FROM familia WHERE logradouro like '%$nome%') 
                AND id_familia NOT IN 
                 (SELECT id_familia FROM pessoa WHERE grau_parentesco= 'TITULAR' AND nome like '%$nome%')
                     
            ";
            //"SELECT * FROM familia WHERE logradouro like '%$nome%' AND id_familia NOT IN (SELECT id_familia FROM pessoa WHERE grau_parentesco= 'TITULAR' AND nome like '%$nome%')"
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
            //$a  = mysql_fetch_assoc($res);
            if($res === FALSE){
                echo "familia não encontrada";
                return null;
            }else{
                //$arrived= mysql_fetch_assoc($res);
                return $res;
            }            
        }
        
        public function buscaFamiliabyLogradouro($nome){ 
            $select= "SELECT * FROM familia WHERE logradouro like '%$nome%' AND id_familia NOT IN (SELECT id_familia FROM pessoa WHERE grau_parentesco= 'TITULAR' AND nome like '%$nome%')"; //add um: AND id_familia de pessoa not in (select do while anterior em monta tabela)
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
            $res = $this->cadastraFamilia($familia->getCep(), $familia->getLogradouro(), $familia->getNumero(), $familia->getBairro(), $familia->getCodCidade());            
            if($res){
                $familia->setIdFamilia($this->sel_max_id());                
            }
            return $res;
        }
        
        public function getNomeTitularFamiliaByIdFamilia($idFamilia){
            $nome_titular = mysql_query("select nome from familia f, pessoa p where f.id_familia = p.id_familia and f.id_familia = $idFamilia");
            if($nome_titular){
                $arrived= mysql_fetch_assoc($nome_titular);                
                return $arrived['nome'];
            }else{
                return "TITULAR";
            }
        }
        
        public function buscaTodosDadosFamilia($id_familia){
            $query = "select c.nome as cidade, e.sigla as estado, f.cep, f.logradouro, f.numero, f.bairro
                      from familia f, cidade c, estado e
                      where f.id_familia = $id_familia and                      
                      c.cod_cidade = f.cod_cidade and
                      e.cod_estado = c.cod_estado";
            $res = mysql_query($query);
            //echo $query;
            if(!$res){
                return NULL;
            }
            return $res;
        }
        
        public function buscaTelefone($id_familia){
            $query = "select t.telefone, t.recado_com  
                      from familia f, telefone t
                      where f.id_familia = $id_familia and
                      f.id_familia = t.id_familia";
            $res = mysql_query($query);
            //echo $query;
            if(!$res){
                return NULL;
            }
            return $res;
        }                
        
        public function buscaTitularByIdFamilia($id_familia){
            $query = "select p.* 
                      from pessoa p, familia f 
                      where p.id_familia = $id_familia and 
                      p.grau_parentesco = 'TITULAR' and 
                      p.id_familia = f.id_familia";
            $res = mysql_query($query);            
            if(!$res){
                echo "Erro ".$query;
                return NULL;
            }
            return $res;
        }
        
        public function alteraDadosFamilia($familia){
            //print_r($familia);            
            $this->_alt .= " cep = '".$familia->getCep()."', logradouro = '".$familia->getLogradouro()."', numero=".$familia->getNumero().", bairro='".$familia->getBairro()."', cod_cidade=".$familia->getCodCidade()." WHERE id_familia=".$familia->getIdFamilia();
            $res = mysql_query($this->_alt);            
            if(!$res){
                echo "Erro ".$this->_alt;
                return NULL;
            }
            return $res;
        }
        
    }
?>

