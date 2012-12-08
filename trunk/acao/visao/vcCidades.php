<?php
    $idestado = $_GET['estado'];

    include_once '../bd/DBConnection.php';
    DataBase::createConection();

    $result = mysql_query("SELECT * FROM cidade WHERE cod_estado = ".$idestado);

    while($row = mysql_fetch_array($result) ){
         echo "<option value='".$row['cod_cidade']."'>".$row['nome']."</option>";

    }
?>