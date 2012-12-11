<script type="text/javascript">
    /*
    $("._editar").click(function(){
            
        var id = $(this).attr('id');        
       
        var novaURL = "http://www.codigofonte.com.br/";
        //alert("editar= "+id);
        //$("#resultado").load('../controle/montaTabela.php',{query:query});
         
        //$(window.document.location).attr('href',"../visao/vCadastroPessoa.php");
            
    })    
    
     $("._addPessoa").click(function(){
        var id = $(this).attr('id'); 
        //alert("add pessoa= "+id);
         $.post("../visao/vCadastroPessoaComFamilia2.php", {id_familia: id});
         //$("#resultado").load('../controle/montaTabela.php',{query:query});
        //$(window.document.location).attr('href',"../visao/vCadastroPessoa.php");
            
    }) */
    
</script>
<?php
include_once '../bd/DBConnection.php';
include_once '../bd/FamiliaDAO.php';
include_once '../bd/PessoaDAO.php';
DataBase::createConection();
/*
  $id= $_REQUEST['id'];
  $titular= $_REQUEST['titular'];
  $endereco= $_REQUEST['endereco']; */
$html = '<form action="../controle/cControleFamilia.php" method="post">';
 $html .= "<table border= 1 width=500px>";
    $html .= "<th>id</th>";
    $html .= "<th>nome titular</th>";
    $html .= "<th>endereço</th>"; 
    $html .= "<th>add pessoa</th>";
    $html .= "<th>Editar</th>";
    $html .= "<th>excluir</th>";
$query = $_REQUEST['query'];
$fD = new FamiliaDAO;
$pD = new PessoaDAO;

if (!$query) {//busca vazia retorno irrelevante 
    $resultado = $fD->buscaFamilia();
   /* $html .= "<table border= 1 width=500px>";
    $html .= "<th>id</th>";
    $html .= "<th>nome titular</th>";
    $html .= "<th>endereço</th>"; 
    $html .= "<th>add pessoa</th>";
    $html .= "<th>Editar</th>";
    $html .= "<th>excluir</th>";
   */
    while ($a = mysql_fetch_assoc($resultado)) {
        $html .= '<tr>';
        $html .= '<td>' . $a['id_familia'] . '</td>';
        $html .= '<td>' . $pD->buscaPessoabyFamilia($a['id_familia']) . '</td>';
        $html .= '<td>' . $a['logradouro'] . ' - ' . $a['numero'] . '</td>';
        $html .= '<center>' . '<td>' . '<input src="../imagens/next.png" type="image" name= "id_familia" value="' . $a['id_familia'] .'a'. '">' . '</td>' . '</center>';
        $html .= '<center>' . '<td>' . '<input src="../imagens/bt_editar.png" type="image" name= "id_familia" value="' . $a['id_familia'] .'e'. '">' . '</td>' . '</center>';
        $html .= '<center>' . '<td>' . '<input src="../imagens/bt_deletar.png" type="image" name= "id_familia" value="' . $a['id_familia'] . 'd'.'">' . '</td>' . '</center>';


//$html .= '<td>'.'<input type="submit" name= "id_familia" value="'.$a['id_familia'].'" img src="../imagens/next.png">'.'</td>';
        //$html .= '<td>'.'<img src="../imagens/next.png" class="__idFamilia" id="'.$a['id_familia'].'">'.'</td>';
        $html .= '</tr>';
    }
} 
















