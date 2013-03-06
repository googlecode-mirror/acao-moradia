<?php
    require_once 'bd.php';
    class DataBase{
        
        private static $_con;        
        
        public static function createConection(){            
            $senha = new Senha();
            $_con= @mysql_connect("localhost", "root", $senha->getSenha());
            mysql_set_charset('utf8');
            mysql_query("SET NAMES 'utf8'");	/*PARA TRABALHAR COM ACENTOS SEM PROBLEMAS*/
            mysql_query("SET character_set_connection=utf8");
            mysql_query("SET character_set_client =utf8");
            mysql_query("SET character_set_results = utf8");
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
            if(DataBase::$_con === TRUE)
                return TRUE;
            return FALSE;
        }                        
    }
?>
