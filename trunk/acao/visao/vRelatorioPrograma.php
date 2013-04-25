<?php
/**
* vRelatorioCurso.php - o usuário poderá visualizar em cada curso cadastrado, 
* a situação de cada pessoa inscrita no curso.
*/
session_start();
if (!isset($_SESSION['nivel'])) {
    header('Location: ../visao/vLogin.php');
}
require("vLayoutHead.php");
include_once '../controle/cFuncoes.php';
include_once '../bd/DBConnection.php';
DataBase::createConection();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>        
        <script type="text/javascript" src="../js/jquery-1.8.3.js"></script>        
        <script type="text/javascript" src="../js/scripts.js"></script>        
    </head>
    <body onload="updateTablePrograma();">      
        <div class="wrap">
            <?php
            require("vLayoutBody.php");
            ?>
            <div class="content">
                <?php
                require("vLayoutMargin.php");
                ?>              

                <div class="bloco" style="border: #b1b1b1 solid 2px; min-height:10000px;">                    
                    <form action="../controle/cIncluirPessoaPrograma.php" method="post"/>
                    <input type="hidden" name="idPessoa" id="idPessoa" value="<?php if(isset($_GET['id_pessoa']))echo $_GET['id_pessoa']; else echo '-1'; ?>"/>
                    <div style="margin: 10px; border: #b1b1b1 solid 2px;">                         
                        <center>                            
                            <h2>Inclusão de pessoa em programa</h2>
                        </center>                          
                        <div style="margin: 25px; float:left; ">                            
                            <p>Selecione o programa:</p>
                            <?php
                            //error_reporting(E_ALL & ~ E_NOTICE);                            
                            $programa_block = "";
                            $programas = mysql_query("SELECT `id_programa`,`nome` FROM `programa`") or die(mysql_error());

                            
                            if(isset($_GET['id_programa'])){
                                  while ($programa = mysql_fetch_array($programas)) {
                                    //$vagas = $curso['vagas'] - $res['ocupadas'];                                
                                    $idPrograma = $programa['id_programa'];
                                    $nomePrograma = $programa['nome'];
                                    if($idPrograma == $_GET['id_programa']){
                                        $programa_block .= '<OPTION selected value="' . $idPrograma . '">' . $nomePrograma . '</OPTION>';
                                    }else{
                                        $programa_block .= '<OPTION value="' . $idPrograma . '">' . $nomePrograma . '</OPTION>';
                                    }
                                }
                            }else{
                                while ($programa = mysql_fetch_array($programas)) {
                                    //$vagas = $curso['vagas'] - $res['ocupadas'];                                
                                    $idPrograma = $programa['id_programa'];
                                    $nome = $programa['nome'];
                                    $programa_block .= '<OPTION value="' . $idPrograma. '">' . $nome . '</OPTION>';
                                }
                            }
                            ?>

                            <select id="idPrograma" name="idPrograma" onchange="updateTablePrograma();"><?php echo $programa_block; ?></select>
                            
                            <p>&nbsp;</p>
                            <a href="vCadastroPrograma.php" title="Visualizar todos os programas"><img src="../imagens/bt_exibir_programas.png"></img></a>
                            <a href="vIncluirPessoaPrograma.php" title="Inclua uma pessoa em um programa"><img src="../imagens/bt_incluir_novo.png"></img></a>
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