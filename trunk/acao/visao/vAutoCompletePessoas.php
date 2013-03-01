<?php
    /**
     * vAutoCompletePessoas.php
     * Arquivo utilizado para auxiliar o processo de autocompletar com a pessoa que deseja 
     * matricular em um curso
     */
    include_once '../bd/DBConnection.php';
    DataBase::createConection();

    if(isset($_POST['queryString'])) {												
        $queryString = $_POST['queryString'];
        if(strlen($queryString) >3) {//3 é o nº mínimo de caracteres que precisam ser digitados para autocompletar
            $query = mysql_query("SELECT p.nome,p.id_pessoa, f.logradouro, f.numero FROM pessoa p, familia f where p.id_familia = f.id_familia and p.ativo=1 and p.nome like '%$queryString%' LIMIT 10");
            if($query) {					
                while ($result = mysql_fetch_assoc($query)) {
                    echo '<li onClick="fill(\''.$result['nome'].'\');fill2(\''.$result['id_pessoa'].'\');fill3(\''.'Endereço: '.$result['logradouro'].','.$result['numero'].'\');">'.$result['nome'].'<br>Endereço: '.$result['logradouro'].', '.$result['numero'].'</li>';
                }
            } 
        } 
    } 		
?>