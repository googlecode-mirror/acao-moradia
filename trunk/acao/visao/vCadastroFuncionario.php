<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php
        require("vLayoutHead.php");
        ?>
        <link href="../css/button.css" rel="stylesheet" type="text/css" />

        <script type="text/javascript" src="../js/jquery-1.8.0.min.js"></script>
        <script type="text/javascript" src="../js/jquery-1.8.3.js"></script>    
        <script type="text/javascript" src="../js/jquery.maskedinput-1.2.pack.js"></script>
        <script type="text/javascript" src="../js/scripts.js"></script>S

    </head>
    <body>
        <?php /*
          include_once 'sessao.php';
          ob_start();
          session_start();

          if(isset($_SESSION['nivel'])!= true){
          header("Location: vLogin.php");
          } */
        ?>         
        <div class="wrap">
            <?php
            require("vLayoutBody.php");
            ?>
            <div class="content">
                <?php
                require("vLayoutMargin.php");
                ?>              
                              
                <div class="bloco" style="border: #b1b1b1 solid 2px;">

                    <form name="cadastro" action="../controle/cCadastraFuncionario.php" method="post"/>

                    <div style="margin: 10px; border: #b1b1b1 solid 2px;">                         
                        <center>
                            <h2>Cadastro de Funcionário</h2>
                        </center>                          
                        <div style="margin: 25px; float:left; ">
                            <h3>&nbsp;</h3>
                            <h3>Dados do Funcionário: </h3>
                            <p>&nbsp;</p>
                            <p>Usuário: (*)</p>
                            <p><input type="text" id="usuario" name="usuario" size="30" value="" maxlength="100" /></p>
                            <p><br/>Senha: (*)</p>
                            <p><input type="password" name="senha" id="senha" size="30" value="" maxlength="100" /></p>
                            <p>&nbsp;</p>
                            <p>Nível:</p> 
                            <select name="nivel">                                
                                <option>Atendente</option>                               
                            </select>
                            <p>&nbsp;</p>


                            <center>
                                <p>
                                    <input type="submit" class="button blue" value="Cadastrar >>" onclick="return valida_nome();"/>
                                </p>
                            </center>
                        </div>

                    </div>

                    </form>

                </div>          

                <div class="txt">Os campos com * são obrigatórios</div> 

            </div>

        </div>
    </body>
    <footer>
        <?php
        require("vLayoutFooter.php");
        ?>  
    </footer>
</html>
