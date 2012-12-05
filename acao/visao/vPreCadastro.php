<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php
        require("vLayoutHead.php");
        ?>
        <link href="../css/button.css" rel="stylesheet" type="text/css" />

        <script type="text/javascript" src="../js/jquery-1.8.3.js"></script>
                        
        <script type="text/javascript" > 
    
            $(document).ready(function(){
      
                $(".carregar_tabela").click(function(){
           
                    /*var id= $("#id_familia").val();
                var titular= $("#titular").val();
                var endereco= $("#endereco").val();*/
            
                    var query= $("#query").val();
        
                    $("#resultado").load('../controle/montaTabela.php',{query:query});
                
                })
        
                /* $(".__idFamilia").click(function(){
            
                alert('olá');
            
            })*/
      
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

                    <form name="cadastro" />
                    <div style="margin: 10px; border: #b1b1b1 solid 2px;">                         
                        <center>
                             <h2 id="etapa">Etapa 1/2: Vinculação com Família</h2>                            
                        </center>
                        <div style="margin: 25px; float:left;">
                            <h3>&nbsp;</h3>
                            <p>&nbsp;</p>
                                <br/><br/>
                                Digite alguma informação sobre a família
                                <br/><br/>
                                <!--<span>id da família</span><input id="id_familia" type="text" name="familia" value="" size="14"/> 
                                <span>nome titular</span><input id="titular" type="text" name="familia" value="" size="14"/>    
                                <span>endereço</span><input id="endereco" type="text" name="familia" value="" size="14"/>
                                -->
                                <input id="query" type="text" name="familia" value="" size="40"/>

                                <input type="button" class="carregar_tabela" value="Pesquisar"/>
                                <br/>                                 
                                <br/>
                                <br/>
                            

                            <div id="resultado">


                            </div>
                        </div>
                    </div>
                    <!--
                                        <div>
                                            <form action="../controle/cBuscaParente.php" method="get">
                                            <div>Pesquisar parente: <input type="text" name="parente" value=""/> <input type="submit" value="Pesquisar"/></div>
                                            </form>        
                    -->
                    <?php
                    if (isset($vet)) {
                        printr($vet);
                    }
                    ?>

                    
                        <!--<input type="submit" class="button blue" value="Próximo >>"/>-->
                        <a href="vPesquisaPessoa.php" class="button blue">Pesquisar pessoa</a>
                    

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
