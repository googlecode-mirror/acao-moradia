<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php
        require("vLayoutHead.php");
        ?>

        <link href="../css/button.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="../css/jqac.css" />
        <script type="text/javascript" src="../js/jquery.autocomplete-1.4.2.js"></script>
        <script type="text/javascript" src="../js/jquery-1.8.3.js"></script>

        <script>
            $(document).ready(function(){
                $("#nomePessoa").autocomplete("vAutocompleteNomePessoa.php", {
                    selectFirst: true
                });
            });
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
                            <h2>Inclusão de uma pessoa em um curso</h2>
                        </center>                          
                        <div style="margin: 25px; float:left; ">
                            <h3>&nbsp;</h3>
                            <p>&nbsp;</p>
                            <p>Entre com o nome da pessoa a ser inclusa no curso:</p>
                            <input name="nomePessoa" type="text" id="nomePessoa" size="30" required="required"/>

                            <p>&nbsp;</p>
                            <p>Selecione o curso:</p>
                            <?php
                            include_once '../bd/DBConnection.php';
                            DataBase::createConection();
                            //error_reporting(E_ALL & ~ E_NOTICE);

                            $curso_block = "";
                            $cursos = mysql_query("SELECT `id_curso`,`nome` FROM `curso`") or die(mysql_error());

                            while ($curso = mysql_fetch_array($cursos)) {
                                $idCurso = $curso['id_curso'];
                                $nomeCurso = $curso['nome'];
                                $curso_block .= '<OPTION value="' . $idCurso . '">' . $nomeCurso . '</OPTION>';
                            }
                            ?>
                            <select><?php echo $curso_block; ?></select>

                            <input type="hidden" id="et" name="et" value="1"/>
                            <p>&nbsp;</p>
                            <p>
                                <input type="submit" class="button blue" value="Inserir""/>
                            </p>

                        </div>
                    </div>
                    <br/>
                    <?php
                    if (isset($vet)) {
                        printr($vet);
                    }
                    ?>
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