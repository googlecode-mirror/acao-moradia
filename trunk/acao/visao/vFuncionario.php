<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php
        require("vLayoutHead.php");
        include_once '../bd/LoginDAO.php';
        ?>
        <link href="../css/button.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="../js/jquery-1.8.3.js"></script>
        
        <script type="text/javascript" > 
            function removeFuncionario(){
                return confirm("Você realmente deseja remover o usuario?");             
            }
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

                    
                    <div style="margin: 10px; border: #b1b1b1 solid 2px;">                         
                        <center>
                            <h2>Dados dos Funcionários</h2>                            
                        </center>



                        <div style="margin: 25px; float:left;">
                            <br/><br/>
                            Digite o nome do funcionário
                            <br/><br/>

                            <input id="query" type="text" name="funcionario" value="" size="40"/>

                            <input type="button" class="carregar_tabela" value="Pesquisar"/>


                            <br/><br/>
                            <br/>    
                            <?php
                            include_once '../bd/DBConnection.php';
                            DataBase::createConection();

                            $res = mysql_query('select * from login'); /* Executa o comando SQL, no caso para pegar todos os usuarios do sistema e retorna o valor da consulta em uma variavel ($res)  */

                            echo '<table border="1">
                          <center>
                            <tr>
                                <td>                                 
                                    <h3>Usuário</h3>                                    
                                </td>
                                <td>
                                    <h3>Nível</h3>
                                </td>
                                <td>
                                    <h3>Editar</h3>
                                </td>
                                <td>
                                    <h3>Remover</h3>
                                </td>
                            </tr>
                            </center>';

                            /* Enquanto houver dados na tabela para serem mostrados será executado tudo que esta dentro do while */
                            while ($escrever = mysql_fetch_array($res)) {
                                ?>
                                <tr>
                                    <td> 
                                        <?php echo $escrever['usuario']?>
                                    </td>
                                    <td> 
                                        <?php echo $escrever['nivel']?>
                                    </td>
                                    <td>
                                        <center>
                                            <img src="../imagens/bt_editar.png"/>
                                        </center>
                                    </td>
                                    <td>
                                        <center>
                                            <img src="../imagens/bt_deletar.png" onclick="return removeFuncionario();  "/>
                                        </center>
                                    </td>
                                </tr> 
                            <?php
                            }
                            ?>
                            </table>
                           




                            <br/>
                            <br/>


                            <div id="resultado">


                            </div>


                        </div>

                    </div>    
                    <?php
                    if (isset($vet)) {
                        printr($vet);
                    }
                    ?>



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
