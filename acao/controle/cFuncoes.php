<?php
/*RETORNA YYYY-MM-DD*/
//include_once '../bd/Debug.php';
class Funcoes{
    public static function toMySqlDate($data) {        
        if($data != NULL){            
            $ano = $data[6].$data[7].$data[8].$data[9];
            $mes = $data[3].$data[4];
            $dia = $data[0].$data[1];
            $data = $ano.'-'.$mes.'-'.$dia;
        }                
        //Debug::gravaEmArquivo($data);
        return $data;
    }

    /*RECEBE UMA DATA NO FORMATO YYYY-MM-DD E RETORNA DD/MM/YYYY*/
    public static function toUserDate($data) {
        if($data != NULL){            
            $dia = $data[8].$data[9];
            $mes = $data[5].$data[6];
            $ano = $data[0].$data[1].$data[2].$data[3];
            if($dia == '00'){
                return '';
            }
            return $dia.'/'.$mes.'/'.$ano;
            
        }else{
            return "";
        }
        
    }
}
?>
