<?php  
    include_once 'DBConnection.php';
    DataBase::createConection();
    class LoginDAO{
        
        private $_ins= "INSERT INTO login (usuario,senha,nivel) VALUES";
        private $_rem= "DELETE FROM login WHERE";
        private $_alt= "UPDATE login set";
        private $_sel= "SELECT * FROM login";
        
        public function cadastraLogin(Login $l){         
            return $this->cadastraLogin2($l->getUser(), $l->getSenha(), $l->getNivel());
        }
        
        public function cadastraLogin2($user, $pass, $level){            
            $this->_ins.= " ('$user', '$pass', '$level')";
            $_res= mysql_query($this->_ins);
            
                return $_res;
        }
       
        public function removeLogin($user, $pass, $level){            
            $this->_rem.= " usuario= $user AND senha= $pass AND nivel= $level";
            $_res= mysql_query($this->rem);
            this.testeInsert($_res);
        }
        
        public function removeLogin2($user){            
            $this->_rem.= " usuario= $user";
            $_res= mysql_query($this->rem);
            this.testeInsert($_res);
        }
        
        public function alterLoginUsuario($oldUsuario, $usuario){
            $this->alt.= " usuario= $usuario WHERE usuario= $oldUsuario";
            $_res= mysql_query($this->alt);
            this.testeInsert($_res);
        }
        
        public function alterLoginSenha($usuario, $senha){
            $this->alt.= " senha= $senha WHERE usuario= $usuario";
            $_res= mysql_query($this->alt);
            this.testeInsert($_res);
        }
        
        public function alterLoginNivel($usuario, $nivel){
            $this->alt.= " nivel= $nivel WHERE usuario= $usuario";
            $_res= mysql_query($this->alt);
            this.testeInsert($_res);
        }
        
        public function buscaLogin($user, $pass){            
            $this->_sel.= " WHERE usuario= '$user' AND senha= md5('$pass')";            
            $res= mysql_query($this->_sel);
            if($res === FALSE){
                echo "falha na consulta";
                return null;
            }else{
                $arived= mysql_fetch_assoc($res);
                echo $arived['usuario'];
                //sleep(1000);
                return $arived;
            }            
        }
        
        public function testeInsert($res){
            if($res != TRUE)
                echo 'falha na operação';  
        }
        
        public function busca(){            
            $res= mysql_query($this->_sel);
            if($res === FALSE){
                echo "falha na consulta";
                return null;
            }else{                
                return $res;
            }            
        }
               
    }
?>
