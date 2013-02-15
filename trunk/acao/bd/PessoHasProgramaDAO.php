<?php
    class PessoaHasProgramaDAO{
        private $_ins= "INSERT INTO pessoa_has_programa (`id_pessoa`, `id_programa`) VALUES";
        private $_rem= "DELETE FROM pessoa_has_programa WHERE";
        private $_alt= "UPDATE pessoa_has_programa set";
        private $_sel= "SELECT * FROM pessoa_has_programa";                 
        
        public function cadastraPessoaHasPrograma($idPessoa, $idPrograma){
            $this->_ins.= " ('$idPessoa','$idPrograma')";
            $_res= mysql_query($this->_ins);
            if($_res != TRUE)
                echo 'falha na operação';             
        }
        
        public function buscaProgramasById($id_pessoa){
            $select= "SELECT p.nome FROM pessoa_has_programa php, programa p WHERE php.id_pessoa= $id_pessoa and php.id_programa = p.id_programa";
            $res= mysql_query($select);
            
            if($res === FALSE){
                echo "programa desconhecido: ".$select;
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
        
    }

?>
