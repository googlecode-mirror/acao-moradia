  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml">
      <head>
          <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
          <title>Ação Moradia</title>
          <link type="image/x-icon" href="copy.ico" rel="icon"/>
              <link type="image/x-icon" href="copy.ico" rel="shortcut icon"/>
  
                  <link href="css/styles.css" rel="stylesheet" type="text/css" />
                <link href="css/button.css" rel="stylesheet" type="text/css" />
  
                  <script type="text/javascript" src="http://code.jquery.com/jquery-1.8.0.min.js"></script>
                  <script type="text/javascript" src="jquery.js"></script>
                  <script language="JavaScript">
                      /*-----------------------------------------------------------------------
                        Máscara para o campo data dd/mm/aaaa hh:mm:ss
                        Exemplo: <input maxlength="16" name="datahora" onKeyPress="DataHora(event, this)">
                      -----------------------------------------------------------------------*/
              
                      function validaData(campo,valor) {
                          var date=valor;
                          var ardt=new Array;
                          var ExpReg=new RegExp("(0[1-9]|[12][0-9]|3[01])/(0[1-9]|1[012])/[12][0-9]{3}");
                          ardt=date.split("/");
                          erro=false;
                          if ( date.search(ExpReg)==-1){
                              erro = true;
                          }
                          else if (((ardt[1]==4)||(ardt[1]==6)||(ardt[1]==9)||(ardt[1]==11))&&(ardt[0]>30))
                              erro = true;
                          else if ( ardt[1]==2) {
                              if ((ardt[0]>28)&&((ardt[2]%4)!=0))
                                  erro = true;
                              if ((ardt[0]>29)&&((ardt[2]%4)==0))
                                  erro = true;
                          }
                          if (erro) {
                              alert("\"" + valor + "\" não é uma data válida!!!");
                              campo.value = "";
                              return false;
                          }
                          return true;
                      }
  
              
                      function Data(evento, objeto){
                          var keypress=(window.event)?event.keyCode:evento.which;
                          campo = eval (objeto);
                          if (campo.value == '00/00/0000')
                          {
                              campo.value=""
                          }
  
                          caracteres = '0123456789';
                          separacao1 = '/';
                          conjunto1 = 2;
                          conjunto2 = 5;
                          if ((caracteres.search(String.fromCharCode (keypress))!=-1) && campo.value.length < (10))
                          {
                              if (campo.value.length == conjunto1 )
                                  campo.value = campo.value + separacao1;
                              else if (campo.value.length == conjunto2)
                                  campo.value = campo.value + separacao1;		
                          }
                          else
                              event.returnValue = false;
                  
                      }
              
                      function checkBox(){
                          if($('#conjugue').is(':checked')){
                              $('#formConjugue').show();
                          } else{
                              $('#formConjugue').hide();
                          }
                      }
              
                      function novoEndereco(){
                          if($('#novoFormEndereco').is(':checked')){
                              $('#novoEndereco').show();                    
                          } else{
                              $('#novoEndereco').hide();
                          }
                      }
              
                      function novoTelefone(){
                          if($('#telefone2').is(':checked')){
                              $('#novoTelefone').show();
                      
                          } else{
                              $('#novoTelefone').hide();
                          }
                      }
              
                      function numeros(){
                          tecla = event.keyCode;
                          if (tecla >= 48 && tecla <= 57)
                          {
                              event.returnValue = true;
                              alert('tecla: '+tecla);
                          }
                          else
                          {
                              event.returnValue = false;
                          }
                      }
                  </script>
  
                  </head>
  
                 <body>
      <?php/*
      include_once 'sessao.php';
      ob_start();
      session_start();
                         
                          if(isset($_SESSION['nivel'])!= true){
                              header("Location: login.php");
                           }*/
                       ?>
                      <div class="wrap">
  
                          <div class="header">
  
                              <div class="logo">
                                  <a href="atendente.php"><div class="lg"><h1>Ação Moradia</h1></div></a>
                              </div>
                              <div class="titulo">
                                  <div class="txt">
                                      <ul><li><h2>Sistema de Cadastro e Relatório</h2> </li></ul>
                                  </div>
                              </div>
  
                              <div class="menu">
                                  <div class="mn">
                                      <div class="menu_bts"> <a href="" target="_parent"><img src="imagens/menu_cadastros.png" width="94" height="73" /></a> <a href="" target="_parent"><img src="imagens/menu_relatorios.png" width="106" height="73" /></a><a href="" target="_parent"><img src="imagens/menu_sobre.png" width="81" height="73" /></a><a href="" target="_parent"><img src="imagens/menu_ajuda.png" width="76" height="73" /></a><a href="cLogout.php"><img src="imagens/menu_logout.png" width="62" height="73" /></a></div>
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
                                          <ul>
                                              <li><a href="vCadastroPessoa.php" target="_parent">Pessoas</a></li></ul>
                                      </div>
  
                                      <div class="bts">
                                          <ul><li><a href="" target="_parent">Cursos</a></li></ul>
                                      </div>
  
                                      <div class="bts">
                                          <ul><li><a href="" target="_parent">Programas</a></li></ul>
                                      </div>
                                   
                                  </div>
  
  
  
                              </div>
 
                              <div class="tit_sub_cat"></div>
                            <div class="bloco">
                              <form name="cadastro" action="controleCadastroPessoa.php" method="get">
                              
  
                                <div style="margin: 10px; border: #b1b1b1 solid 2px;"> 
                                        <div style="margin: 25px;"> 
                                          <p>Buscar...
                                            <input name="chave" type="text" id="chave" value="" size="30" maxlength="30" />
                                            , que é um(a)...
                                            <select name="filtro" id="filtro">
                                              <option value="nome">nome</option>
                                              <option value="familia">família</option>
                                              <option value="endereco">endereço</option>
                                            </select>
                                          </p>
                                        </div>
                                </div>
                             </form>                                                                                                                                     <center>
                                      <p><input type="submit" class="button blue" value="Pesquisar pessoa"></p>
                                      <p>&nbsp;</p>
                                    </center>
                            </div>
                                                                                                                          </form>
                                                                                                                          <div class="txt">Os campos com * são obrigatórios</div>   
  
                        </div>
  
                                                                                                                          </div>
  
  
  
                                                                                                                          <div class="footer">
                                                                                                                              <div class="foot">
  
  
  
                                                                                                                                  <div class="copyright"></div>
                                                                                                                              </div>
                                                                                                                          </div>
                                                                                                                          </div>
                                                                                                                          </body>
                                                                                                                          </html>
