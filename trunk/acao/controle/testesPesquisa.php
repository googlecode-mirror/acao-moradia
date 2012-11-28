<?php
include_once 'cPesquisa.php';

$res= Pesquisa::buscaGenerica("pesssoa", "nome", "Renato");

//echo "<table border= 1>";
//echo "<tr bgcolor= '#f0f0f0'>";
for($_i= 0; $_i< mysql_num_fields($res); $_i++){
    echo mysql_field_name($res, $_i);//. "</td>";
}
//echo '</tr>';

?>
