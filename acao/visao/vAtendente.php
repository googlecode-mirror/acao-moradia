<?php
/**
 * VAtendente.php
 * Arquivo principal do Site. 
 * Através dele, podemos acessar as principais funcionalidades do sistema.
 */

//Verifica se o usuário está logado no sistema 
if(!isset($_SESSION))
    session_start();
if (!isset($_SESSION['nivel'])) {
    header("Location: vLogin.php");
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php
            require("vLayoutHead.php");
        ?>
    </head>

    <body>        
        <div class="wrap">
            <?php
            require("vLayoutBody.php");
            ?>

            <div class="content">
                <div style="margin-top:50px; margin-left:30%; ">
                    <div class="menu_cadastros">
                        <div class="tit">Cadastros</div>
                        <div class="bts">
                            <ul><li><a href="vCadastroLogin.php"><img src="../imagens/bt_login_novo.png" ></img></a></li></ul>
                        </div>

                        <div class="bts">
                            <ul><li><a href="vPessoa.php"><img src="../imagens/bt_pessoa_novo.png"></img></a></li></ul>
                        </div>

                        <div class="bts">
                            <ul><li><a href="vIncluirPessoaCurso.php"><img src="../imagens/bt_curso_novo.png"</img></a></li></ul>
                        </div>

                        <div class="bts">
                            <ul><li><a href="vCadastroPrograma.php"><img src="../imagens/bt_programa_novo.png"</img></a></li></ul>
                        </div>                        
                        <div class="bts">
                            <ul><li><a href="vEditOrDeleteFamiliaNew.php"><img src="../imagens/bt_familia_novo.png"</img></a></li></ul>
                        </div>
                    </div>

                    <div class="menu_relatorios" style="margin-left:30px;">
                        <div class="tit">Relatórios</div>
                        <div class="bts">
                            <ul><li><a href="vRelatorioCurso.php" target="_parent"><img src="../imagens/bt_curso_novo.png"</a></li></ul>
                        </div>                
                        <div class="bts">
                            <ul><li><a href="vRelatorioPrograma.php" target="_parent"><s><img src="../imagens/bt_programa_novo.png"</a></s></li></ul>
                        </div>                
<!--                        <div class="bts">
                            <ul><li><a href="" target="_parent"><s></a></s></li></ul>
                        </div>                
                        <div class="bts">
                            <ul><li><a href="" target="_parent"><s></s></a></li></ul>
                        </div>
                        <div class="bts">
                            <ul><li><a href="" target="_parent"><s></s></a></li></ul>
                        </div>-->
                    </div>
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
