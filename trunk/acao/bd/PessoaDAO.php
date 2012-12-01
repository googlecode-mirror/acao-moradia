<?php
    class PessoaDAO{
        
        private $_sel= "SELECT * FROM pessoa";   
        private $_selNome= "SELECT nome FROM pessoa"; 
        private $_ins= "INSERT INTO `pessoa`(`cpf`, `nome`, `rg`, `sexo`,`telefone`, `grau_parentesco`, 
            `estado_civil`, `raca`, `religiao`, `carteira_profissional`, `titulo_eleitor`, 
            `certidao_nascimento`, `cidade_natal`, `estado_natal`, `id_familia`) VALUES";        
        private $_rem= "DELETE FROM pessoa WHERE";
        private $_alt= "UPDATE pessoa set";
        
        public function cadastraPessoa(
            $cpf, $nome, $rg, $sexo, $telefone, $grauParentesco, $estadoCivil, $raca, $religiao, 
                $carteiraProfissional, $tituloEleitor, $certidaoNascimento, $cidadeNatal, 
                $estadoNatal, $idFamilia){
            
            //$nome= strtolower($nome);
            $this->_ins.= " ('$cpf', '$nome', '$rg', '$sexo', '$telefone', '$grauParentesco', '$estadoCivil', '$raca', '$religiao',
                '$carteiraProfissional', '$tituloEleitor', '$certidaoNascimento', '$cidadeNatal', 
                '$estadoNatal', $idFamilia)";
            //TO_DATE($dataNascimento,'DD/MM/YYYY')
            
            echo $this->_ins."<br>";
            
            $_res= mysql_query($this->_ins)or die(mysql_error());
            if($_res != TRUE)
                echo 'falha na operação pessoa';
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
        
        public function buscaPessoabyFamilia($id){
            
            $teste = $this->_selNome.' '."WHERE id_familia= '".$id."' AND grau_parentesco= 'TITULAR'";         
                       
            $res= mysql_query($teste)or die(mysql_error());
            $a  = mysql_fetch_assoc($res);
            
            if($res === FALSE){
                echo "pessoa não encontrada";
                return null;
            }else{
                //$arived= mysql_fetch_row($res);               
                return $a['nome'];
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