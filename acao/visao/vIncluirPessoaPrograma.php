<?php
/**
 * vIncluirPessoaCurso.php - Inclui pessoa em curso
 */
session_start();
if (!isset($_SESSION['nivel'])) {
    header('Location: ../visao/vLogin.php');
}
require("vLayoutHead.php");
require_once '../controle/cFuncoes.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>

        <?php
        include_once '../bd/DBConnection.php';
        DataBase::createConection();
        ?>                
        <script type="text/javascript" src="../js/jquery-1.8.3.js"></script>
        <script type="text/javascript" src="../js/jquery.maskedinput.js"></script>
        <script type="text/javascript" src="../js/scripts.js"></script>
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

                <div class="bloco" style="border: #b1b1b1 solid 2px; min-height: 500px">

                    <form action="../controle/cIncluirPessoaPrograma.php" method="post"/>
                    <div style="margin: 10px; border: #b1b1b1 solid 2px;">                         
                        <center>                            
                            <h2>Inclusão de pessoa em programa</h2>
                        </center>                          
                        <div style="margin: 25px; float:left; ">
                            <p>Entre com o nome da pessoa a ser inclusa no programa:</p>
                            <input id="pessoa" name="pessoa" size="50" required="required" onkeyup="tratarTecla(this,event);" onkeypress="lookupperson(this.value);" onblur="fill();" autofocus="autofocus" autocomplete="off"/><a href="vCadastroPessoa.php"><img src="../imagens/bt_nao_encontrou_pessoa.png" style="margin-top: -20px; margin-bottom: -15px; margin-left: 60px;"></img></a>
                            <div class="suggestionsBox" id="suggestions" style="display: none;">
                                <img src="../imagens/upArrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
                                <div class="suggestionList" id="autoSuggestionsList">
                                    &nbsp;
                                </div>
                            </div>
                            <input type="hidden" id="idPessoa" name="idPessoa" value="-1"/>
                            <p id="descricao"></p>


                            <p>&nbsp;</p>
                            <p>Selecione o programa:</p>
                            <?php
                            //error_reporting(E_ALL & ~ E_NOTICE);

                            $programa_block = "";
                            $programas = mysql_query("SELECT `id_programa`,`nome` FROM `programa`") or die(mysql_error());

                            while ($programa = mysql_fetch_array($programas)) {
                                //$res = mysql_fetch_assoc(mysql_query("select count(*) as ocupadas from curso_has_pessoa where id_curso=" . $curso['id_curso']));
                                //$vagas = $curso['vagas'] - $res['ocupadas'];

                                //if ($vagas > 0) {
                                    $idPrograma = $programa['id_programa'];
                                    $nomePrograma = $programa['nome'];
                                    $programa_block .= '<OPTION value="' . $idPrograma. '">' . $nomePrograma . '</OPTION>';
                                //} else {
                                    //$curso_block .= '<OPTION> NÃO HÁ VAGAS DISPONÍVEIS PARA NENHUM CURSO</OPTION>';
                                //}
                            }
                            ?>
                            <select id="idPrograma" name="idPrograma"><?php echo $programa_block; ?></select>

                            <input type="hidden" id="et" name="et" value="1"/>
                            <p>&nbsp;</p>
                            <?php
//                            if($_SESSION['nivel'] == 'ADMINISTRADOR')
//                            echo'
                            ?>
                            <p>
                                <input type="image" src="../imagens/bt_incluir_novo.png" onclick="return valida_aluno();"/>
                            </p>

                            <p>&nbsp;</p>                            
<!--                            <a href="vCadastroCursoNew.php"><img src="../imagens/bt_exibir_cursos.png"></img></a>-->

                        </div>                        
                    </div>                    
                    <br/>
                    </form>                                    
                </div>
                <br>
                    <p style="font-weight: bold; color: red;">OBS.: Pessoas Inativas NÃO podem participar de programas.</p>
            </div>            
        </div>        
    </body>
    <footer>
        <?php
        require("vLayoutFooter.php");
        ?>
    </footer>
</html>