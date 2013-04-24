<?php
    include_once 'DBConnection.php';
    DataBase::createConection();
    class PessoaHasProgramaDAO{
        private $_ins= "INSERT INTO pessoa_has_programa (`id_pessoa`, `id_programa`) VALUES";
        private $_rem= "DELETE FROM pessoa_has_programa WHERE";
        private $_alt= "UPDATE pessoa_has_programa set";
        private $_sel= "SELECT * FROM pessoa_has_programa";                 
        
        public function cadastraPessoaHasPrograma($idPessoa, $idPrograma){            
            $_res= mysql_query($this->_ins." ($idPessoa,$idPrograma)");
            if($_res != TRUE)
                echo 'falha na operação '.$this->_ins."<br>";             
        }
        
        public function buscaProgramasById($id_pessoa){
            $select= "SELECT p.nome, php.id_programa FROM pessoa_has_programa php, programa p WHERE php.id_pessoa= $id_pessoa and php.id_programa = p.id_programa";
            $res= mysql_query($select);
            
            if($res === FALSE){
                echo "programa desconhecido: ".$select;
                return null;
            }else{                
                return $res;
            }    
        }
        
        public function buscaPessoasDoPrograma($idPrograma){
            $select= "SELECT pes.nome, pes.id_pessoa 
                FROM pessoa_has_programa p, pessoa pes 
                WHERE p.id_programa= $idPrograma and p.id_pessoa = pes.id_pessoa";
            $res= mysql_query($select);
            
            if($res === FALSE){
                echo "Erro: ".$select;
                return null;
            }else{                
                return $res;
            }    
        }



        /* public function IsPessoaInPrograma($id_pessoa, $id_programa){           
             echo $select= "SELECT * FROM pessoa_has_programa WHERE id_pessoa= $id_pessoa AND id_programa = $id_programa";
             $res= mysql_query($select);
             //$b= mysql_fetch_array($res);
             if($res === FALSE){
                 echo "programa desconhecido: ".$this->_sel;
                 return null;
             }else{                
                 return $res;
             }            
        }*/
        
        public function IsPessoaInPrograma($id_pessoa, $id_programa){
            $select= "SELECT * FROM pessoa_has_programa WHERE id_pessoa= $id_pessoa AND id_programa= $id_programa";
            //echo $select;
            $res= mysql_query($select);
            if($res === FALSE){
                echo "Erro";
                return null;
            }else{
                //$arrived= mysql_fetch_assoc($res);
                return $res;
            }            
        } 
        
        public function remove($id_pessoa, $id_programa){
            $select= "DELETE FROM pessoa_has_programa WHERE id_pessoa= $id_pessoa and id_programa = $id_programa";
            $res= mysql_query($select) or die(mysql_error());            
            echo $select;
            if($res === FALSE){
                echo "Erro: ".$select;
                return null;
            }else{
                return $res;
            }    
        }
        
        public function removeTodosProgramas($id_pessoa){
            $select= "DELETE FROM pessoa_has_programa WHERE id_pessoa= $id_pessoa";
            $res= mysql_query($select);            
            if($res === FALSE){
                echo "Erro: ".$select;
                return null;
            }else{                
                return $res;
            }    
        }
        
        public function remove_2($id_pessoa){
            $select= "DELETE FROM pessoa_has_programa WHERE id_pessoa= $id_pessoa";
            $res= mysql_query($select);            
            if($res === FALSE){
                echo "Erro: ".$select;
                return null;
            }else{                
                return $res;
            }    
        }
        
    }

?>
