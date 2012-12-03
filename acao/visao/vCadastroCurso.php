<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Ação Moradia</title>
        <link type="image/x-icon" href="copy.ico" rel="icon"/>
        <link type="image/x-icon" href="copy.ico" rel="shortcut icon"/>
        <link href="../css/styles.css" rel="stylesheet" type="text/css" />
        <link href="../css/button.css" rel="stylesheet" type="text/css" />
        
        <script type="text/javascript" src="../js/jquery-1.8.3.js"></script>    
        <script type="text/javascript" src="../js/jquery.maskedinput.js"></script>               
        <script type="text/javascript" src="../js/scripts.js" ></script>        
        <script>
            jQuery(function(){
                jQuery("#vagas").mask("9?99999");
                
            });
        </script>
        <script>            
function mascara(o,f){
    v_obj=o
    v_fun=f
    setTimeout("execmascara()",1)
}

function execmascara(){
    v_obj.value=v_fun(v_obj.value)
}

function mvalor(v){  
    v=v.replace(/\D/g,"");//Remove tudo o que não é dígito  
    v=v.replace(/(\d)(\d{8})$/,"$1.$2");//coloca o ponto dos milhões  
    v=v.replace(/(\d)(\d{5})$/,"$1.$2");//coloca o ponto dos milhares  
  
    v=v.replace(/(\d)(\d{2})$/,"$1,$2");//coloca a virgula antes dos 2 últimos dígitos  
    return v;  
}
function soNumeros(v){
    return v.replace(/\D/g,"")
}
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
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                        <p>
                            <center>
                                <p><br /><br /><br />
                                    <a href="vPesquisaPessoa.php" class="button blue">Pesquisar pessoa</a>
                                </p>
                                <p><br />
                                    <input type="submit" class="button blue" value="Vincular à família"/>
                                </p>
                                <p>&nbsp;</p>
                            </center>
                        </p>                                 
                    </div>
                </div>                
                <!--<div class="navegador"><a href="#"><img src="../imagens/bt_confirmar.png" alt="confirmar" width="87" height="27" border="0" /></a> <a href="#"><img src="../imagens/bt_cancelar.png" alt="cancelar" width="79" height="27" border="0" /></a><a href="#"><img src="../imagens/bt_incluir.png" alt="incluir" width="69" height="27" border="0" /></a><a href="#"><img src="../imagens/bt_alterar.png" alt="alterar" width="69" height="27" border="0" /></a><a href="#"><img src="../imagens/bt_excluir.png" alt="excluir" width="69" height="27" border="0" /></a><a href="menu_prolog.pdf" target="_blank"><img src="../imagens/bt_ajuda.png" alt="ajuda" width="69" height="27" border="0" /></a></div>-->
                <div class="tit_sub_cat"></div>
                <div class="bloco" style="border: #b1b1b1 solid 2px;">
                    
                    <form name="cadastro" action="../controle/cCadastroCurso.php" method="get"/>
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
                            <!-- <p><input type="text" id="pre_requisitos" name="pre_requisitos" size="30" value=""/></p> -->
                            <p><textarea rows="4" cols="30" form="cadastro" style="resize: none;" id="preRequisitos" name="preRequisitos"></textarea></p>
                            <p>&nbsp;</p>
                            <p>Dias da semana:</p>
                            <!--<p><input type="text" id="diasSemana" name="diasSemana" size="30" value="" maxlength="100"/></p>-->
                            <input type='checkbox' value='domingo' name='diasSemana'/>Domingo<br>
                            <input type='checkbox' value='segunda' name='diasSemana'/>Segunda-feira<br>
                            <input type='checkbox' value='terça' name='diasSemana'/>Terça-feira<br>
                            <input type='checkbox' value='quarta' name='diasSemana'/>Quarta-feira<br>
                            <input type='checkbox' value='quinta' name='diasSemana'/>Quinta-feira<br>
                            <input type='checkbox' value='sexta' name='diasSemana'/>Sexta-feira<br>
                            <input type='checkbox' value='sabado' name='diasSemana'/>Sábado<br>
                        </div>
                    </div>
                    <br/>                    
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
                    <input type="hidden" id="et" name="et" value="1"/>
                    <center>
                        <p>
                            <input type="submit" class="button blue" value="Cadastrar" onclick="return controla();"/>
                        </p>
                    </center>
                    </form>                
                </div>                                                                                                                                                                                                                                             
                <div class="txt">Os campos com * são obrigatórios</div>   
            </div>
        </div>
        <div class="footer">
            <div class="foot">
                <div class="copyright"></div>
            </div>
        </div>
    </body>
</html>
