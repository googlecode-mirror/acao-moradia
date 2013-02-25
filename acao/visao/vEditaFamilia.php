<?php
if (!isset($_SESSION)) {
    session_start();
    if (!isset($_SESSION['nivel'])) {
        header("Location: vLogin.php");
    }
}

include_once '../bd/PessoaDAO.php';
include_once '../bd/FamiliaDAO.php';
include_once '../bd/CidadeDAO.php';
include_once '../bd/EstadoDAO.php';
include_once '../modelo/Modelo.php';
include_once '../bd/TelefoneDAO.php';

$id_familia = $_GET['id_familia'];

$fD = new FamiliaDAO();
$cD = new CidadeDAO();
$eD = new EstadoDAO();
$pD = new PessoaDAO();
$telD = new TelefoneDAO();

$familia = mysql_fetch_assoc($fD->buscaFamiliaById($id_familia));
$cidade = mysql_fetch_assoc($cD->buscaCidadebyCod($familia['cod_cidade']));
$estado = mysql_fetch_assoc($eD->buscaEstadobyCod($cidade['cod_estado']));
$telefone_residencial = mysql_fetch_assoc($telD->buscaTelefoneByIdFamilia($id_familia));
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php
        require("vLayoutHead.php");
        ?>
        <script type="text/javascript" src="../js/jquery-1.8.3.js"></script>    
        <script type="text/javascript" src="../js/jquery.maskedinput.js"></script>
        <script type="text/javascript" src="../js/scripts.js" ></script>               
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
                <div class="txt">Os campos com * são obrigatórios</div>
                <div class="bloco">
                    <form name="cadastro" action="../controle/cEditaFamilia.php" method="post" onSubmit="return valida_titular();"/>
                    <input type="hidden" id="idFamilia" name="idFamilia" value="<?php echo $id_familia; ?>"/>
                    <div class="cabecalho">                        
                        <center>
                            <h2> Atualização de dados pessoais</h2>
                        </center>
                    </div>

                    <div class="dados_familia">                            
                        <a href="javascript:window.history.go(-1)" class="button blue"><< Voltar</a>
                        <input type="submit" class="button blue" value="Salvar Alterações >>" onclick="return valida_etapa_1();"/>
                        <p>&nbsp;</p>
