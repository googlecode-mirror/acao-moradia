<?php
/*RETORNA YYYY-MM-DD*/
class Funcoes{
    public static function toMySqlDate($data) {        
        $ano = $data[6].$data[7].$data[8].$data[9];
        $mes = $data[3].$data[4];
        $dia = $data[0].$data[1];
        $data = $ano.'-'.$mes.'-'.$dia;
        return $data;
    }

    /*RECEBE UMA DATA NO FORMATO YYYY-MM-DD E RETORNA DD/MM/YYYY*/
    public static function toUserDate($data) {
        $dia = $data[8].$data[9];
        $mes = $data[5].$data[6];
        $ano = $data[0].$data[1].$data[2].$data[3];
        return $dia.'/'.$mes.'/'.$ano;
    }
}
?>
