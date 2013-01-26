<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php
                require("vLayoutHead.php");
//                session_start();
//                $_SESSION['botao'] = 'cadastrar_curso';
        ?>

        <?php
        include_once '../bd/DBConnection.php';
        DataBase::createConection();
        ?>

        <link href="../css/button.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="../css/jquery-ui-1.9.2.css" />
        <script src="../js/jquery-1.8.3.js"></script>
        <script src="../js/jquery-ui-1.9.2.js"></script>
        <style>
            #project-label {
                display: block;
                font-weight: bold;
                margin-bottom: 1em;
            }
            #project-icon {
                float: left;
                height: 32px;
                width: 32px;
            }
            #project-description {
                margin: 0;
                padding: 0;
            }
        </style>
        <script>
            $(function() {
                var pessoas = <?php
        $result = mysql_query("SELECT p.nome,p.id_pessoa, f.logradouro, f.numero FROM pessoa p, familia f where p.id_familia = f.id_familia");
        $count = mysql_num_rows($result);
        echo '[';
        if ($count > 0) {
            for ($i = 0; $i < $count - 1; $i++) {
                echo '{';
                $row = mysql_fetch_row($result);
                //echo '"', $row[1], ' ', $row[0], '"', ',';
                //echo '"',$row[0], '"', ',';
                //$idPessoa = $row[1];
                //$nome = $row[0];
                //$logradouro = $row[2];
                //$numero = $row[3];

                echo 'value: "', $row[1], '",';
                echo 'label: "', $row[0], '",';
                echo 'desc: "Endereço: ', $row[2], ', ', $row[3], '"},';
            }
            $row = mysql_fetch_row($result);
            //echo '"', $row[1], ' ',$row[0], '"';
            //echo '"',$row[0], '"';
            echo '{';
            echo 'value: "', $row[1], '",';
            echo 'label: "', $row[0], '",';
            echo 'desc: "Endereço: ', $row[2], ', ', $row[3], '"}';
            echo ']';
        }
        ?>;
                //$( "#nome" ).autocomplete({
                //    source: pessoas
                //});
                
                $( "#pessoa" ).autocomplete({
                    minLength: 2,
                    source: pessoas,
                    focus: function( event, ui ) {
                        $( "#pessoa" ).val( ui.item.label );
                        return false;
                    },
                    select: function( event, ui ) {
                        $( "#pessoa" ).val( ui.item.label );
                        $( "#idPessoa" ).val( ui.item.value );
                        $( "#descricao" ).html( ui.item.desc );

                        return false;
                    }
                })
                .data( "autocomplete" )._renderItem = function( ul, item ) {
                    return $( "<li>" )
                    .data( "item.autocomplete", item )
                    .append( "<a>" + item.label + "<br>" + item.desc + "</a>" )
                    .appendTo( ul );
                };
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

                    <form action="../controle/cIncluirPessoaCurso.php" method="post"/>
                    <div style="margin: 10px; border: #b1b1b1 solid 2px;">                         
                        <center>                            
                            <h2>Inclusão de pessoa em curso</h2>
                        </center>                          
                        <div style="margin: 25px; float:left; ">
                            <p>Entre com o nome da pessoa a ser inclusa no curso:</p>
                            <input id="pessoa" name="pessoa" size="50" required="required" autofocus="autofocus"/><a href="vCadastroPessoa.php" class="button red">Não encontrou a pessoa? Cadastre ela</a>                                
                            <input type="hidden" id="idPessoa" name="idPessoa"/>
                            <p id="descricao"></p>


                            <p>&nbsp;</p>
                            <p>Selecione o curso:</p>
                            <?php
                            //error_reporting(E_ALL & ~ E_NOTICE);

                            $curso_block = "";
                            $cursos = mysql_query("SELECT `id_curso`,`nome`,`vagas` FROM `curso`") or die(mysql_error());

                            while ($curso = mysql_fetch_array($cursos)) {
                                $res = mysql_fetch_assoc(mysql_query("select count(*) as ocupadas from curso_has_pessoa where id_curso=".$curso['id_curso']));
                                $vagas = $curso['vagas']-$res['ocupadas'];
    
                                if($vagas > 0){
                                    $idCurso = $curso['id_curso'];
                                    $nomeCurso = $curso['nome'];
                                    $curso_block .= '<OPTION value="' . $idCurso . '">' . $nomeCurso . '</OPTION>';
                                }else{
                                    $curso_block .= '<OPTION> NÃO HÁ VAGAS DISPONÍVEIS PARA NENHUM CURSO</OPTION>';
                                }
                            }
                            ?>
                            <select id="idCurso" name="idCurso"><?php echo $curso_block; ?></select>

                            <input type="hidden" id="et" name="et" value="1"/>
                            <p>&nbsp;</p>
                            <p>
                                <input type="submit" class="button blue" value="Incluir"/>                                
                            </p>                            
                            <p>&nbsp;</p>                            
                            <a href="vCadastroCursoNew.php" class="button red">Exibir cursos</a>
                            
                        </div>                        
                    </div>                    
                    <br/>
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