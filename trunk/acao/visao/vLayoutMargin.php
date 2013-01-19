<div style="margin-top:45px; margin-left:10px;">
    <div class="menu_cadastros">
        <div class="tit">
            <!--<div class="bts">
               <ul><li><a href="" target="_parent"></a></li></ul>
           </div>-->
            <center>
            <!-- <ul><li><input class="button black bigrounded" type="button" value=" /\  Início " onClick="location.href='vAtendente.php'"/></li></ul> -->
                <ul>
                    <li><input class="button black bigrounded" type="button" value="<< Voltar"   onclick="history.go(-1);return true;"/></li>
                    <?php
                    if (isset($_SESSION['botao'])) {
                        if ($_SESSION['botao'] === 'editar_familia') {
                            echo '<li></br><a href="vCadastroPessoa.php" class="button red">Cadastrar uma família</a><li>';
                        }
                        if ($_SESSION['botao'] === 'cadastrar_curso') {
                            echo '<li><a href="vCadastroCursoNew.php" class="button red">Cadastrar um curso</a><li>';
                        }
                        if ($_SESSION['botao'] === 'excluir_familia') {
                            echo '<li><a href="vExcluirFamilia.php?id_familia='.$_GET['family'].'" class="button red">Excluir Familia</a><li>';
                        }
                        if ($_SESSION['botao'] === 'exibir_funcionarios') {
                            echo '<li><a href="vExibirFuncionarios.php" class="button red">Exibir Funcionarios</a><li>';
                        }
                        $_SESSION['botao'] = NULL;
                    }
                    ?>
                </ul>
            </center>
        </div>                              
    </div>
    <!--<div class="navegador"><a href="#"><img src="../imagens/bt_confirmar.png" alt="confirmar" width="87" height="27" border="0" /></a> <a href="#"><img src="../imagens/bt_cancelar.png" alt="cancelar" width="79" height="27" border="0" /></a><a href="#"><img src="../imagens/bt_incluir.png" alt="incluir" width="69" height="27" border="0" /></a><a href="#"><img src="../imagens/bt_alterar.png" alt="alterar" width="69" height="27" border="0" /></a><a href="#"><img src="../imagens/bt_excluir.png" alt="excluir" width="69" height="27" border="0" /></a><a href="menu_prolog.pdf" target="_blank"><img src="../imagens/bt_ajuda.png" alt="ajuda" width="69" height="27" border="0" /></a></div>-->
</div>