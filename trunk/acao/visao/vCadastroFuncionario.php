<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Ação Moradia</title>
        <link type="image/x-icon" href="copy.ico" rel="icon"/>
        <link type="image/x-icon" href="copy.ico" rel="shortcut icon"/>
        <link href="../css/styles.css" rel="stylesheet" type="text/css" />
        <link href="../css/button.css" rel="stylesheet" type="text/css" />

        <script type="text/javascript" src="http://code.jquery.com/jquery-1.8.0.min.js"></script>
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
                            <ul><li><a href="vCadastroPessoa.php" target="_parent">Pessoas</a></li></ul>
                        </div>

                        <div class="bts">
                            <ul><li><a href="" target="_parent">Cursos</a></li></ul>
                        </div>
                        <div class="bts">
                            <ul><li><a href="" target="_parent">Programas</a></li></ul>
                        </div>
                        <p>&nbsp;</p>
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
                <div class="bloco">

                    <form name="cadastro" action="../controle/cCadastraFuncionario.php" method="post"/>
                       
                    <div style="margin: 10px; border: #b1b1b1 solid 2px;">                         
                        <center>
                            <h2>Cadastro de Funcionário</h2>
                        </center>                          
                        <div style="margin: 25px; float:left; ">
                            <h3>&nbsp;</h3>
                            <h3>Dados do Atendente: </h3>
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
        <div class="footer">
            <div class="foot">
                <div class="copyright"></div>
                
            </div>
              
        </div>
    </body>
</html>
