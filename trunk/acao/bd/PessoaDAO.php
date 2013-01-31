<?php
    include_once '../controle/cFuncoes.php';
    include_once 'DBConnection.php';
    DataBase::createConection();
    class PessoaDAO{
        
        private $_sel= "SELECT * FROM pessoa";   
        private $_selNome= "SELECT nome FROM pessoa"; 
        private $_ins= "INSERT INTO `pessoa`(`cpf`, `nome`, `rg`, `sexo`,`telefone`, `grau_parentesco`, 
            `estado_civil`, `raca`, `religiao`, `carteira_profissional`, `titulo_eleitor`, 
            `certidao_nascimento`, `cidade_natal`, `id_familia`, `data_nascimento`) VALUES";        
        private $_rem= "DELETE FROM pessoa WHERE";
        private $_alt= "UPDATE pessoa set";
        private $_sel_max_id= "SELECT max(id_pessoa) as max_id_pessoa FROM pessoa";                
        
         public function cadastraPessoa(
            $id_familia, $cod_cidade_Natal, $nome, $cpf, $rg, $sexo, $dataNascimento, $telefone, $grauParentesco, $estadoCivil, $raca, $religiao, 
                $carteiraProfissional, $tituloEleitor, $certidaoNascimento){
            
            $dataNascimentoMySQL = Funcoes::toMySqlDate($dataNascimento);
            //$nome= strtolower($nome);
            echo $selec= "INSERT INTO `pessoa`(`id_familia`, `cidade_natal`, `nome`, `cpf`, `rg`, `sexo`, `data_nascimento`, `data_saida`, `telefone`, `grau_parentesco`, `estado_civil`, `raca`, `religiao`, `carteira_profissional`, `titulo_eleitor`, `certidao_nascimento`) VALUES ($id_familia, $cod_cidade_Natal, '$nome', '$cpf', '$rg', '$sexo', '$dataNascimentoMySQL', null, '$telefone', '$grauParentesco', '$estadoCivil', '$raca', '$religiao',
                '$carteiraProfissional', '$tituloEleitor', '$certidaoNascimento')";
            //TO_DATE($dataNascimento,'DD/MM/YYYY')
            
                        
            $_res= mysql_query($selec)or die(mysql_error());
            if($_res != TRUE)
                echo 'falha na operação pessoa';
            
            return $_res;
            
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
        
        public function buscaPessoabyFamilia2($id){
            
            $teste = "SELECT * FROM pessoa WHERE id_familia= '".$id."' AND grau_parentesco= 'TITULAR'";        
                       
            $res= mysql_query($teste)or die(mysql_error());
            //$a  = mysql_fetch_assoc($res);
            
            if($res === FALSE){
                echo "pessoa não encontrada";
                return null;
            }else{
                //$arived= mysql_fetch_row($res);               
                return $res;
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
        
        public function buscaPessoaTitular($nome){            
            $select= "SELECT * FROM pessoa WHERE grau_parentesco= 'TITULAR' AND nome like '%$nome%'"; 
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
            $this->_sel.= " = $query";
            $res= mysql_query($this->_sel) OR die(mysql_error());            
            if($res === FALSE){
                echo "pessoa não encontrada";
                return null;
            }else{
                //$arrived= mysql_fetch_row($res);
                return $res;
            }
        }
        
        public function sel_max_id(){            
            $res= mysql_query($this->_sel_max_id);
            if($res === FALSE){
                echo "pessoa não encontrada";
                return null;
            }else{
                $arrived= mysql_fetch_assoc($res);
                return $arrived['max_id_pessoa'];
            }            
        }
        
        public function cadastraPessoa_2($pessoa){            
                    
            $res = $this->cadastraPessoa(
                    $pessoa->getIdFamilia(), $pessoa->getCidadeNatal(), $pessoa->getNome(), $pessoa->getCpf(), $pessoa->getRg(), 
                    $pessoa->getSexo(), $pessoa->getDataNascimento(), $pessoa->getTelefone(), $pessoa->getGrauParentesco(), 
                    $pessoa->getEstadoCivil(), $pessoa->getRaca(), $pessoa->getReligiao(), 
                    $pessoa->getCarteiraProfissional(), $pessoa->getTituloEleitor(), 
                    $pessoa->getCertidaoNascimento());
            if($res){
                $pessoa->setIdPessoa($this->sel_max_id());
            }
            return $res;
        }
        
        public function excluiPessoaById($idPessoa){
            return mysql_query($this->_rem.=' id_pessoa = '.$idPessoa) or die(mysql_error());
        }
    }
?>