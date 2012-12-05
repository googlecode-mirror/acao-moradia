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
            //alert('foda');
        
            $("#resultado").load('../controle/cMontaTabelaPessoa.php',{query:query});
                
        })
        
       /* $(".__idFamilia").click(function(){
            
            alert('olá');
            
        })*/
      
    });
    
    
    
    
    
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
                <?php
        require("vLayoutBody.php");
        ?>
  
        <div class="content">
                    <?php
        require("vLayoutMargin.php");
        ?>
            
            <div class="bloco">
                <form name="cadastro" action="../controle/cCadastraPessoa.php" method="get">
                    <div style="margin: 10px; border: #b1b1b1 solid 2px;">                         
                        <div style="margin: 25px; float:left;">
                            <p>
                                
                                <br/>                              
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        
                            <h2 id="etapa">Pesquisa de Pessoa</h2>                            
                         <br/><br/>
                                Digite alguma informação sobre a pessoa
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
                    </div>
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
