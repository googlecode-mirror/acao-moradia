<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Ação Moradia</title>
<link type="image/x-icon" href="copy.ico" rel="icon"/>
<link type="image/x-icon" href="copy.ico" rel="shortcut icon"/>
<link href="css/styles.css" rel="stylesheet" type="text/css" />

</head>

<body>
    <?php
    session_start();
     if(!isset($_SESSION['nivel'])){
        header("Location: login.php");
     }
    ?>
<div class="wrap">

  <div class="header">

    <div class="logo">
    	<div class="lg"><h1></h1></div>
    </div>
    <div class="titulo">
    	<div class="txt">
        	<ul><li><h2>Sistema de Cadastro e Relatório</h2> </li></ul>
        </div>
    </div>
    
    <div class="menu">
      <div class="mn">
      	<div class="menu_bts"> <a href="" target="_parent"><img src="imagens/menu_cadastros.png" width="94" height="73" /></a> <a href="" target="_parent"><img src="imagens/menu_relatorios.png" width="106" height="73" /></a><a href="" target="_parent"><img src="imagens/menu_sobre.png" width="81" height="73" /></a><a href="" target="_parent"><img src="imagens/menu_ajuda.png" width="76" height="73" /></a><a href="cLogout.php" target="_parent"><img src="imagens/menu_logout.png" width="62" height="73" /></a></div>
   </div>
    </div>
  </div>
  
  <div class="content">
  	<div style="margin-top:70px; margin-left:250px;">
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
   

    	<div class="menu_relatorios" style="margin-left:30px;">
            	<div class="tit">Relatórios</div>
                <div class="bts">
                	<ul><li><a href="" target="_parent">Funcionários</a></li></ul>
                </div>
                
               <div class="bts">
                	<ul>
                	  <li><a href="" target="_parent">Pessoas</a></li></ul>
                </div>
                
             <div class="bts">
                	<ul><li><a href="" target="_parent">Cursos</a></li></ul>
                </div>
                
             <div class="bts">
                	<ul><li><a href="" target="_parent">Programas</a></li></ul>
                </div>
               
                
                
            </div>
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
