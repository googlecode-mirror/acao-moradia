<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Ação Moradia</title>
    <link type="image/x-icon" href="copy.ico" rel="icon"/>
    <link type="image/x-icon" href="copy.ico" rel="shortcut icon"/>
    <link href="../css/styles.css" rel="stylesheet" type="text/css" />
    <link href="../css/button.css" rel="stylesheet" type="text/css" />

    <script type="text/javascript" src="../js/jquery.js"></script>
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
        <div class="header">
            <div class="logo">
                <a href="vAtendente.php"><div class="lg"><h1>Ação Moradia</h1></div></a>
            </div>
            <div class="titulo">
                <div class="txt">
                    <ul><li><h2>Sistema de Cadastro e Relatório</h2> </li></ul>
                </div>
            </div>

            <div class="menu">
                <div class="mn">
                    <div class="menu_bts"> <a href="" target="_parent"><img src="../imagens/menu_cadastros.png" width="94" height="73" /></a> <a href="" target="_parent"><img src="../imagens/menu_relatorios.png" width="106" height="73" /></a><a href="" target="_parent"><img src="../imagens/menu_sobre.png" width="81" height="73" /></a><a href="" target="_parent"><img src="../imagens/menu_ajuda.png" width="76" height="73" /></a><a href="../controle/cLogout.php"><img src="../imagens/menu_logout.png" width="62" height="73" /></a></div>
                </div>
            </div>
        </div>

        <div class="content">
            <div style="margin-top:70px; margin-left:10px;">
                <div class="menu_cadastros">
                    <div class="tit">Cadastros</div>
                    <div class="bts">
                        <ul><li><a href="" target="_parent">Funcionários</a></li></ul>
                    </div>

                    <div class="bts">
                        <ul><li><a href="vPreCadastro.php" target="_parent">Pessoas</a></li></ul>
                    </div>

                    <div class="bts">
                        <ul><li><a href="" target="_parent">Cursos</a></li></ul>
                    </div>
                    <div class="bts">
                        <ul><li><a href="" target="_parent">Programas</a></li></ul>
                    </div>                    
                </div>
            </div>
            <!--<div class="navegador"><a href="#"><img src="../imagens/bt_confirmar.png" alt="confirmar" width="87" height="27" border="0" /></a> <a href="#"><img src="../imagens/bt_cancelar.png" alt="cancelar" width="79" height="27" border="0" /></a><a href="#"><img src="../imagens/bt_incluir.png" alt="incluir" width="69" height="27" border="0" /></a><a href="#"><img src="../imagens/bt_alterar.png" alt="alterar" width="69" height="27" border="0" /></a><a href="#"><img src="../imagens/bt_excluir.png" alt="excluir" width="69" height="27" border="0" /></a><a href="menu_prolog.pdf" target="_blank"><img src="../imagens/bt_ajuda.png" alt="ajuda" width="69" height="27" border="0" /></a></div>-->
            <div class="tit_sub_cat"></div>
            <div class="bloco">

                <form name="cadastro" />
                    <div style="margin: 10px; border: #b1b1b1 solid 2px;">                         
                        <div style="margin: 25px; float:left;">
                            <p>
                                
                                <br/>                              
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <center>                            
                            <h2 id="etapa">Etapa 1/4: Vinculação com Família</h2>                            
                        </center> <br/><br/>
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
                            </p>
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

                    <center>
                        <p>
                            <!--<input type="submit" class="button blue" value="Próximo >>"/>-->
                    </center>
                </form>                
            </div>                                                                                                                                                                                                                                                       
        </div>
    </div>
    <div class="footer">
        <div class="foot">
            <div class="copyright"></div>
        </div>
    </div>
</body>
</html>
