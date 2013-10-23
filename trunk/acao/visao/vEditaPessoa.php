<?php
/**
 * vEditaPessoa.php - altera dados de uma pessoa
 */
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
include_once '../controle/cFuncoes.php';
include_once '../bd/PessoaHasProgramaDAO.php';
include_once '../bd/ProgramaDAO.php';
include_once '../bd/TelefoneDAO.php';

$id_pessoa = $_GET['id_pessoa'];

$fD = new FamiliaDAO();
$cD = new CidadeDAO;
$eD = new EstadoDAO();
$pD = new PessoaDAO();

$pHpD = new PessoaHasProgramaDAO();
$telD = new TelefoneDAO();

$pessoa = mysql_fetch_assoc($pD->buscaPessoaById($id_pessoa));
$familia = mysql_fetch_assoc($fD->buscaFamiliaById($pessoa['id_familia']));
if ($pessoa['cidade_natal'] != "") {
    $cidadeNatal = mysql_fetch_assoc($cD->buscaCidadebyCod($pessoa['cidade_natal']));
}
$cidade = mysql_fetch_assoc($cD->buscaCidadebyCod($familia['cod_cidade']));
$estado = mysql_fetch_assoc($eD->buscaEstadobyCod($cidade['cod_estado']));
$telefone_residencial = mysql_fetch_assoc($telD->buscaTelefoneByIdFamilia($pessoa['id_familia']));
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
                    <form name="cadastro" action="../controle/cEditaPessoa.php" method="post"/>                    
                    <input type="hidden" id="idFamilia" name="idFamilia" value="<?php echo $pessoa['id_familia']; ?>"/>
                    <!--<div class="cabecalho">-->
                    <input type="hidden" id="idPessoa" name="idPessoa" value="<?php echo $id_pessoa; ?>"/>
                    <center>
                        <h2> Atualização de dados pessoais</h2>
                    </center>
                    <table style="margin-left: 1%;">
                        <td>
                            <div class="dados_pessoais">                            
                                <a href="javascript:window.history.go(-1)" class="button blue"><< Voltar</a>
                                <input type="submit" class="button blue" value="Salvar Alterações >>" onclick="return valida_dados_individualmente();"/>
                                <p>&nbsp;</p>
                                <h3>Dados pessoais</h3>
                                <p>&nbsp;</p>
                                <p>Nome completo: (*)</p>
                                <p><input type="text" id="nome" name="nome" size="30" value="<?php echo $pessoa['nome']; ?>" maxlength="100" /></p>
                                <p><br />CPF:</p>
                                <p><input type="text" name="cpf" id="cpf" size="12" value="<?php echo $pessoa['cpf']; ?>" maxlength="14" /></p>
                                <p>&nbsp;</p>
                                <p>RG:</p>
                                <p><input type="text" name="rg"value="<?php echo $pessoa['rg']; ?>" size="14" maxlength="45" /></p>
                                <p>&nbsp;</p>
                                <p>Sexo: </p>
                                <select name="sexo">
                                    <option <?php if ($pessoa['sexo'] === 'M') echo 'selected'; ?>>M</option>
                                    <option <?php if ($pessoa['sexo'] === 'F') echo 'selected'; ?> >F</option>
                                </select>
                                <p>&nbsp;</p>

                                <p>Telefone Celular:</p>
                                <p>
                                    <input maxlength="15" name="telefone" id="telefone" size="15" value="<?php echo $pessoa['telefone']; ?>"/>
                                </p>
                                <p>&nbsp;</p>
                                <p>Data de nascimento:</p>
                                <p><input maxlength="10" id="dataNascimento" name="dataNascimento" size="9" onblur="validaData(this,this.value)" value="<?php echo Funcoes::toUserDate($pessoa['data_nascimento']); ?>" /></p>

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
                                                    while ($estado_aux = mysql_fetch_assoc($estados)) {
                                                        if ($pessoa['cidade_natal'] != "" && $estado_aux['cod_estado'] == $cidadeNatal['cod_estado']) {
                                                            echo '<option selected value="' . $estado_aux['cod_estado'] . '">' . $estado['sigla'] . '</option>';
                                                        } else {
                                                            echo '<option value="' . $estado_aux['cod_estado'] . '">' . $estado_aux['sigla'] . '</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                            <td>
                                                <select name="cidadeNatal" id="cidadeNatal">
                                                    <option value="null"><?php if ($pessoa['cidade_natal'] != "") echo $cidadeNatal['nome']; else echo "Escolha um estado" ?></option>
                                                </select>
                                            </td>
                                        </tr>
                                    </table>
                                </p>                            
                                <p>&nbsp;</p>

                                <p>Estado Civil:</p>                            
                                <select name="estadoCivil">                                                                
                                    <option <?php if ($pessoa['estado_civil'] === 'CASADO(A)') echo 'selected'; ?>>CASADO(A)</option>
                                    <option <?php if ($pessoa['estado_civil'] === 'DIVORCIADO(A)') echo 'selected'; ?>>DIVORCIADO(A)</option>                                
                                    <option <?php if ($pessoa['estado_civil'] === 'SEPARADO(A)') echo 'selected'; ?>>SEPARADO(A)</option>  
                                    <option <?php if ($pessoa['estado_civil'] === 'SOLTEIRO(A)') echo 'selected'; ?>>SOLTEIRO(A)</option>
                                    <option <?php if ($pessoa['estado_civil'] === 'VIÚVO(A)') echo 'selected'; ?>>VIÚVO(A)</option>
                                </select>
                                <p>&nbsp;</p>

                                <p>Raça:</p>
                                <select name="raca">                                
                                    <option <?php if ($pessoa['raca'] === 'NÃO DECLARADA') echo 'selected'; ?>>NÃO DECLARADA</option>
                                    <option <?php if ($pessoa['raca'] === 'AMARELA') echo 'selected'; ?>>AMARELA</option>
                                    <option <?php if ($pessoa['raca'] === 'BRANCA') echo 'selected'; ?>>BRANCA</option>
                                    <option <?php if ($pessoa['raca'] === 'CABOCLO)') echo 'selected'; ?>>CABOCLO</option>
                                    <option <?php if ($pessoa['raca'] === 'CABRA') echo 'selected'; ?>>CABRA</option>
                                    <option <?php if ($pessoa['raca'] === 'INDÍGENA') echo 'selected'; ?>>INDÍGENA</option>
                                    <option <?php if ($pessoa['raca'] === 'NEGRA') echo 'selected'; ?>>NEGRA</option>                                                                
                                    <option <?php if ($pessoa['raca'] === 'MULATA') echo 'selected'; ?>>MULATA</option>                               
                                    <option <?php if ($pessoa['raca'] === 'PARDA') echo 'selected'; ?>>PARDA</option>
                                </select>                                  
                                <a href="http://pt.wikipedia.org/wiki/Ra%C3%A7a#Ra.C3.A7as_no_Brasil" target="_blank">Descubra as raças brasileiras</a>
                                <p>&nbsp;</p>

                                <p>Religião:</p>
                                <input type="text" name="religiao" maxlength="45" value="<?php echo $pessoa['religiao']; ?>" size="20"/>
                                <p>&nbsp;</p>

                                <p>Carteira Profissional:</p>
                                <input type="radio" name="carteiraProfissional" value="S" <?php if ($pessoa['carteira_profissional'] === 'S') echo 'checked'; ?>/>Sim
                                <input type="radio" name="carteiraProfissional" value="N" <?php if ($pessoa['carteira_profissional'] === 'N') echo 'checked'; ?>/>Não
                                <p>&nbsp;</p>

                                <p>Certidão de Nascimento:</p>
                                <input type="radio" name="certidaoNascimento" value="S"<?php if ($pessoa['certidao_nascimento'] === 'S') echo 'checked'; ?> />Sim
                                <input type="radio" name="certidaoNascimento" value="N" <?php if ($pessoa['certidao_nascimento'] === 'N') echo 'checked'; ?>/>Não
                                <p>&nbsp;</p>

                                <p>Título de Eleitor(somente números):</p>
                                <input type="text" name="tituloEleitor" value="<?php echo $pessoa['titulo_eleitor'] ?>" size="12" maxlength="12"/>
                                <p>&nbsp;</p>

                                <p>NIS:</p>
                                <input type="text" id="nis" name="nis" value="<?php echo $pessoa['nis'] ?>"  size="15" maxlength="15"/>
                                <p>&nbsp;</p>

                                <p>Programas inseridos na instituição:</p>                            
                                <?php
//pegando do banco os programas
                                include_once '../controle/cListaProgramas.php';
                                $CPrograma = new CPrograma();
                                $programas = $CPrograma->buscaTodosProgramas();

                                while ($programa = mysql_fetch_array($programas)) {
                                    $resProg = mysql_fetch_assoc($pHpD->IsPessoaInPrograma($pessoa['id_pessoa'], $programa['id_programa']));
                                    if (count($resProg) > 1) {
                                        echo "<input type='checkbox' checked value='$programa[id_programa]' name='programa[]'/>" . $programa['nome'] . "<br/>";
                                    } else {
                                        echo "<input type='checkbox' value='$programa[id_programa]' name='programa[]'/>" . $programa['nome'] . "<br/>";
                                    }
                                }
                                ?>
                                <br>
                            </div>
                        </td>
                        <br/>        
                        <td>
                            <div class="dados_familia">
                                <h3>&nbsp;</h3>
                                <p>&nbsp;</p>
                                <?php
                                $titulares = $fD->buscaTitularByIdFamilia($pessoa['id_familia']);
                                $titular = mysql_fetch_assoc($titulares);
                                if ($titular['id_pessoa'] == $pessoa['id_pessoa']) {
                                    echo "<h4>TITULAR</h4>";
                                    echo "<input type='hidden' name='grauParentesco' value='TITULAR' />";
                                } else {
                                    echo "<p>Grau de parentesco desta pessoa em relação a(ao) " . $titular['nome'] . ":<br>"
                                    . "<select name='grauParentesco'>";
                                    if ($pessoa['grau_parentesco'] == "AGREGADO(A)") {
                                        echo "<option selected>AGREGADO(A)</option>";
                                    } else {
                                        echo"<option>AGREGADO(A)</option>";
                                    }
                                    if ($pessoa['grau_parentesco'] == "AMASIADO(A)") {
                                        echo "<option selected>AMASIADO(A)</option>";
                                    } else {
                                        echo"<option>AMASIADO(A)</option>";
                                    }
                                    if ($pessoa['grau_parentesco'] == "AVÔ(Ó)") {
                                        echo "<option selected>AVÔ(Ó)</option>";
                                    } else {
                                        echo"<option>AVÔ(Ó)</option>";
                                    }
                                    if ($pessoa['grau_parentesco'] == "COMPANHEIRO(A)") {
                                        echo "<option selected>COMPANHEIRO(A)</option>";
                                    } else {
                                        echo"<option>COMPANHEIRO(A)</option>";
                                    }
                                    if ($pessoa['grau_parentesco'] == "CÔNJUGE(MARIDO OU ESPOSA)") {
                                        echo "<option selected>CÔNJUGE(MARIDO OU ESPOSA)</option>";
                                    } else {
                                        echo"<option>CÔNJUGE(MARIDO OU ESPOSA)</option>";
                                    }
                                    if ($pessoa['grau_parentesco'] == "CUNHADO(A)") {
                                        echo "<option selected>CUNHADO(A)(A)</option>";
                                    } else {
                                        echo"<option>CUNHADO(A)</option>";
                                    }
                                    if ($pessoa['grau_parentesco'] == "ENTEADO(A)") {
                                        echo "<option selected>ENTEADO(A)</option>";
                                    } else {
                                        echo"<option>ENTEADO(A)</option>";
                                    }
                                    if ($pessoa['grau_parentesco'] == "EX-COMPANHEIRO(A)") {
                                        echo "<option selected>EX-COMPANHEIRO(A)</option>";
                                    } else {
                                        echo"<option>EX-COMPANHEIRO(A)</option>";
                                    }
                                    if ($pessoa['grau_parentesco'] == "EX-MARIDO/EX-ESPOSA") {
                                        echo "<option selected>EX-MARIDO/EX-ESPOSA</option>";
                                    } else {
                                        echo"<option>EX-MARIDO/EX-ESPOSA</option>";
                                    }
                                    if ($pessoa['grau_parentesco'] == "FILHO(A)") {
                                        echo "<option selected>FILHO(A)</option>";
                                    } else {
                                        echo"<option>FILHO(A)</option>";
                                    }
                                    if ($pessoa['grau_parentesco'] == "GENRO/NORA") {
                                        echo "<option selected>GENRO/NORA</option>";
                                    } else {
                                        echo"<option>GENRO/NORA</option>";
                                    }
                                    if ($pessoa['grau_parentesco'] == "IRMÃ(O)") {
                                        echo "<option selected>IRMÃ(O)</option>";
                                    } else {
                                        echo"<option>IRMÃ(O)</option>";
                                    }
                                    if ($pessoa['grau_parentesco'] == "NETO(A)") {
                                        echo "<option selected>NETO(A)</option>";
                                    } else {
                                        echo"<option>NETO(A)</option>";
                                    }
                                    if ($pessoa['grau_parentesco'] == "PADRASTO/MADRASTA") {
                                        echo "<option selected>PADRASTO/MADRASTA</option>";
                                    } else {
                                        echo"<option>PADRASTO/MADRASTA</option>";
                                    }
                                    if ($pessoa['grau_parentesco'] == "NETO(A)") {
                                        echo "<option selected>NETO(A)</option>";
                                    } else {
                                        echo"<option>NETO(A)</option>";
                                    }
                                    if ($pessoa['grau_parentesco'] == "PAI/MÃE") {
                                        echo "<option selected>PAI/MÃE</option>";
                                    } else {
                                        echo"<option>PAI/MÃE</option>";
                                    }
                                    if ($pessoa['grau_parentesco'] == "PRIMO(A)") {
                                        echo "<option selected>PRIMO(A)</option>";
                                    } else {
                                        echo"<option>PRIMO(A)</option>";
                                    }
                                    if ($pessoa['grau_parentesco'] == "SOBRINHO(A)") {
                                        echo "<option selected>SOBRINHO(A)</option>";
                                    } else {
                                        echo"<option>SOBRINHO(A)</option>";
                                    }
                                    if ($pessoa['grau_parentesco'] == "SOGRO(A)") {
                                        echo "<option selected>SOGRO(A)</option>";
                                    } else {
                                        echo"<option>SOGRO(A)</option>";
                                    }
                                    if ($pessoa['grau_parentesco'] == "TIO(A)") {
                                        echo "<option selected>TIO(A)</option>";
                                    } else {
                                        echo"<option>TIO(A)</option>";
                                    }
                                    //if($pessoa['grau_parentesco'] == "TITULAR"){echo "<option selected>TITULAR</option>";}else{echo"<option>TITULAR</option>";}
                                    echo "</select></p><p>&nbsp;</p>";
                                }
                                ?>                        
                                <p>&nbsp;</p>                        
                                <p>Situação:</p>
                                Ativo:<input type="radio" title="Ativo" name="ativo" id="ativo" value="1" <?php if ($pessoa['ativo'] == "1") echo "checked"; ?>/>
                                Inativo:<input type="radio" title="Inativo" name="ativo" id="ativo" value="0" <?php if ($pessoa['ativo'] == "0") echo "checked"; ?>/>
                                <p>&nbsp;</p>
                                <p>ID da família</br>
                                    <input type="text" name="id_familia" value="<?php echo $pessoa['id_familia'] ?>" size="14" disabled/>
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
        <!--                        <input type="text" id="cidade" name="cidade" size="16" value="<?php //echo $cidade['nome'];   ?>" />
                                <input type="text" id="estado" name="estado" size="8" value="<?php //echo $estado['sigla'];   ?>" />-->
                                <p>                           
                                    <table>
                                        <tr>                                    
                                            <td>
                                                <select id="estado" name="estado" >
                                                    <?php
                                                    $est = $estadoDAO->buscaEstados();
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
                        </td>
                    </table>

<!--                    <center>-->
                    <p>
                        <a href="javascript:window.history.go(-1)" class="button blue"><< Voltar</a>
                        <input type="submit" class="button blue" value="Salvar Alterações >>" onclick="return valida_dados_individualmente();"/>
                    </p>
                    <!--</center>-->
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
