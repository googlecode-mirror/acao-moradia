<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Ação Moradia</title>

    <link type="image/x-icon" href="copy.ico" rel="icon">
    <link type="image/x-icon" href="copy.ico" rel="shortcut icon">
    <link href="css/styles.css" rel="stylesheet" type="text/css" />

    <script type="text/javascript" src="http://code.jquery.com/jquery-1.8.0.min.js"></script>
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript" src="jquery-1.3.js"></script>
    <script type="text/javascript" src="js/scripts.js"></script>
</head>
<body>
    <div class="wrap">
        <div class="header">
            <div class="logo">
                <div class="lg"><h1>Ação Moradia</h1></div>
            </div>

            <div class="titulo">
                <div class="txt">
                    <ul><li><h2>Sistema de Cadastro e Relatório</h2> </li></ul>
                </div>
            </div>

            <div class="menu">
                <div class="mn">
                    <div class="menu_bts"> <a href="" target="_parent"><img src="imagens/menu_cadastros.png" width="94" height="73" /></a> <a href="" target="_parent"><img src="imagens/menu_relatorios.png" width="106" height="73" /></a><a href="" target="_parent"><img src="imagens/menu_sobre.png" width="81" height="73" /></a><a href="" target="_parent"><img src="imagens/menu_ajuda.png" width="76" height="73" /></a><a href="login.php"><img src="imagens/menu_logout.png" width="62" height="73" /></a></div>
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
                            <li><a href="vCadastroPessoa.php" target="_parent">Pessoas</a></li>
                        </ul>
                    </div>

                    <div class="bts">
                        <ul><li><a href="" target="_parent">Cursos</a></li></ul>
                    </div>

                    <div class="bts">
                        <ul><li><a href="" target="_parent">Programas</a></li></ul>
                    </div>

                </div>
            </div>

            <!--<div class="navegador"><a href="#"><img src="imagens/bt_confirmar.png" alt="confirmar" width="87" height="27" border="0" /></a> <a href="#"><img src="imagens/bt_cancelar.png" alt="cancelar" width="79" height="27" border="0" /></a><a href="#"><img src="imagens/bt_incluir.png" alt="incluir" width="69" height="27" border="0" /></a><a href="#"><img src="imagens/bt_alterar.png" alt="alterar" width="69" height="27" border="0" /></a><a href="#"><img src="imagens/bt_excluir.png" alt="excluir" width="69" height="27" border="0" /></a><a href="menu_prolog.pdf" target="_blank"><img src="imagens/bt_ajuda.png" alt="ajuda" width="69" height="27" border="0" /></a></div>-->
            <div class="tit_sub_cat">Cadastro de Clientes</div>
            <div class="bloco">
                <form name="cadastro" action="controleCadastroPessoa.php" method="get">
                    <div style="margin: 10px; border: #b1b1b1 solid 2px;">
                        <div style="margin: 5px;">Dados pessoais:</div>
                        <div style="margin: 25px;">
                            <div style="margin: 10px 0px 0px 0px; float: left;">Nome completo: <input type="text" name="nome" size="30" value="" /></div><br />
                            <div style="margin: 10px 0px 0px 20px; float: left; ">CPF: <input type="text" name="cpf" size="12" value="" /></div>
                            <div style="margin: 10px 0px 0px 20px; float: left;">RG: <input type="text" name="rg"value="" size="14" /></div>
                            <div style="margin: 10px 0px 0px 20px; float: left;">Sexo: 
                                <select name="sexo">
                                    <option> </option>
                                    <option>Masculino</option>
                                    <option>Feminino</option>
                                </select>
                            </div>
                            <div style="margin: 10px 0px 0px 20px; float: left;">Data Nascimento: <input maxlength="10" name="dataNascimento" size="9" onblur="validaData(this,this.value)" onKeyPress="Data(event,this)"/></div>
                            <!--<div style="margin: 10px 0px 0px 20px; float: left;">Data Cadastro: <input maxlength="10" id="data" name="dataCadastro" size="8" onblur="validaData(this,this.value)" onKeyPress="Data(event, this)"/></div>-->
                            <div style="margin: 10px 0px 0px 0px; float: left;">Telefone: <input maxlength="15" name="telefone" size="15" /></div>
                            <div style="margin: 10px 0px 0px 20px; float: left;">
                                  <input type="checkbox" id="telefone2" onclick="novoTelefone()"/>
                                  Telefone2
                            </div>
                            <div style="margin: 10px 0px 0px 2px; float: left; display: none;" id="novoTelefone" >: <input maxlength="15" name="telefone2" size="15"/></div>
                            <!--<div style="margin: 10px 0px 0px 10px; float: left;">Data Saída: <input maxlength="10" name="data_saida" size="8" onKeyPress="Data(event, this)"/></div>--><br><br>
                            <br>
                            <div style="margin: 20px 0px 0px -4px;"><input type="checkbox" id="parente" onclick="return checkBox()"/> parentes?</div>
                            <div id="formConjugue" style="display: none;">
                                <div style="margin: 10px 0px 10px 0px;">Nome Parente: <input type="text" size="30" value="" /></div>
                            </div>
                        </div>
                    </div>
                    <br><br><br>
                    <div style="margin: 10px; border: #b1b1b1 solid 2px;">
                        <div style="margin: 5px;">Dados endereço:</div>
                        <div style="margin: 25px;">
                            <div style="margin: 10px 0px 0px 0px; float: left;">Logradouro: <input type="text" name="logradouro" size="30" value="" /></div>
                            <div style="margin: 10px 0px 0px 20px; float: left;">Número: <input type="text" name="numero" size="12" value="" /></div>
                            <div style="margin: 10px 0px 0px 20px; float: left;">Cidade: <input type="text" name="cidade" value="" size="14" /></div>
                            <div style="margin: 10px 0px 0px 20px; float: left;">Bairro: <input type="text" name="bairro" value="" size="14" /></div>
                            <div style="margin: 10px 0px 0px 20px; float: left;">CEP: <input type="text" name="cep" value="" size="14" /></div>
                            <div style="margin: 10px 0px 0px 20px; float: left;">Estado: <input type="text" name="estado" value="" size="14" /></div><br><br><br>
                            <div style="margin: 0px 0px 0px -4px;"><input type="checkbox" id="novoFormEndereco" onclick="return novoEndereco()" /> Outro endereço:
                                <br>
                                    <div id="novoEndereco" style="display: none; ">
                                        <br><br>
                                        <div style="margin: 10px 0px 0px 0px; float: left;">Logradouro: <input type="text" name="logradouro2" size="30" value="" /></div>
                                        <div style="margin: 10px 0px 0px 20px; float: left;">Número: <input type="text" size="12" name="numero2" value="" /></div>
                                        <div style="margin: 10px 0px 0px 20px; float: left;">Cidade: <input type="text" value="" name="cidade2" size="14" /></div>
                                        <div style="margin: 10px 0px 0px 20px; float: left;">Bairro: <input type="text" value="" name="bairro2" size="14" /></div>
                                        <div style="margin: 10px 0px 0px 20px; float: left;">Estado: <input type="text" value="" name="estado2" size="14" /></div><br><br><br>
                                    </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <form action="?" method="get">
                            <div>Pesquisar parente: <input type="text" name="parente" value=""/> <input type="submit" value="Pesquisar"/></div>
                            Digite o país:
                            <br />
                            <input type="text" size="30" value="" id="inputString" onKeyUp="lookup(this.value);" onBlur="fill();" />

                            <div class="suggestionsBox" id="suggestions" style="display: none;">
                                <img src="upArrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
                                <div class="suggestionList" id="autoSuggestionsList"></div>
                            </div>
                        </form>

                        <?php
                            include_once 'dBConection.php';
                            DataBase::createConection();

                            if(isset($_POST['queryString'])) {
                                $queryString = $_POST['queryString'];
                                if(strlen($queryString) >0) {
                                    $query = mysql_query("SELECT nome FROM pessoa WHERE nome LIKE '$queryString%' LIMIT 10") or die("Erro na consulta");
                                    while ($result = mysql_fetch_array($query)) {
                                        echo '<li onClick="fill(\''.$result[0].'\');">'.$result[0].'</li>';
                                    }
                                }
                            }
                            //$conn = mysql_connect("acao_moradia","root","")  or die ("Erro ao se conectar ao servidor");
                            //$bd	  = mysql_select_db("banco") or die ("Erro ao se conectar ao banco");

                            /*if (isset($vet)) {
                                printr($vet);
                            }*/
                        ?>
                        <input type="submit" value="Cadastrar" />
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

