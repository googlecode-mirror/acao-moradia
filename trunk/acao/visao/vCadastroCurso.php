<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php
        require("vLayoutHead.php");
        ?>

        <link href="../css/button.css" rel="stylesheet" type="text/css" />

        <script type="text/javascript" src="../js/jquery-1.8.3.js"></script>    
        <script type="text/javascript" src="../js/jquery.maskedinput.js"></script>               
        <script type="text/javascript" src="../js/scripts.js" ></script>        
        <script>
            jQuery(function(){
                jQuery("#vagas").mask("9?99999");
                
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

                    <form name="cadastro" action="../controle/cCadastraCurso.php" method="post"/>
                    <div style="margin: 10px; border: #b1b1b1 solid 2px;">                         
                        <center>                            
                            <h2>Cadastro de Curso</h2>                            
                        </center>                          
                        <div style="margin: 25px; float:left; ">
                            <h3>&nbsp;</h3>
                            <p>&nbsp;</p>
                            <p>Nome do curso: (*)</p>
                            <p><input type="text" id="nome" name="nome" size="30" value="" maxlength="100" required="required"/></p>
                            <p><br />Número de vagas: (*)</p>
                            <p><input name="vagas" id="vagas" size="4" value="" maxlength="3" min="0" required="required" type=""/></p>
                            <p>&nbsp;</p>
                            <p>Data de início: (*)</p>
                            <p><input type="date" maxlength="10" id="dataInicio" name="dataInicio" size="11" required="required"/></p>
                            <p>&nbsp;</p>
                            <p>Data de término: (*)</p>
                            <p><input type="date" maxlength="10" id="dataTermino" name="dataTermino" size="11" required="required"/></p><!--onblur="validaData(this,this.value)"-->
                            <p>&nbsp;</p>
                            <p><br />Carga horária: </p>
                            <p><input type="number" name="cargaHoraria" id="cargaHoraria" size="4" value="" maxlength="3" min="0" step="0.1"/> horas </p>
                            <p>&nbsp;</p>
                            <p>Pré-requisitos:</p>
                            <p><input type="text" id="preRequisitos" name="preRequisitos" size="30" value=""/></p>
                           <!--<p><textarea rows="4" cols="30" form="cadastro" style="resize: none;" id="preRequisitos" name="preRequisitos"> </textarea></p>-->
                            <p>&nbsp;</p>
                            <p>Dias da semana:</p>
                            <!--<p><input type="text" id="diasSemana" name="diasSemana" size="30" value="" maxlength="100"/></p>-->
                            <input type='checkbox' value='domingo' name='diasSemana[]'/>Domingo<br/>
                            <input type='checkbox' value='segunda' name='diasSemana[]'/>Segunda-feira<br/>
                            <input type='checkbox' value='terça' name='diasSemana[]'/>Terça-feira<br/>
                            <input type='checkbox' value='quarta' name='diasSemana[]'/>Quarta-feira<br/>
                            <input type='checkbox' value='quinta' name='diasSemana[]'/>Quinta-feira<br/>
                            <input type='checkbox' value='sexta' name='diasSemana[]'/>Sexta-feira<br/>
                            <input type='checkbox' value='sabado' name='diasSemana[]'/>Sábado<br/>
                        </div>
                    </div>
                    <br/>                    
                    <center>
                        <p>
                            <input type="submit" class="button blue" value="Cadastrar" <!--onclick="return controla(); -->"/>
                    </p>
                </center>
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
