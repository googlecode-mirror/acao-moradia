<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php
        session_start();
        if(!isset($_SESSION['nivel'])){
        header('Location: ../visao/vLogin.php');            
        }
        require("vLayoutHead.php");
        require("../bd/PessoaDAO.php");
        require("../bd/FamiliaDAO.php");
        ?>
        <link href="../css/button.css" rel="stylesheet" type="text/css" />
        <link href="../mate-2.2/css/table_styles.css" rel="stylesheet" type="text/css" />
        <link href="../mate-2.2/css/icon_styles.css" rel="stylesheet" type="text/css" />
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
                    <h4>Dados da Família:</h4>
                    <table cellpadding="1" width="90%" class="mateTable">
                        <tbody>
                        <tr class="header" style="background: #009900;">
                            <td>
                                ID
                            </td>
                            <td>
                                CEP
                            </td>
                            <td>
                                Logradouro
                            </td>
                            <td>
                                Nº
                            </td>
                            <td>
                                Bairro
                            </td>
                            <td>
                                Cidade/Estado
                            </td>
                            <td>
                                Telefone
                            </td>    
                            <td>
                                Ações
                            </td>    
                        </tr>
                        <?php 
                            $id_familia = $_GET['id_familia'];
                            $familiaDAO = new FamiliaDAO();
                            $familias = $familiaDAO->buscaTodosDadosFamilia($id_familia);
                            $telefones = $familiaDAO->buscaTelefone($id_familia);
                            $titular = mysql_fetch_assoc($familiaDAO->buscaTitularByIdFamilia($id_familia));
                            while($familia = mysql_fetch_assoc($familias)){
                                echo '<tr>';
                                echo "<td> $id_familia </td>";
                                echo "<td> $familia[cep] </td>";
                                echo "<td> $familia[logradouro] </td>";
                                echo "<td> $familia[numero]</td>";
                                echo "<td> $familia[bairro]</td>";
                                echo "<td> $familia[cidade]-$familia[estado]</td>";
                                
                                echo "<td>";
                                while($telefone= mysql_fetch_assoc($telefones)){
                                    echo $telefone['telefone']." ";
                                }
                                echo "</td>";          
                                echo "<td>";                                
                                echo '<ul class="actions" style="width: 78px;">
                                      <li class="edit"> 
                                      <a title="Editar Família" href="vEditaFamilia.php?id_familia='.$id_familia.'"></a>
                                      </li>
                                      <li class="addperson"> 
                                      <a title="Adicionar Pessoa a Família" href="vCadastroPessoa.php?et=2&family='.$id_familia.'&titular='.$titular['nome'].'"></a>
                                      </li>
                                      </ul>';
                                echo "</td>";                                          
                                echo '</tr>';
                            }                            
                        ?>
                    </table>
                    <br />                    
                    <h4>Dados dos integrantes da família:</h4>
                    <table cellpadding="1" width="90%" class="mateTable">
                        <tbody>
                        <tr class="header">
                            <td>
                                Nome
                            </td>
                            <td>
                                Tipo
                            </td>
                            <td>
                                Ativo
                            </td>
                            <td>
                                Ações
                            </td>
                        </tr>
                        <?php                             
                            $pessoaDAO = new PessoaDAO();
                            $pessoas = $pessoaDAO->buscaPessoaByAttribute("id_familia", $id_familia);

                            while($row = mysql_fetch_assoc($pessoas)){
                                echo '<tr>';
                                echo "<td> $row[nome] </td>";
                                echo "<td> $row[grau_parentesco] </td>";
                                echo "<td>";
                                if ($row['ativo']=='1')echo 'S'; else echo 'N';
                                echo "</td>";
                                echo "<td nowrap='nowrap'>";
                                echo "<ul class='actions' style='width: 78px;'>";
                                echo "<li class='edit'> <a href='vEditaPessoa.php?id_pessoa=$row[id_pessoa]' title='Editar'></a></li>";
                                echo "<li class='viewFull'> <a href='vPreCadastroNew.php?id_pessoa=$row[id_pessoa]' title='Visualização completa'></a></li>";
                                echo "</ul>";
                                echo '</tr>';
                            }                            
                        ?>
                    </table>
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