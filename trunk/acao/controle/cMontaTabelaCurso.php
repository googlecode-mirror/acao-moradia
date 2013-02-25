<?php
    require_once '../bd/CursoHasPessoaDAO.php';
    require_once '../bd/CursoDAO.php';
    require_once 'cFuncoes.php';
    
    $idCurso = $_POST['idCurso'];
    
    $cursoHasPessoaDAO = new CursoHasPessoaDAO();    
    $cursoDAO = new CursoDAO();    
    
    $dados_curso = $cursoDAO->buscaDados($idCurso);
    
    $alunos = $cursoHasPessoaDAO->buscaAlunosDoCurso($idCurso);   
    
?>
<html>
    <head>
        <link href="../mate-2.2/css/table_styles.css" rel="stylesheet" type="text/css" />
        <link href="../mate-2.2/css/icon_styles.css" rel="stylesheet" type="text/css" />
    </head>
    <br><br>
    <body>
        Dados do Curso:        
        <table cellpadding="1" width="120%" class="mateTable">
            <tbody>
            <tr class="header" style="background: #009900;">
                <td>
                    Curso
                </td>
                <td>
                    Vagas Total
                </td>
                <td>
                    Vagas Disp.
                </td>
                <td>
                    Lista de espera
                </td>
                <td>
                    Data início
                </td>
                <td>
                    Data término
                </td>
                <td>
                    Dias da semana
                </td>                                
            </tr>
            <?php                                             
                $disponiveis = $dados_curso['vagas']-mysql_numrows($alunos);
                $lista_espera = $dados_curso['vagas']-mysql_numrows($alunos);
                if($disponiveis < 0 ){
                    $disponiveis = 0;
                    $lista_espera = abs($lista_espera);
                }else{
                    $lista_espera = 0;
                }
                
                echo '<tr>';
                echo "<td> $dados_curso[nome] </td>";
                echo "<td> $dados_curso[vagas] </td>";                
                echo "<td> $disponiveis </td>";
                echo "<td> $lista_espera </td>";
                echo "<td>".Funcoes::toUserDate($dados_curso['data_inicio'])."</td>";
                echo "<td>".Funcoes::toUserDate($dados_curso['data_termino'])."</td>";
                echo "<td>". $dados_curso['seg']. $dados_curso['ter']. $dados_curso['qua']. $dados_curso['qui']. $dados_curso['sex']. $dados_curso['sab']. $dados_curso['dom'] ."</td>";
                echo '</tr>';                
            ?>                        
        </table> 
        <br><br>
        Situação das pessoas matriculadas:
        <table cellpadding="1" width="120%" class="mateTable">
            <tbody>
            <tr class="header" style="background: #009900;">
                <td>
                    Pessoa
                </td>
                <td>
                    Situação
                </td>
                <td>
                    Data Inscrição
                </td>                
                <?php 
                    //session_start();
                    //if($_SESSION['nivel'] == 'ADMINISTRADOR'){
                        echo "<td>Remover</td>";
                    //}
                ?>
            </tr>
            <?php                
                while($aluno=  mysql_fetch_assoc($alunos)){
                    echo "<tr style='background-color:";
                    if($aluno['situacao_matricula'] == 'LISTA DE ESPERA'){
                        echo "#ffffaa;";
                    }else{
                        echo "#aaffba;";
                    }
                    if($aluno['id_pessoa'] == $_POST['idPessoa']){
                        echo "font-weight:bold;font-size:1.5em";
                    }
                    echo "'>";                    
                    echo "<td> $aluno[nome] </td>";                                            
                    echo "<td> $aluno[situacao_matricula] </td>";                                                        
                    echo "<td> $aluno[data_inscricao]</td>";                    
                    //if($_SESSION['nivel'] == 'ADMINISTRADOR'){
                        echo "<td><a class='delete' href='../controle/cRemoverPessoaCurso.php?id_pessoa=$aluno[id_pessoa]&id_curso=$idCurso' onclick='return confirma();'><img src='../mate-2.2/images/icons/remove.png'/></a></td>";
                    //}
                    echo '</tr>';                
                }
            ?>                        
        </table> 
    </body>
</html>