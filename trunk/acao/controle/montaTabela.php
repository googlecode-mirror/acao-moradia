<script type="text/javascript">
    
   $(".__idFamilia").click(function(){
            
       var id = $(this).attr('id');
       
       alert(id);
            
   })
    
</script>    
<?php

include_once '../bd/DBConnection.php';
include_once '../bd/FamiliaDAO.php';
include_once '../bd/PessoaDAO.php';
DataBase::createConection();

$id= $_REQUEST['id'];
$titular= $_REQUEST['titular'];
$endereco= $_REQUEST['endereco'];

if((!$id)&&(!$titular)&&(!$endereco)){
 
    $fD= new FamiliaDAO;
    $pD= new PessoaDAO;
    
    
    $resultado= $fD->buscaFamilia();
    $html  = "<table border= 1 width=500px>";    
    $html .= "<th>id</th>";
    $html .= "<th>nome titular</th>";
    $html .= "<th>endereço</th>";
    $html .= "<th>seleção</th>";
    
    while ($a= mysql_fetch_assoc($resultado)){
        
        $html .= '<tr>';
        $html .= '<td>'.$a['id_familia'].'</td>';
        $html .= '<td>'.$pD->buscaPessoabyFamilia($a['id_familia']).'</td>';
        $html .= '<td>'.$a['logradouro'].' - '.$a['numero'].'</td>';
        $html .= '<td>'.'<img src="../imagens/next.png" class="__idFamilia" id="'.$a['id_familia'].'">'.'</td>';
        $html .= '</tr>';
        
    }
    
      $html  .= "</table>";
      echo $html;
}
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
