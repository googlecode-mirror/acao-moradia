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
                jQuery("#cpf").mask("999.999.999-99");                                
                jQuery("#cep").mask("99999-999");                
                jQuery("#telefone").mask("(99) 9999-9999?9");                
                jQuery("#dataNascimento").mask("99/99/9999");                
                jQuery("#numero").mask("9?99999");                
            });
        </script>                     
    </head>
    <body onload="verifica_etapa();">  
        <div class="wrap">
s            <div class="header">
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
                    
                    <form name="cadastro" action="../controle/cCadastraPessoa.php" method="get"/>
                    <div style="margin: 10px; border: #b1b1b1 solid 2px;">                         
                        <center>                            
                            <h2 id="etapa">Etapa 1/3: Cadastro de Titular</h2>                            
                        </center>                          
                        <div style="margin: 25px; float:left; ">
                            <h3>&nbsp;</h3>
                            <h3>Dados pessoais <?php if(isset($_GET["msg"])) echo $_GET["msg"] ?>: </h3>
                            <p>&nbsp;</p>
                            <p>Nome completo: (*)</p>
                            <p><input type="text" id="nome" name="nome" size="30" value="" maxlength="100" /></p>
                            <p><br />CPF:</p>
                            <p><input type="text" name="cpf" id="cpf" size="12" value="" maxlength="14" /></p>
                            <p>&nbsp;</p>
                            <p>RG:</p>
                            <p><input type="text" name="rg"value="" size="14" maxlength="45" /></p>
                            <p>&nbsp;</p>
                            Sexo: 
                            <select name="sexo">                                
                                <option>M</option>
                                <option>F</option>
                            </select>
                            <p>&nbsp;</p>

                            <p>Telefone:</p>                            
                            <p>
                                <input maxlength="15" name="telefone" id="telefone" size="15" />
                                <!--
                                <input type="checkbox" id="telefone2" onclick="novoTelefone()"/>
                                Adicionar outro telefone-->
                            </p>
                            <!--
                            <div style="margin: 10px 0px 0px 0px;  display: none;" id="novoTelefone" > <input maxlength="15" name="telefone2" size="15"/></div>
                            -->
                            <p>&nbsp;</p>
                            <p>Data de nascimento:</p>
                            <p><input maxlength="10" id="dataNascimento" name="dataNascimento" size="9" onblur="validaData(this,this.value)" /></p>

                            <p>&nbsp;</p>
                            <p>Naturalidade(*):</p>

                            <p>                                 
                                <table>
                                    <tr>
                                        <td>
                                            <select name="estadoNatal" id="estadoNatal">
                                                <?php                                            
                                                    include_once '../bd/EstadoDAO.php';
                                                    $estadoDAO = new EstadoDAO();
                                                    $estados = $estadoDAO->buscaEstados();                                                                                
                                                    while ( $row = mysql_fetch_assoc( $estados ) ) {
                                                        echo '<option value="'.$row['cod_estado'].'">'.$row['sigla'].'</option>';
                                                    }                                                                                           
                                                ?>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="cidadeNatal" id="cidadeNatal">
                                                <option value="0">Escolha um estado</option>
                                            </select>
                                        </td>
                                    </tr>
                                </table>
                            </p>                            
                            <p>&nbsp;</p>

                            <p>Estado Civil:</p>                            
                            <select name="estadoCivil">                                                                
                                <option>CASADO(A)</option>
                                <option>DIVORCIADO(A)</option>                                
                                <option>SEPARADO(A)</option>  
                                <option>SOLTEIRO(A)</option>
                                <option>VIÚVO(A)</option>
                            </select>
                            <p>&nbsp;</p>

                            <p>Raça:</p>
                            <select name="raca">                                
                                <option>NÃO DECLARADA</option>
                                <option>AMARELA</option>
                                <option>BRANCA</option>
                                <option>CABOCLO</option>
                                <option>CABRA</option>
                                <option>INDÌGENA</option>
                                <option>NEGRA</option>                                                                
                                <option>MULATA</option>                               
                                <option>PARDA</option>
                            </select>                                  
                            <p>&nbsp;</p>

                            <p>Religião:</p>
                            <input type="text" name="religiao" maxlength="45" size="20"/>
                            <p>&nbsp;</p>

                            <p>Carteira Profissional:</p>
                            <input type="radio" name="carteiraProfissional" value="sim" checked/>Sim
                            <input type="radio" name="carteiraProfissional" value="nao"/>Não
                            <p>&nbsp;</p>

                            <p>Certidão de Nascimento:</p>
                            <input type="radio" name="certidaoNascimento" value="sim" checked/>Sim
                            <input type="radio" name="certidaoNascimento" value="nao"/>Não
                            <p>&nbsp;</p>


                            <p>Título de Eleitor(somente números):</p>
                            <input type="text" name="tituloEleitor" size="12" maxlength="12"/>
                            <p>&nbsp;</p>

                            <p>Programas inseridos na instituição:</p>                            
                            <?php
                                //pegando do banco os programas
                                include_once '../controle/cListaProgramas.php';
                                $CPrograma = new CPrograma();
                                $programas = $CPrograma->buscaTodosProgramas();                                                                
                                
                                while($programa = mysql_fetch_array($programas)){
                                    echo "<input type='checkbox' value='$programa[id_programa]' name='programas[]'/>".$programa['nome']."<br>";
                                }                                                          
                               
                            ?>
                        </div>
                    </div>
                    <br/>                    
                    <div style="margin: 10px;">                    
                        <div style="margin: 20px;"> 
                            <p>&nbsp;</p>
                            <p>&nbsp;</p>
                            <p>&nbsp;</p>                            
                            <p>&nbsp;</p>
                            <p>CEP:(*)<br/>
                                <input type="text" id="cep" name="cep" value="" size="14" onBlur="getEndereco();" disabled/>
                            </p>
                            <p>&nbsp;</p>
                            <p>Logradouro:(*) <br/>
                                <input type="text" id="logradouro" name="logradouro" size="30" value="" disabled/>
                            </p>                            
                            <p>&nbsp;</p>
                            <p>Número:(*)<br/>
                                <input type="text" id="numero" name="numero" size="12" value="" disabled/>
                            </p>
                            <p>&nbsp;</p>
                            <p>Cidade/estado:(*)</p>   
                            <p>                           
                            <table>
                                <tr>                                    
                                    <td>
                                        <select id="estado" name="estado" disabled>
                                            <?php                                                                                                                                            
                                                $estados = $estadoDAO->buscaEstados();                                                                                
                                                while ( $row = mysql_fetch_assoc( $estados ) ) {
                                                    echo '<option value="'.$row['cod_estado'].'">'.$row['sigla'].'</option>';
                                                }                                                                                           
                                            ?>
                                        </select>
                                    </td>
                                    <td>                                        
                                        <select name="cidade" id="cidade">
                                            <option value="0">Escolha um estado</option>
                                        </select>                                        
                                    </td>                            
                                </tr>
                            </table>
                            
                            </p>
                            <p>&nbsp;</p>
                            <p>Bairro:(*) <br/>
                                <input type="text" id="bairro" name="bairro" value="" size="14" disabled/>                                                        
                            </p>                            
                            <p>&nbsp;</p>                                                                           
                            <!--
                            <p>
                                Estado:(*)<br/>
                                <input type="text" id="estado" name="estado" value="" size="14" disabled /><br/><br/>
                                <br/>
                            </p>-->                            
                            <div id="novoEndereco" style="display: none; ">
                                <br/><br/>
                                <div style="margin: 10px 0px 0px 0px; float: left;">Logradouro: <input type="text" name="logradouro2" size="30" value="" /></div>
                                <div style="margin: 10px 0px 0px 20px; float: left;">Número: <input type="text" size="12" name="numero2" value="" /></div>                
                                <div style="margin: 10px 0px 0px 20px; float: left;">Cidade: <input type="text" value="" name="cidade2" size="14" /></div>
                                <div style="margin: 10px 0px 0px 20px; float: left;">Bairro: <input type="text" value="" name="bairro2" size="14" /></div>
                                <div style="margin: 10px 0px 0px 20px; float: left;">Estado: <input type="text" value="" name="estado2" size="14" /></div><br/><br/><br/>
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
                    <input type="hidden" id="et" name="et" value="1"/>
                    <center>
                        <p>
                            <input type="submit" class="button blue" value="Próximo >>" onclick="return controla();"/>
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