elseif (is_numeric($query)) { //provavel q a pesquisa seja por ID ou numero da casa, seguido por resultados sem relevancia  
    $resultadoId = $fD->buscaFamiliaById($query);
    /*$html .= "<table border= 1 width=500px>";
    $html .= "<th>id</th>";
    $html .= "<th>nome titular</th>";
    $html .= "<th>endereço</th>";
    $html .= "<th>seleção</th>";*/
    //busca a familia cujo ID seja igual ao numero digitado
    while ($a = mysql_fetch_assoc($resultadoId)) {
        $html .= '<tr>';
        $html .= '<td>' . $a['id_familia'] . '</td>';
        $html .= '<td>' . $pD->buscaPessoabyFamilia($a['id_familia']) . '</td>';
        $html .= '<td>' . $a['logradouro'] . ' - ' . $a['numero'] . '</td>';
        $html .= '<center>' . '<td>' . '<input src="../imagens/next.png" type="image" name= "id_familia" value="' . $a['id_familia'] .'a'. '">' . '</td>' . '</center>';
        $html .= '<center>' . '<td>' . '<input src="../imagens/bt_editar.png" type="image" name= "id_familia" value="' . $a['id_familia'] .'e'. '">' . '</td>' . '</center>';
        $html .= '<center>' . '<td>' . '<input src="../imagens/bt_deletar.png" type="image" name= "id_familia" value="' . $a['id_familia'] . 'd'.'">' . '</td>' . '</center>';

        //$html .= '<center>' . '<td>' . '<input src="../imagens/next.png" type="image" name= "id_familia" value="' . $a['id_familia'] . '">' . '</td>' . '</center>';
        //$html .= '<td>' . '<input type="submit" name= "id_familia" value="' . $a['id_familia'] . '" img src="../imagens/next.png">' . '</td>';
        //$html .= '<td>'.'<img src="../imagens/next.png" class="__idFamilia" id="'.$a['id_familia'].'">'.'</td>';
        $html .= '</tr>';
    }

    //if(mysql_num_rows($resultadoId)){
    $resultadoNum = $fD->buscaFamiliaByNumero($query); //busca de numeros de casa
    while ($a = mysql_fetch_assoc($resultadoNum)) {
        $html .= '<tr>';
        $html .= '<td>' . $a['id_familia'] . '</td>';
        $html .= '<td>' . $pD->buscaPessoabyFamilia($a['id_familia']) . '</td>';
        $html .= '<td>' . $a['logradouro'] . ' - ' . $a['numero'] . '</td>';
        $html .= '<center>' . '<td>' . '<input src="../imagens/next.png" type="image" name= "id_familia" value="' . $a['id_familia'] .'a'. '">' . '</td>' . '</center>';
        $html .= '<center>' . '<td>' . '<input src="../imagens/bt_editar.png" type="image" name= "id_familia" value="' . $a['id_familia'] .'e'. '">' . '</td>' . '</center>';
        $html .= '<center>' . '<td>' . '<input src="../imagens/bt_deletar.png" type="image" name= "id_familia" value="' . $a['id_familia'] . 'd'.'">' . '</td>' . '</center>';

        //$html .= '<center>' . '<td>' . '<input src="../imagens/next.png" type="image" name= "id_familia" value="' . $a['id_familia'] . '">' . '</td>' . '</center>';
        //$html .= '<td>' . '<input type="submit" name= "id_familia" value="' . $a['id_familia'] . '" img src="../imagens/next.png">' . '</td>';
        //$html .= '<td>'.'<img src="../imagens/next.png" class="__idFamilia" id="'.$a['id_familia'].'">'.'</td>';
        $html .= '</tr>';
    }

    //concatena com resultados menos relevantes, pois pode ser que a primeira resposta naum seja importante
    $resultadoId2 = $fD->buscaFamiliaExceptId($query);
    while ($a = mysql_fetch_assoc($resultadoId2)) {
        $html .= '<tr>';
        $html .= '<td>' . $a['id_familia'] . '</td>';
        $html .= '<td>' . $pD->buscaPessoabyFamilia($a['id_familia']) . '</td>';
        $html .= '<td>' . $a['logradouro'] . ' - ' . $a['numero'] . '</td>';
        $html .= '<center>' . '<td>' . '<input src="../imagens/next.png" type="image" name= "id_familia" value="' . $a['id_familia'] .'a'. '">' . '</td>' . '</center>';
        $html .= '<center>' . '<td>' . '<input src="../imagens/bt_editar.png" type="image" name= "id_familia" value="' . $a['id_familia'] .'e'. '">' . '</td>' . '</center>';
        $html .= '<center>' . '<td>' . '<input src="../imagens/bt_deletar.png" type="image" name= "id_familia" value="' . $a['id_familia'] . 'd'.'">' . '</td>' . '</center>';

        //$html .= '<center>' . '<td>' . '<input src="../imagens/next.png" type="image" name= "id_familia" value="' . $a['id_familia'] . '">' . '</td>' . '</center>';
        //$html .= '<td>' . '<input type="submit" name= "id_familia" value="' . $a['id_familia'] . '" img src="../imagens/next.png">' . '</td>';
        //$html .= '<td>'.'<img src="../imagens/next.png" class="__idFamilia" id="'.$a['id_familia'].'">'.'</td>';
        $html .= '</tr>';
    }
    
} 







