<?php
    class PessoaDAO{
        
        private $_sel= "SELECT * FROM pessoa";
        private $_ins= "INSERT INTO `pessoa`(`cpf`, `nome`, `rg`, `sexo`, `data_nascimento`, `id_conjuge`, `cep`, `logradouro`, `numero`) VALUES";
        /*private $_rem= "DELETE FROM pessoa WHERE";
        private $_alt= "UPDATE pessoa set";
        */
        public function cadastraPessoa( $cpf, $nome, $rg, $sexo, $dataNascimento, $idConjuge, $cep, $logradouro, $numero){
            $nome= strtolower($nome);
            $this->_ins.= " ('$cpf', '$nome', '$rg', '$sexo', '$dataNascimento', $idConjuge, '$cep', '$logradouro', $numero)";
            //TO_DATE($dataNascimento,'DD/MM/YYYY')
            echo $this->_ins."<br>";
            $_res= mysql_query($this->_ins)or die(mysql_error());
            if($_res != TRUE)
                echo 'falaha na operação pessoa';
            else{
                return true;
            }
        }
                     
        private function testeInsert($res){
            if($res != TRUE)
                echo 'falaha na operação';
        }
        
        public function buscaPessoa($pessoa){
            $this->_sel.= " WHERE nome= '$pessoa'";
            $res= mysql_query($this->_sel) OR die(mysql_error());
            if($res === FALSE){
                echo "pessoa não encontrada";
                return null;
            }else{
                $arived= mysql_fetch_row($res);
                return $arived;
            } 
        }
        
        public function buscaAllOfPessoaByAttribute($attribute, $query){
            /*$this->_sel.= " WHERE ";
            $this->_sel.= $attribute;
            $this->_sel.= " = '$query'";*/
            $res= mysql_query($this->_sel) OR die(mysql_error());
            if($res === FALSE){
                echo "pessoa não encontrada";
                return null;
            }else{
                $arived= mysql_fetch_row($res);
                return $arived;
            }
        }
        
        public function buscaPessoaByAttribute($attribute, $query){
            $this->_sel.= " WHERE ";
            $this->_sel.= $attribute;
            $this->_sel.= " = '$query'";
            $res= mysql_query($this->_sel) OR die(mysql_error());
            if($res === FALSE){
                echo "pessoa não encontrada";
                return null;
            }else{
                $arived= mysql_fetch_row($res);
                return $arived;
            }
        }
    }
?>