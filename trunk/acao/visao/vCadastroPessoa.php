<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php
        require("vLayoutHead.php");
        session_start();
        $_SESSION['botao'] = 'editar_familia';        
        ?>
        <link href="../css/button.css" rel="stylesheet" type="text/css" />

        <script type="text/javascript" src="../js/jquery-1.8.3.js"></script>    
        <script type="text/javascript" src="../js/jquery.maskedinput.js"></script>               
        <script type="text/javascript" src="../js/scripts.js" ></script>        
        <script>
            /*
            <!--
              javascript:window.history.forward(1);//não deixa voltar
            //-->*/
            <!--
                $("#estado").select(0);
            //-->
            jQuery(function(){
                jQuery("#cpf").mask("999.999.999-99");
                jQuery("#cep").mask("99999-999");
                jQuery("#telefone").mask("(99) 9999-9999?9");
                jQuery("#dataNascimento").mask("99/99/9999");
                jQuery("#numero").mask("9?99999");
            });
        </script>                     
    </head>
    <body onload="verifica_etapa();" >  
        <div class="wrap">
            <?php
            require("vLayoutBody.php");
            ?>

            <div class="content">
                <?php
                require("vLayoutMargin.php");
                ?>   
                
                <div class="bloco" style="border: #b1b1b1 solid 2px;">

                    <form name="cadastro" action="../controle/cCadastraPessoa.php" method="post"/>
                    <div style="margin: 10px; border: #b1b1b1 solid 2px;">                         
                        <center>
                            <?php
                                if(isset($_GET['et']) && $_GET['et'] == "2"){
                                    $et = "2";
                                    echo "<h2 id='etapa'>Etapa 2/3: Cadastro de Outros familiares</h2>";
                                    echo "<input type='hidden' id='et' name='et' value='2'/>";
                                    echo "<input type='hidden' name='idFamilia' value='".$_GET['family']."'/>";
                                }else{        
                                    $et = "1";
                                    echo "<h2 id='etapa'>Etapa 1/3: Cadastro de Titular</h2>";
                                    echo "<input type='hidden' id='et' name='et' value='1'/>";
                                }
                            ?>
                        </center>                          
                        <div style="margin: 25px; float:left; ">
                            <h3>&nbsp;</h3>
                            <h3>Dados pessoais <?php if (isset($_GET["msg"])) echo $_GET["msg"] ?>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </h3>
                            <p>&nbsp;</p>
                            <p>Nome completo: (*)</p>
                            <p><input type="text" id="nome" name="nome" size="30" value="a" maxlength="100" /></p>
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
                            </p>
                            <p>&nbsp;</p>
                            <p>Data de nascimento:</p>
                            <p><input maxlength="10" id="dataNascimento" name="dataNascimento" size="9" onblur="validaData(this,this.value)" /></p>

                            <p>&nbsp;</p>
                            <p>Naturalidade:</p>

                            <p>                                 
                                <table>
                                    <tr>
                                        <td>
                                            <select name="estadoNatal" id="estadoNatal">
                                                <?php
                                                include_once '../bd/EstadoDAO.php';
                                                $estadoDAO = new EstadoDAO();
                                                $estados = $estadoDAO->buscaEstados();                                                
                                                while ($row = mysql_fetch_assoc($estados)) {
                                                    echo '<option value="' . $row['cod_estado'] . '">' . $row['sigla'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="cidadeNatal" id="cidadeNatal">
                                                <option value="null">Escolha um estado</option>
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

                            while ($programa = mysql_fetch_array($programas)) {
                                echo "<input type='checkbox' value='$programa[id_programa]' name='programa[]'/>" . $programa['nome'] . "<br/>";
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
                            <?php
                            
                            if(isset($_GET["family"])){
                                echo "<p>Qual é o grau de parentesco desta pessoa em relação a(ao) ".strtoupper($_GET['titular']).":<br>"                              
                                .    "<select name='grauParentesco'>"
                                .        "<option>AGREGADO(A)</option>"                                            
                                .        "<option>AVÔ(Ó)</option>"
                                .        "<option>COMPANHEIRO(A)</option>"
                                .        "<option>CÔNJUGE(MARIDO OU ESPOSA)</option>"                        
                                .        "<option>CUNHADO(A)</option>"
                                .        "<option>ENTEADO(A)</option>"
                                .        "<option>EX-COMPANHEIRO(A)</option>"
                                .        "<option>EX-MARIDO/EX-ESPOSA</option>"
                                .        "<option>FILHO(A)</option>"
                                .        "<option>GENRO/NORA</option>"
                                .        "<option>IRMÃ(O)</option>"
                                .        "<option>NETO(A)</option>"
                                .        "<option>PADRASTO/MADRASTA</option>"
                                .        "<option>PAI/MÃE</option>"
                                .        "<option>PRIMO(A)</option>"
                                .        "<option>SOBRINHO(A)</option>"
                                .        "<option>SOGRO(A)</option>"
                                .        "<option>TIO(A)</option>"
                                .    "</select>";       
                                                                                                
                                include_once '../bd/FamiliaDAO.php';
                                include_once '../bd/CidadeDAO.php';
                                include_once '../bd/EstadoDAO.php';                                
                                
                                $fD= new FamiliaDAO();
                                $cD= new CidadeDAO;
                                $eD= new EstadoDAO();                                

                                $result= mysql_fetch_assoc($fD->buscaFamiliaById($_GET["family"]));
                                $resCidade= mysql_fetch_assoc($cD->buscaCidadebyCod($result['cod_cidade']));
                                $resEstado= mysql_fetch_assoc($eD->buscaEstadobyCod($resCidade['cod_estado']));
                                //$pD->buscaPessoabyFamilia($id_familia);
                                ?>
                                <p>&nbsp;</p>
                                <p>&nbsp;</p>
                                <p>ID da família<br/>
                                    <input type="text" name="id_familia" value="<?php echo $_GET["family"]?>" size="14" onBlur="getEndereco();" disabled/><br/>
                                </p><br/>
                                <p>CEP:(*)<br/>
                                    <input type="text" id="cep" name="cep" value="<?php echo $result['cep']; ?>" size="14" onBlur="getEndereco();" disabled/>
                                </p>
                                <p>&nbsp;</p>
                                <p>Logradouro:(*) <br/>
                                    <input type="text" id="logradouro" name="logradouro" size="30" value="<?php echo $result['logradouro']; ?>" disabled/>
                                </p>                            
                                <p>&nbsp;</p>
                                <p>Número:(*)<br/>
                                    <input type="text" id="numero" name="numero" size="12" value="<?php echo $result['numero']; ?>" disabled/>
                                </p>
                                <p>&nbsp;</p>
                                <p>Cidade/estado:(*)</p>   
                                 <input type="text" id="cidade" name="cidade" size="16" value="<?php echo $resCidade['nome']; ?>" disabled/>
                                 <input type="text" id="estado" name="estado" size="8" value="<?php echo $resEstado['sigla']; ?>" disabled/>
                                <p>&nbsp;</p>
                                <p>Bairro:(*) <br/>
                                    <input type="text" id="bairro" name="bairro" value="<?php echo $result['bairro']; ?>" size="14" disabled/>                                                        
                                </p>
                            
                            <?php    
                            }else
                            {
                                //printar os dados do endereco da familia                                
                            ?>
                            <p>CEP:(*)<br/>
                                <input required="required" type="text" id="cep" name="cep" value="38415-129" size="14" onBlur="getEndereco();" />
                            </p>
                            <p>&nbsp;</p>
                            <p>Logradouro:(*) <br/>
                                <input required="required" type="text" id="logradouro" name="logradouro" size="30" value="" />
                            </p>                            
                            <p>&nbsp;</p>
                            <p>Número:(*)<br/>
                                <input required="required" type="text" id="numero" name="numero" size="12" value="11" />
                            </p>
                            <p>&nbsp;</p>
                            <p>Cidade/estado:(*)</p>   
                            <p>                           
                                <table>
                                    <tr>                                    
                                        <td>
                                            <select id="estado" name="estado" >
                                                <?php
                                                $estados = $estadoDAO->buscaEstados();
                                                while ($row = mysql_fetch_assoc($estados)) {
                                                    echo '<option value="' . $row['cod_estado'] . '">' . $row['sigla'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td>                                        
                                            <select name="cidade" id="cidade">
                                                <option value="null">Escolha um estado</option>
                                            </select>                                        
                                        </td>                            
                                    </tr>
                                </table>
                            </p>
                            <p>&nbsp;</p>
                            <p>Bairro:(*) <br/>
                                <input type="text" id="bairro" name="bairro" value="" size="14" />                                                        
                            </p>                            
                            <?php
                                }
                            ?>
                            <p>&nbsp;</p>                                                                                                                                   
                        </div>                                            
                    </div>       
                    <?php if(isset($_GET["family"])) echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>"; ?>
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

    </body>
    <footer>
        <?php
        require("vLayoutFooter.php");
        ?>   
    </footer>
</html>
