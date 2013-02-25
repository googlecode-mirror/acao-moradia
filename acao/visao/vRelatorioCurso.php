<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php
        session_start();
        if (!isset($_SESSION['nivel'])) {
            header('Location: ../visao/vLogin.php');
        }
        require("vLayoutHead.php");
        ?>

        <?php
        include_once '../controle/cFuncoes.php';
        include_once '../bd/DBConnection.php';
        DataBase::createConection();
        ?>

        <link href="../css/button.css" rel="stylesheet" type="text/css" />                        
        <script type="text/javascript" src="../js/jquery-1.8.3.js"></script>
        <script>            
            function confirma(){
                if(confirm("Você realmente deseja retirar esta pessoa deste curso?")){
                    return true;
                }else{
                    return false;
                }
            }
            function updateTable(){                
                $.ajax({
                    type      : 'post', 
                    url       : '../controle/cMontaTabelaCurso.php', 
                    data      : 'idCurso='+ $('#idCurso').val()+'&idPessoa='+ $('#idPessoa').val(), 
                    dataType  : 'html', 
                    success : function(txt){
                        $('#showtable').html(txt);
                    }                    
                });                     
            }
        </script>
    </head>
    <body onload="updateTable();">  
        <div class="wrap">
            <?php
            require("vLayoutBody.php");
            ?>
            <div class="content">
                <?php
                require("vLayoutMargin.php");
                ?>              

                <div class="bloco" style="border: #b1b1b1 solid 2px; min-height:5000px;">                    
                    <form action="../controle/cIncluirPessoaCurso.php" method="post"/>
                    <input type="hidden" name="idPessoa" id="idPessoa" value="<?php if(isset($_GET['id_pessoa']))echo $_GET['id_pessoa']; else echo '-1'; ?>"/>
                    <div style="margin: 10px; border: #b1b1b1 solid 2px;">                         
                        <center>                            
                            <h2>Inclusão de pessoa em curso</h2>
                        </center>                          
                        <div style="margin: 25px; float:left; ">                            
                            <p>Selecione o curso:</p>
                            <?php
                            //error_reporting(E_ALL & ~ E_NOTICE);                            
                            $curso_block = "";
                            $cursos = mysql_query("SELECT `id_curso`,`nome`,`vagas`, `data_inicio` FROM `curso`") or die(mysql_error());

                            if(isset($_GET['id_curso'])){                                                            
                                  while ($curso = mysql_fetch_array($cursos)) {
                                    //$vagas = $curso['vagas'] - $res['ocupadas'];                                
                                    $idCurso = $curso['id_curso'];
                                    $nomeCurso = $curso['nome'];
                                    if($idCurso == $_GET['id_curso']){
                                        $curso_block .= '<OPTION selected value="' . $idCurso . '">' . $nomeCurso . ' - '.  Funcoes::toUserDate($curso['data_inicio']). '</OPTION>';
                                    }else{
                                        $curso_block .= '<OPTION value="' . $idCurso . '">' . $nomeCurso . '</OPTION>';
                                    }
                                }
                            }else{
                                while ($curso = mysql_fetch_array($cursos)) {
                                    //$vagas = $curso['vagas'] - $res['ocupadas'];                                
                                    $idCurso = $curso['id_curso'];
                                    $nomeCurso = $curso['nome'];
                                    $curso_block .= '<OPTION value="' . $idCurso . '">' . $nomeCurso . ' - '.  Funcoes::toUserDate($curso['data_inicio']). '</OPTION>';
                                }
                            }
                            //$curso_block .= '<OPTION value="1">Leonardo</OPTION>';
                            ?>

                            <select id="idCurso" name="idCurso" onchange="updateTable()"><?php echo $curso_block; ?></select>

                            <p>&nbsp;</p>
                            <a href="vCadastroCursoNew.php" title="Visualizar todos os cursos"><img src="../imagens/bt_exibir_cursos.png"></img></a>
                            <a href="vIncluirPessoaCurso.php" title="Inclua uma pessoa em um curso"><img src="../imagens/bt_incluir_novo.png"></img></a>
                            <div id="showtable"></div>

                        </div>                        
                    </div>                    
                    <br/>
                    </form>                                    
                </div>                
            </div>            
        </div>        
    </body>
    <footer>
        <?php
        require("vLayoutFooter.php");
        ?>
    </footer>
</html>