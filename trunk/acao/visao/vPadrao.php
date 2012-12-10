<!-- PADRÃO DE LAYOUT COM DIVS, ETC --> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php
        require("vLayoutHead.php");
        ?>

        <link href="../css/button.css" rel="stylesheet" type="text/css" />
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


                    <div style="margin: 10px; border: #b1b1b1 solid 2px;">                         
                        <center>                            
                            <h2>Título</h2>
                        </center>                          
                        <div style="margin: 25px; float:left; ">
                            <!-- ESCREVA O CONTEÚDO AQUI -->
                            ESCREVA O CONTEÚDO AQUI
                        </div>
                    </div>
                    <br/>            
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