<?php
    class sessao{
       
        public static function initeSession($login){
            //sessao::endSession();
            session_start();
            $_SESSION['login'] = $login;
        }
        
        public static function endSession(){
            session_unset();
            session_destroy();
        }
    }

?>
