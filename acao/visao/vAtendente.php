<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php
        require("vLayoutHead.php");
        ?>
    </head>

    <body>
        <?php
        session_start();
        if (!isset($_SESSION['nivel'])) {
            header("Location: vLogin.php");
        }
        ?>
        <div class="wrap">
            <?php
            require("vLayoutBody.php");
            ?>

            <div class="content">
                <div style="margin-top:70px; margin-left:250px;">
                    <div class="menu_cadastros">
                        <div class="tit">Cadastros</div>
                        <div class="bts">
                            <ul><li><a href="vCadastroFuncionarioNew.php" target="_parent">Funcionários</a></li></ul>
                        </div>

                        <div class="bts">
                            <ul><li><a href="vPreCadastro.php" target="_parent">Pessoas</a></li></ul>
                        </div>

                        <div class="bts">
                            <ul><li><a href="vIncluirPessoaCurso.php" target="_parent">Cursos</a></li></ul>
                        </div>

                        <div class="bts">
                            <ul><li><a href="" target="_parent"><s>Programas</a></s></li></ul>
                        </div>
                        
                        <div class="bts">
                            <ul><li><a href="vEditOrDeleteFamilia.php" target="_parent">Famílias</a></li></ul>
                        </div>
                    </div>

                    <div class="menu_relatorios" style="margin-left:30px;">
                        <div class="tit">Relatórios</div>
                        <div class="bts">
                            <ul><li><a href="vFuncionario.php" target="_parent">Funcionários</a></li></ul>
                        </div>                
                        <div class="bts">
                            <ul><li><a href="" target="_parent"><s>Pessoas</a></s></li></ul>
                        </div>                
                        <div class="bts">
                            <ul><li><a href="" target="_parent"><s>Cursos</a></s></li></ul>
                        </div>                
                        <div class="bts">
                            <ul><li><a href="" target="_parent"><s>Programas</s></a></li></ul>
                        </div>
                        <div class="bts">
                            <ul><li><a href="" target="_parent"><s>Famílias</s></a></li></ul>
                        </div>
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
