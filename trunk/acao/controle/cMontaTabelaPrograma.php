<?php
    require_once '../bd/PessoaHasProgramaDAO.php';
    require_once '../bd/ProgramaDAO.php';    
    
    $idPrograma = $_POST['idPrograma'];
    
    $pessoaHasPrograma = new PessoaHasProgramaDAO();    
    $programaDAO = new ProgramaDAO();    
    
    $dados_programa = $programaDAO->buscaProgramaById($idPrograma);
    
    $pessoas = $pessoaHasPrograma->buscaPessoasDoPrograma($idPrograma);   
    
?>
<html>
    <head>
        <link href="../mate-2.2/css/table_styles.css" rel="stylesheet" type="text/css" />
        <link href="../mate-2.2/css/icon_styles.css" rel="stylesheet" type="text/css" />
    </head>
    <br><br>
    <body>
        Dados do Programa:        
        <table cellpadding="1" width="120%" class="mateTable">
            <tbody>
            <tr class="header" style="background: #009900;">
                <td>
                    Programa
                </td>
                <td>
                    Nº de pessoas participantes
                </td>                
            </tr>
            <?php                                                                             
                echo '<tr>';
                echo "<td> $dados_programa[nome] </td>";
//                echo "<td> $dados_programa[vagas] </td>";                                                
                echo "<td> ". mysql_num_rows($pessoas)."</td>";
                echo '</tr>';                
            ?>                        
        </table> 
        <br><br>
        Pessoas participantes:
        <table cellpadding="1" width="120%" class="mateTable">
            <tbody>
            <tr class="header" style="background: #009900;">
                <td>
                    Pessoa
                </td>                
                <td>
                    Remover
                </td>
            </tr>
            <?php                
                while($pessoa=  mysql_fetch_assoc($pessoas)){
                    echo "<tr style='background-color:#aaffba;'>";
                    echo "<td> $pessoa[nome] </td>";                                                                
                    //if($_SESSION['nivel'] == 'ADMINISTRADOR'){
                        echo "<td><a class='delete' href='../controle/cRemoverPessoaPrograma.php?id_pessoa=$pessoa[id_pessoa]&id_programa=$idPrograma' onclick='return confirmaExclusaoPessoaPrograma();'><img src='../mate-2.2/images/icons/remove.png'/></a></td>";
                    //}
                    echo '</tr>';                
                }
            ?>                        
        </table> 
    </body>
</html>