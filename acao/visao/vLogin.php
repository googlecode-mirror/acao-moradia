<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php
        /**
        * VLogin.php
        * Arquivo inicial do Site. 
        * Através dele o usuário fará login.
        */
        require("vLayoutHead.php");
        ?>        
    </head>
    <body onLoad="document.logar.login.focus();">
        <?php
        session_start();
        if (isset($_SESSION['nivel']))
            if ($_SESSION['nivel'] === "atendente")
                header("Location: vAtendente.php");
            elseif ($_SESSION['nivel'] === "admin")
                header("Location: vAdmin.php");
        ?>
        <div class="wrap">
            <div class="header">
                <div class="logo">
                    <div class="lg"></div>
                </div>
                <div class="titulo">
                    <div class="txt">
                        <ul><li><h2>Sistema de Cadastro e Relatório</h2> </li></ul>
                    </div>
                </div>    
                <div class="menu">
                    <div class="tit_login"></div>
                    <div class="mn" align="center">
                        <br/><br/>
                        <form name="logar" action="../controle/cLogin.php" method="post">
                            Usuário:<input style="width:140px; "type="text" id="login" name="log" autofocus="autofocus"/>
                            Senha:<input style="width:115px;" type="password" id="pass" name="password" />
                            <input type="submit" class="small black" value="Enviar" />
                        </form>
                    </div>
                </div>
            </div>  
            <div class="content">
<!--                <div class="home">
                    <div class="txt">Digite seu usuário e senha nos campos acima para acessar o sistema</div>
                </div>-->
            </div>

        </div>
        <?php
        //include_once 'sessao.php';
        if (isset($_GET['mess']))
            echo $_GET['mess'];
        ?>
    </body>
    <footer>
        <?php
        require("vLayoutFooter.php");
        ?>
    </footer>
</html>