<div style="margin-top:70px; margin-left:10px;">
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
                            echo '<li><a href="vEditOrDeleteFamilia.php" class="button red">Editar família</a><li>';
                        }
                        if ($_SESSION['botao'] === 'cadastrar_curso') {
                            echo '<li><a href="vCadastroCurso.php" class="button red">Cadastrar um curso</a><li>';
                        }
                        $_SESSION['botao'] = NULL;
                    }
                    ?>
                </ul>
            </center>
        </div>
        <p>&nbsp;</p>
        <p>&nbsp;</p>                       
    </div>
    <!--<div class="navegador"><a href="#"><img src="../imagens/bt_confirmar.png" alt="confirmar" width="87" height="27" border="0" /></a> <a href="#"><img src="../imagens/bt_cancelar.png" alt="cancelar" width="79" height="27" border="0" /></a><a href="#"><img src="../imagens/bt_incluir.png" alt="incluir" width="69" height="27" border="0" /></a><a href="#"><img src="../imagens/bt_alterar.png" alt="alterar" width="69" height="27" border="0" /></a><a href="#"><img src="../imagens/bt_excluir.png" alt="excluir" width="69" height="27" border="0" /></a><a href="menu_prolog.pdf" target="_blank"><img src="../imagens/bt_ajuda.png" alt="ajuda" width="69" height="27" border="0" /></a></div>-->
</div>
<div class="tit_sub_cat"></div>