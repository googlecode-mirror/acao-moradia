<?php
include_once '../bd/DBConnection.php';
include_once '../bd/PessoaDAO.php';

class Pesquisa{
public static function buscaGenerica($table, $attribute, $query) {        
    DataBase::createConection();
    if (strtolower($table) == "pessoa"){//funcao de pesquisa de pessoa
        $pessoaD= new PessoaDAO();
        //$resultBoolean= $pessoaD->buscaPessoaByAttribute($attribute, $query);
        
        $result= $pessoaD->buscaAllOfPessoaByAttribute($attribute, $query);
        
        return $result;
        
        
    }
       
        //return $data;
    }
    
    
    
    
    
    
    
    
    
    
}

?>