<!--                                <p>Situação:</p>
                            Ativo:<input type="radio" title="Ativo" name="ativo" id="ativo" value="1" <?php /* if($pessoa['ativo']=="1")echo "checked"; */ ?>/>
                            Inativo:<input type="radio" title="Inativo" name="ativo" id="ativo" value="0" <?php /* if($pessoa['ativo']=="0")echo "checked"; */ ?>/>
                            <p>&nbsp;</p>-->
                        <p>Membros da família (Nome e Grau de parentesco com o Titular) <br /><br />
                            <?php
                            
                            /*
                            $pessoas = $pD->buscaPessoabyIdFamilia($id_familia);
                            echo "<select id='titular' name='titular' onchange='altera_titular()'>";
                            while ($pessoa = mysql_fetch_array($pessoas)) {
                                if ($pessoa['grau_parentesco'] == "TITULAR") {
                                    echo "<option selected value='" . $pessoa['id_pessoa'] . "'>" . $pessoa['nome'] . "</option>";                                   
                                } else {
                                    echo"<option value='" . $pessoa['id_pessoa'] . "'>" . $pessoa['nome'] . "</option>";
                                }                                
                            }*/
                            
                            $pessoas = $pD->buscaPessoabyIdFamilia($id_familia);                            
                            while ($pessoa = mysql_fetch_array($pessoas)) {                                
                                echo $pessoa['nome'].":&nbsp;&nbsp;";
                                echo "<select name='grauParentesco[$pessoa[id_pessoa]]'>";
                                    if($pessoa['grau_parentesco'] == "AGREGADO"){echo "<option selected>AGREGADO(A)</option>";}else{echo"<option>AGREGADO(A)</option>";}
                                    if($pessoa['grau_parentesco'] == "AVÔ(Ó)"){echo "<option selected>AVÔ(Ó)</option>";}else{echo"<option>AVÔ(Ó)</option>";}
                                    if($pessoa['grau_parentesco'] == "COMPANHEIRO(A)"){echo "<option selected>COMPANHEIRO(A)</option>";}else{echo"<option>COMPANHEIRO(A)</option>";}
                                    if($pessoa['grau_parentesco'] == "CÔNJUGE(MARIDO OU ESPOSA)"){echo "<option selected>CÔNJUGE(MARIDO OU ESPOSA)</option>";}else{echo"<option>CÔNJUGE(MARIDO OU ESPOSA)</option>";}
                                    if($pessoa['grau_parentesco'] == "CUNHADO(A)"){echo "<option selected>CUNHADO(A)(A)</option>";}else{echo"<option>CUNHADO(A)</option>";}
                                    if($pessoa['grau_parentesco'] == "ENTEADO(A)"){echo "<option selected>ENTEADO(A)</option>";}else{echo"<option>ENTEADO(A)</option>";}
                                    if($pessoa['grau_parentesco'] == "EX-COMPANHEIRO(A)"){echo "<option selected>EX-COMPANHEIRO(A)</option>";}else{echo"<option>EX-COMPANHEIRO(A)</option>";}
                                    if($pessoa['grau_parentesco'] == "EX-MARIDO/EX-ESPOSA"){echo "<option selected>EX-MARIDO/EX-ESPOSA</option>";}else{echo"<option>EX-MARIDO/EX-ESPOSA</option>";}
                                    if($pessoa['grau_parentesco'] == "FILHO(A)"){echo "<option selected>FILHO(A)</option>";}else{echo"<option>FILHO(A)</option>";}
                                    if($pessoa['grau_parentesco'] == "GENRO/NORA"){echo "<option selected>GENRO/NORA</option>";}else{echo"<option>GENRO/NORA</option>";}
                                    if($pessoa['grau_parentesco'] == "IRMÃ(O)"){echo "<option selected>IRMÃ(O)</option>";}else{echo"<option>IRMÃ(O)</option>";}
                                    if($pessoa['grau_parentesco'] == "NETO(A)"){echo "<option selected>NETO(A)</option>";}else{echo"<option>NETO(A)</option>";}
                                    if($pessoa['grau_parentesco'] == "PADRASTO/MADRASTA"){echo "<option selected>PADRASTO/MADRASTA</option>";}else{echo"<option>PADRASTO/MADRASTA</option>";}
                                    if($pessoa['grau_parentesco'] == "NETO(A)"){echo "<option selected>NETO(A)</option>";}else{echo"<option>NETO(A)</option>";}
                                    if($pessoa['grau_parentesco'] == "PAI/MÃE"){echo "<option selected>PAI/MÃE</option>";}else{echo"<option>PAI/MÃE</option>";}
                                    if($pessoa['grau_parentesco'] == "PRIMO(A)"){echo "<option selected>PRIMO(A)</option>";}else{echo"<option>PRIMO(A)</option>";}
                                    if($pessoa['grau_parentesco'] == "SOBRINHO(A)"){echo "<option selected>SOBRINHO(A)</option>";}else{echo"<option>SOBRINHO(A)</option>";}
                                    if($pessoa['grau_parentesco'] == "SOGRO(A)"){echo "<option selected>SOGRO(A)</option>";}else{echo"<option>SOGRO(A)</option>";}
                                    if($pessoa['grau_parentesco'] == "TIO(A)"){echo "<option selected>TIO(A)</option>";}else{echo"<option>TIO(A)</option>";}
                                    if($pessoa['grau_parentesco'] == "TITULAR"){echo "<option selected>TITULAR</option>";}else{echo"<option>TITULAR</option>";}
                                    echo "</select><br />";
                            }
                            
                            $titular = mysql_fetch_assoc($fD->buscaTitularByIdFamilia($id_familia));
                            echo "<input type='hidden' id='titularAntigo' name='titularAntigo' value='$titular[id_pessoa]' />";
                            echo "<div id='pessoas'></div>";
                            echo "</select></p>";
                            ?>                                
                            <p>&nbsp;</p>                        
                            <p>ID da família</br>
                                <input type="text" name="id_familia" value="<?php echo $id_familia; ?>" size="14" disabled/>
                            </p>
                            <br/>                       
                            <p>CEP:(*)<br/>
                                <input type="text" id="cep" name="cep" value="<?php echo $familia['cep'] ?>" size="14" onBlur="getEndereco();"/>
                                <a href="http://www.buscacep.correios.com.br" target="_blank"/>Buscar CEP</a>
                            </p>
                        </p>
                        <p>&nbsp;</p>
                        <p>Logradouro:(*) <br/>
                            <input type="text" id="logradouro" name="logradouro" size="30" value="<?php echo $familia['logradouro']; ?>" />
                        </p>                            
                        <p>&nbsp;</p>
                        <p>Número:(*)<br/>
                            <input type="text" id="numero" name="numero" size="12" value="<?php echo $familia['numero']; ?>" />
                        </p>
                        <p>&nbsp;</p>
                        <p>Cidade/estado:(*)</p>   
