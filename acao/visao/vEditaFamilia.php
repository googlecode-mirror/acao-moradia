<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php
        require("vLayoutHead.php");
            include_once '../bd/DBConnection.php';
            include_once '../bd/PessoaDAO.php';
            include_once '../bd/FamiliaDAO.php';
            include_once '../bd/CidadeDAO.php';
            include_once '../bd/EstadoDAO.php';
            include_once '../bd/PessoaDAO.php';
            include_once '../modelo/Modelo.php';
            include_once '../controle/cFuncoes.php';
            include_once '../bd/PessoHasProgramaDAO.php';
            include_once '../bd/ProgramaDAO.php';
            
            session_start();
            $id_familia= $_SESSION['id_familia'];
            
            $fD= new FamiliaDAO();
            $cD= new CidadeDAO;
            $eD= new EstadoDAO();
            $pD= new PessoaDAO();
            $pHpD= new PessoaHasProgramaDAO();
            $progD= new ProgramaDAO();
            
            //$resltTitular= $pD->buscaPessoabyFamilia2($id_familia);
            $a  = mysql_fetch_assoc($pD->buscaPessoabyFamilia2($id_familia));
            echo $a['telefone'];
            $result= mysql_fetch_assoc($fD->buscaFamiliaById($id_familia));
            $resCidadeNatal= mysql_fetch_assoc($cD->buscaCidadebyCod($a['cidade_natal']));
            $resEstadoNaltal= mysql_fetch_assoc($eD->buscaEstadobyCod($resCidadeNatal['cod_estado']));
            //echo $resEstadoNaltal['sigla'];
            $resCidade= mysql_fetch_assoc($cD->buscaCidadebyCod($result['cod_cidade']));
            $resEstado= mysql_fetch_assoc($eD->buscaEstadobyCod($resCidade['cod_estado']));
            echo $a['religiao'];
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
                            <h2 id='etapa'>Editar dados de Família</h2>
                                   
                        </center>                          
                        <div style="margin: 25px; float:left; ">
                            <h3>&nbsp;</h3>
                            <h4>Dados do titular e residenciais</h4>
                            <p>&nbsp;</p>
                            <p>Nome do titular: (*)</p>
                            <p><input type="text" id="nome" name="nome" size="30" value=<?php echo $a['nome'] ?> maxlength="100" /></p>
                            <p><br />CPF:</p>
                            <p><input type="text" name="cpf" id="cpf" size="12" value=<?php echo $a['cpf']; ?> maxlength="14" /></p>
                            <p>&nbsp;</p>
                            <p>RG:</p>
                            <p><input type="text" name="rg"value=<?php echo $a['rg']; ?> size="14" maxlength="45" /></p>
                            <p>&nbsp;</p>
                            Sexo: 
                            <select name="sexo">                                
                                <option <?php if($a['sexo'] === 'M') echo 'selected'; ?>>M</option>
                                <option <?php if($a['sexo'] === 'F') echo 'selected'; ?> >F</option>
                            </select>
                            <p>&nbsp;</p>

                            <p>Telefone:</p>                            
                            <p>
                                <input maxlength="15" name="telefone" value=<?php echo $a['telefone']; ?> id="telefone" size="15" />
                            </p>
                            <p>&nbsp;</p>
                            <p>Data de nascimento:</p>
                            <p><input maxlength="10" id="dataNascimento" name="dataNascimento" value=<?php echo Funcoes::toUserDate($a['data_nascimento']); ?> size="9" onblur="validaData(this,this.value)" /></p>

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
                                                    $if='';
                                                    if($resCidadeNatal['cod_estado'] === $row['cod_estado']){
                                                        $if=  'selected';
                                                    }
                                                    echo '<option '.$if.'  value="' . $row['cod_estado'] . '" >' . $row['sigla'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="cidadeNatal" id="cidadeNatal">
                                                <option value="null"><?php echo $resCidadeNatal['nome']?></option>
                                            </select>
                                        </td>
                                    </tr>
                                </table>
                            </p>                            
                            <p>&nbsp;</p>

                            <p>Estado Civil:</p>                            
                            <select name="estadoCivil">                                                                
                                <option <?php if($a['estado_civil'] === 'CASADO(A)') echo 'selected'; ?>>CASADO(A)</option>
                                <option <?php if($a['estado_civil'] === 'DIVORCIADO(A)') echo 'selected'; ?>>DIVORCIADO(A)</option>                                
                                <option <?php if($a['estado_civil'] === 'SEPARADO(A)') echo 'selected'; ?>>SEPARADO(A)</option>  
                                <option <?php if($a['estado_civil'] === 'SOLTEIRO(A)') echo 'selected'; ?>>SOLTEIRO(A)</option>
                                <option <?php if($a['estado_civil'] === 'VIÚVO(A)') echo 'selected'; ?>>VIÚVO(A)</option>
                            </select>
                            <p>&nbsp;</p>

                            <p>Raça:</p>
                            <select name="raca">                                
                                <option <?php if($a['raca'] === 'NÃO DECLARADA') echo 'selected'; ?>>NÃO DECLARADA</option>
                                <option <?php if($a['raca'] === 'AMARELA') echo 'selected'; ?>>AMARELA</option>
                                <option <?php if($a['raca'] === 'BRANCA') echo 'selected'; ?>>BRANCA</option>
                                <option <?php if($a['raca'] === 'CABOCLO)') echo 'selected'; ?>>CABOCLO</option>
                                <option <?php if($a['raca'] === 'CABRA') echo 'selected'; ?>>CABRA</option>
                                <option <?php if($a['raca'] === 'INDÌGENA') echo 'selected'; ?>>INDÌGENA</option>
                                <option <?php if($a['raca'] === 'NEGRA') echo 'selected'; ?>>NEGRA</option>                                                                
                                <option <?php if($a['raca'] === 'MULATA') echo 'selected'; ?>>MULATA</option>                               
                                <option <?php if($a['raca'] === 'PARDA') echo 'selected'; ?>>PARDA</option>
                            </select>                                  
                            <p>&nbsp;</p>

                            <p>Religião:</p>
                            <input type="text" name="religiao" maxlength="45" value=<?php echo $a['religiao']; ?> size="20"/>
                            <p>&nbsp;</p>

                            <p>Carteira Profissional:</p>
                            <input type="radio" name="carteiraProfissional" value="sim" <?php if($a['carteira_profissional'] === 'S') echo 'checked'; ?>/>Sim
                            <input type="radio" name="carteiraProfissional" value="nao" <?php if($a['carteira_profissional'] === 'N') echo 'checked'; ?>/>Não
                            <p>&nbsp;</p>

                            <p>Certidão de Nascimento:</p>
                            <input type="radio" name="certidaoNascimento" value="sim"<?php if($a['certidao_nascimento'] === 'S') echo 'checked'; ?> />Sim
                            <input type="radio" name="certidaoNascimento" value="nao" <?php if($a['certidao_nascimento'] === 'N') echo 'checked'; ?>/>Não
                            <p>&nbsp;</p>


                            <p>Título de Eleitor(somente números):</p>
                            <input type="text" name="tituloEleitor" value=<?php echo $a['titulo_eleitor'] ?> size="12" maxlength="12"/>
                            <p>&nbsp;</p>

                            <p>Programas inseridos na instituição:</p>                            
                            <?php
                            //pegando do banco os programas
                            include_once '../controle/cListaProgramas.php';
                            $CPrograma = new CPrograma();
                            $programas = $CPrograma->buscaTodosProgramas();

                            while ($programa = mysql_fetch_array($programas)) {
                                 //session_start();
                                $if='';
                                    $_SESSION['if']='';
                                $resultProg= mysql_fetch_assoc($pHpD->IsPessoaInPrograma($a['id_pessoa'], $a['id_familia']));
                                $cod= $resultProg['id_programa'];
                                $resProg2= mysql_fetch_assoc($progD->buscaProgramaById($cod));
                                //echo $resProg2['nome'];
                                if($programa['nome'] === $resProg2['nome']){
                                    //session_start();
                                    $_SESSION['if']= $_SESSION['if'].'checked';
                                    $if= $_SESSION['if'];                                    
                                }
                                //echo $if;
                                $strs= "<input type='checkbox' ".$if." value='$programa[id_programa]' name='programa[]'/>" . $programa['nome'] . "<br/>";
                                echo $strs;
                                $_SESSION['if']='';
                                
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
                           
                                <p>&nbsp;</p>
                                <p>&nbsp;</p>
                                <p>ID da família<br/>
                                    <input type="text" name="id_familia" value="<?php echo $a['id_familia'];?>" size="14" onBlur="getEndereco();" /><br/>
                                </p><br/>
                                <p>CEP:(*)<br/>
                                    <input type="text" id="cep" name="cep" value="<?php echo $result['cep']; ?>" size="14" onBlur="getEndereco();" />
                                </p>
                                <p>&nbsp;</p>
                                <p>Logradouro:(*) <br/>
                                    <input type="text" id="logradouro" name="logradouro" size="30" value="<?php echo $result['logradouro']; ?>" />
                                </p>                            
                                <p>&nbsp;</p>
                                <p>Número:(*)<br/>
                                    <input type="text" id="numero" name="numero" size="12" value="<?php echo $result['numero']; ?>" />
                                </p>
                                <p>&nbsp;</p>
                                <p>Cidade/estado:(*)</p> 
                                <table><tr><td><select name="estado" id="estadoNatal">
                                                <?php
                                                include_once '../bd/EstadoDAO.php';
                                                $estadoDAO = new EstadoDAO();
                                                $estados = $estadoDAO->buscaEstados();                                               
                                                while ($row = mysql_fetch_assoc($estados)) {
                                                    $if='';
                                                    if($resCidadeNatal['cod_estado'] === $row['cod_estado']){
                                                        $if=  'selected';
                                                    }
                                                    echo '<option '.$if.'  value="' . $row['cod_estado'] . '" >' . $row['sigla'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="cidade" id="cidadeNatal">
                                                <option value="null"><?php echo $resCidadeNatal['nome']?></option>
                                            </select>
                                        </td>
                                    </tr>
                                </table>
                                 <input type="text" id="cidade" name="cidade" size="16" value="<?php echo $resCidade['nome']; ?>" />
                                 <input type="text" id="estado" name="estado" size="8" value="<?php echo $resEstado['sigla']; ?>" />
                                <p>&nbsp;</p>
                                <p>Bairro:(*) <br/>
                                    <input type="text" id="bairro" name="bairro" value="<?php echo $result['bairro']; ?>" size="14" />                                                        
                                </p>                                                                                                                         
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
