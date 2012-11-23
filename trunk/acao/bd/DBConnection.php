<?php
    class DataBase{
        
        private static $_con;
        
        public static function createConection(){
            $_con= @mysql_connect("localhost", "root", "");
            mysql_set_charset('utf8');
            if($_con === FALSE){
                echo "GBD conection failure";
                mysql_error();
                exit;
            }
            else{
                mysql_select_db("acao_moradia", $_con);
                if($_con === FALSE){
                    echo "Data base selection failure";
                    mysql_error();
                    exit();
                }
            }            
        }
        
        public static function isGoodConection(){
            if($_con === TRUE)
                return TRUE;
            return FALSE;
        }        
    }
?>
