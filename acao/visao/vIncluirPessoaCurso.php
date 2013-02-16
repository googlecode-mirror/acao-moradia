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
        include_once '../bd/DBConnection.php';
        DataBase::createConection();
        ?>

        <link href="../css/button.css" rel="stylesheet" type="text/css" />                
        <script type="text/javascript" src="../js/jquery-1.2.1.pack.js"></script>                        
        <script type="text/javascript">
            //auto complete
            function lookup(pessoa) {
                if(pessoa.length == 0) {
                    // Hide the suggestion box.
                    $('#suggestions').hide();
                } else {
                    $.post("vAutoCompletePessoas.php", {queryString: ""+pessoa+""}, function(data){
                        if(data.length >0) {
                            $('#suggestions').show();
                            $('#autoSuggestionsList').html(data);
                        }
                    });
                }
            } // lookup

            function fill(thisValue) {
                $('#pessoa').val(thisValue);                                
            }
            
            function fill2(thisValue) {                
                $('#idPessoa').val(thisValue);                
            }
            
            function fill3(thisValue) {                
                $( "#descricao" ).html( thisValue );
                setTimeout("$('#suggestions').hide();", 200);
            }
        </script>
    </head>
    <body>  
        <div class="wrap">
            <?php
            require("vLayoutBody.php");
            ?>
            <div class="content">
                <?php
                require("vLayoutMargin.php");
                ?>              

                <div class="bloco" style="border: #b1b1b1 solid 2px;">

                    <form action="../controle/cIncluirPessoaCurso.php" method="post"/>
                    <div style="margin: 10px; border: #b1b1b1 solid 2px;">                         
                        <center>                            
                            <h2>Inclusão de pessoa em curso</h2>
                        </center>                          
                        <div style="margin: 25px; float:left; ">
                            <p>Entre com o nome da pessoa a ser inclusa no curso:</p>
                            <input id="pessoa" name="pessoa" size="50" required="required" onkeyup="lookup(this.value);" onblur="fill();" autofocus="autofocus" autocomplete="off"/><a href="vCadastroPessoa.php"><img src="../imagens/bt_nao_encontrou_pessoa.png" style="margin-top: -20px; margin-bottom: -15px; margin-left: 30px;"></img></a>
                            <div class="suggestionsBox" id="suggestions" style="display: none;">
                                <img src="../imagens/upArrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
                                <div class="suggestionList" id="autoSuggestionsList">
                                    &nbsp;
                                </div>
                            </div>
                            <input type="hidden" id="idPessoa" name="idPessoa"/>
                            <p id="descricao"></p>


                            <p>&nbsp;</p>
                            <p>Selecione o curso:</p>
                            <?php
                            //error_reporting(E_ALL & ~ E_NOTICE);

                            $curso_block = "";
                            $cursos = mysql_query("SELECT `id_curso`,`nome`,`vagas` FROM `curso`") or die(mysql_error());

                            while ($curso = mysql_fetch_array($cursos)) {
                                $res = mysql_fetch_assoc(mysql_query("select count(*) as ocupadas from curso_has_pessoa where id_curso=" . $curso['id_curso']));
                                $vagas = $curso['vagas'] - $res['ocupadas'];

                                if ($vagas > 0) {
                                    $idCurso = $curso['id_curso'];
                                    $nomeCurso = $curso['nome'];
                                    $curso_block .= '<OPTION value="' . $idCurso . '">' . $nomeCurso . '</OPTION>';
                                } else {
                                    $curso_block .= '<OPTION> NÃO HÁ VAGAS DISPONÍVEIS PARA NENHUM CURSO</OPTION>';
                                }
                            }
                            ?>
                            <select id="idCurso" name="idCurso"><?php echo $curso_block; ?></select>

                            <input type="hidden" id="et" name="et" value="1"/>
                            <p>&nbsp;</p>
                            <?php
//                            if($_SESSION['nivel'] == 'ADMINISTRADOR')
//                            echo'
                            ?>
                            <p>
                                <input type="image" src="../imagens/bt_incluir_novo.png"/>
                            </p>

                            <p>&nbsp;</p>                            
                            <a href="vCadastroCursoNew.php"><img src="../imagens/bt_exibir_cursos.png"></img></a>

                        </div>                        
                    </div>                    
                    <br/>
                    </form>                                    
                </div>
                <br>
                    <p style="font-weight: bold; color: red;">OBS.: Pessoas Inativas NÃO podem realizar cursos.</p>
            </div>            
        </div>        
    </body>
    <footer>
        <?php
        require("vLayoutFooter.php");
        ?>
    </footer>
</html>