<!--                        <input type="text" id="cidade" name="cidade" size="16" value="<?php //echo $cidade['nome'];     ?>" />
                        <input type="text" id="estado" name="estado" size="8" value="<?php //echo $estado['sigla'];     ?>" />-->
                        <p>                           
                            <table>
                                <tr>                                    
                                    <td>
                                        <select id="estado" name="estado" >
                                            <?php
                                            $est = $eD->buscaEstados();
                                            while ($row = mysql_fetch_assoc($est)) {
                                                $selected = '';
                                                if ($row['cod_estado'] == $estado['cod_estado']) {
                                                    $selected = "selected";
                                                }
                                                echo '<option ' . $selected . ' value="' . $row['cod_estado'] . '">' . $row['sigla'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="cidade" id="cidade">
                                            <!--                                                <option value="null">Escolha um estado</option>-->
                                            <?php
                                            $cidades = $cD->buscaCidadesByEstado($estado['cod_estado']);
                                            while ($row = mysql_fetch_assoc($cidades)) {
                                                $selected = '';
                                                if ($row['cod_cidade'] == $cidade['cod_cidade']) {
                                                    $selected = "selected";
                                                }
                                                echo '<option ' . $selected . ' value="' . $row['cod_cidade'] . '">' . $row['nome'] . '</option>';
                                            }
                                            ?>                                                                                        
                                        </select>                                        
                                    </td>                            
                                </tr>
                            </table>
                        </p>
                        <p>&nbsp;</p>
                        <p>Bairro:(*) <br/>
                            <input type="text" id="bairro" name="bairro" value="<?php echo $familia['bairro']; ?>" size="14" />
                        </p>                                
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                        <p>Telefone Residencial:</p>                            
                        <p>
                            <input maxlength="15" name="telefone_residencial" id="telefone_residencial" size="15" value="<?php echo $telefone_residencial['telefone']; ?>"/>
                        </p>                                                            
                        <p>&nbsp;</p>                                                                                                                                   
                    </div>

                    <div style="margin-left: 30px;">
                        <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
                        <hr/>
                        <h3>Pesquisa socioeconômica(Pessoal)</h3>
                    </div>
                    <br /><br /><br />
                    <center>
                        <p>
                            <a href="javascript:window.history.go(-1)" class="button blue"><< Voltar</a>
                            <input type="submit" class="button blue" value="Salvar Alterações >>" onclick="return valida_edita_familia();"/>
                        </p>
                    </center>
                    </form>                                   
                </div>
            </div>

    </body>
    <footer>
        <?php
        require("vLayoutFooter.php");
        ?>   
    </footer>
</html>
