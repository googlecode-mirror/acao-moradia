<div style="margin-left:10px;"> <!--margin-top:45px;-->
    <div class="menu_cadastros">
        <div class="tit">            
            <center>            
                <ul>                    
                    <?php
                    if (isset($_SESSION['botao'])) {
                        if ($_SESSION['botao'] === 'cadastrar_familia') {
                            echo '<li><a href="vCadastroPessoa.php" class="button red">Cadastrar uma família</a><li>';
                        }                                               
                        $_SESSION['botao'] = NULL;                        
                    }
                    ?>
                </ul>
            </center>
        </div>                              
    </div>    
</div>