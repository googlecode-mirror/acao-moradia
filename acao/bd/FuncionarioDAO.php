<?php
    include_once '../controle/cFuncoes.php';
    class FuncionarioDAO{
        
        private $_sel= "SELECT * FROM login";   
        private $_ins= "INSERT INTO `login`(`usuario`, `senha`, `nivel`) VALUES";        
        private $_rem= "DELETE FROM login WHERE";
        private $_alt= "UPDATE login set";           
        
        public function cadastraFuncionario($usuario, $senha, $nivel){
        
            $this->_ins."('$usuario', '$senha', '$nivel')";
   
            //echo $this->_ins."<br>";
            
            $_res= mysql_query($this->_ins)or die(mysql_error());
            if($_res != TRUE)
                echo 'falha na operação login';
            
            return $_res;
            
        }
                     
    }
?>