else {//a pesquisa é texto, pode ser um endereço ou titular
    //echo 'locura';
    $tamanhoPesquisa = strlen($query);
    $radical = substr($query, 1, $tamanhoPesquisa - 2);
    $resultado3 = $pD->buscaPessoaTitular($radical);
   
    while ($a = mysql_fetch_assoc($resultado3)) {
        $html .= '<tr>';
        $html .= '<td>' . $a['id_familia'] . '</td>';
        $html .= '<td>' . $a['nome'] . '</td>';
        $html .= '<td>' . $fD->buscaLogradouro($a['id_familia']) . ' - ' . $fD->buscaNumero($a['id_familia']) . '</td>';
        $html .= '<center>' . '<td>' . '<input src="../imagens/next.png" type="image" name= "id_familia" value="' . $a['id_familia'] .'a'. '">' . '</td>' . '</center>';
        $html .= '<center>' . '<td>' . '<input src="../imagens/bt_editar.png" type="image" name= "id_familia" value="' . $a['id_familia'] .'e'. '">' . '</td>' . '</center>';
        $html .= '<center>' . '<td>' . '<input src="../imagens/bt_deletar.png" type="image" name= "id_familia" value="' . $a['id_familia'] . 'd'.'">' . '</td>' . '</center>';

//$html .= '<center>' . '<td>' . '<input src="../imagens/next.png" type="image" name= "id_familia" value="' . $a['id_familia'] . '">' . '</td>' . '</center>';
        //$html .= '<td>' . '<input type="submit" name= "id_familia" value="' . $a['id_familia'] . '" img src="../imagens/next.png">' . '</td>';
        //$html .= '<td>'.'<img src="../imagens/next.png" class="__idFamilia" id="'.$a['id_familia'].'">'.'</td>';
        $html .= '</tr>';
    }

    $resultado4 = $fD->buscaFamiliabyLogradouro($query);
    while ($a = mysql_fetch_assoc($resultado4)) {
        /*$html .= '<tr>';
        $html .= '<td>' . $a['id_familia'] . '</td>';
        $html .= '<td>' . $pD->buscaPessoabyFamilia($a['id_familia']) . '</td>';
        $html .= '<td>' . $a['logradouro'] . ' - ' . $a['numero'] . '</td>';
        $html .= '<center>' . '<td>' . '<input src="../imagens/next.png" type="image" name= "id_familia" value="' . $a['id_familia'] .'a'. '">' . '</td>' . '</center>';
        $html .= '<center>' . '<td>' . '<input src="../imagens/bt_editar.png" type="image" name= "id_familia" value="' . $a['id_familia'] .'e'. '">' . '</td>' . '</center>';
        $html .= '<center>' . '<td>' . '<input src="../imagens/bt_deletar.png" type="image" name= "id_familia" value="' . $a['id_familia'] . 'd'.'">' . '</td>' . '</center>';
        $html .= '</tr>';*/
    }
    //mostrar resultados menos relevantes
    $resultado5 = $fD->buscaFamiliaExceptLogradouro($query);

    while ($a1 = mysql_fetch_assoc($resultado5)) {
        /*$html .= '<tr>';
        $html .= '<td>' . $a1['id_familia'] . '</td>';
        $html .= '<td>' . $pD->buscaPessoabyFamilia($a1['id_familia']) . '</td>';
        $html .= '<td>' . $a1['logradouro'] . ' - ' . $a1['numero'] . '</td>';
        $html .= '<center>' . '<td>' . '<input src="../imagens/next.png" type="image" name= "id_familia" value="' . $a['id_familia'] .'a'. '">' . '</td>' . '</center>';
        $html .= '<center>' . '<td>' . '<input src="../imagens/bt_editar.png" type="image" name= "id_familia" value="' . $a['id_familia'] .'e'. '">' . '</td>' . '</center>';
        $html .= '<center>' . '<td>' . '<input src="../imagens/bt_deletar.png" type="image" name= "id_familia" value="' . $a['id_familia'] . 'd'.'">' . '</td>' . '</center>';
*/
        //$html .= '<center>' . '<td>' . '<input src="../imagens/next.png" type="image" name= "id_familia" value="' . $a['id_familia'] . '">' . '</td>' . '</center>';
        
//$html .= '<td>' . '<input type="submit" name= "id_familia" value="' . $a1['id_familia'] . '" img src="../imagens/next.png">' . '</td>';
        //$html .= '<td>'.'<img src="../imagens/next.png" class="__idFamilia" id="'.$a['id_familia'].'">'.'</td>';
        $html .= '</tr>';
    }
}
$html .= "</table>";
$html .= "</form> ";
echo $html;

/*
  $res= Pesquisa::buscaGenerica("pesssoa", "nome", "Renato");

  //echo "<table border= 1>";
  //echo "<tr bgcolor= '#f0f0f0'>";
  for($_i= 0; $_i< mysql_num_fields($res); $_i++){
  echo mysql_field_name($res, $_i);//. "</td>";
  }
  //echo '</tr>';
 */
?>
