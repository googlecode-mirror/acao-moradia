<script type="text/javascript">
    /*
   $(".__idFamilia").click(function(){
            
       var id = $(this).attr('id');
       
       alert(id);
            
   })*/
    
</script>    
<?php

include_once '../bd/DBConnection.php';
include_once '../bd/FamiliaDAO.php';
include_once '../bd/PessoaDAO.php';
DataBase::createConection();
/*
$id= $_REQUEST['id'];
$titular= $_REQUEST['titular'];
$endereco= $_REQUEST['endereco'];*/

$query= $_REQUEST['query'];
$fD= new FamiliaDAO;
    $pD= new PessoaDAO;

if(!$query){   
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
}

elseif (is_numeric($query)) { //provavel q a pesquisa seja por ID   
    $resultadoId= $fD->buscaFamiliaById($query);
    $html  = "<table border= 1 width=500px>";    
    $html .= "<th>id</th>";
    $html .= "<th>nome titular</th>";
    $html .= "<th>endereço</th>";
    $html .= "<th>seleção</th>";
    //busca a familia cujo ID seja igual ao numero digitado
     while ($a= mysql_fetch_assoc($resultadoId)){        
        $html .= '<tr>';
        $html .= '<td>'.$a['id_familia'].'</td>';
        $html .= '<td>'.$pD->buscaPessoabyFamilia($a['id_familia']).'</td>';
        $html .= '<td>'.$a['logradouro'].' - '.$a['numero'].'</td>';
        $html .= '<td>'.'<img src="../imagens/next.png" class="__idFamilia" id="'.$a['id_familia'].'">'.'</td>';
        $html .= '</tr>';      
    }
    //concatena com resultados menos relevantes, pois pode ser que a primeira resposta naum seja importante
    $resultadoId2= $fD->buscaFamiliaExceptId($query);
    while ($a= mysql_fetch_assoc($resultadoId2)){        
        $html .= '<tr>';
        $html .= '<td>'.$a['id_familia'].'</td>';
        $html .= '<td>'.$pD->buscaPessoabyFamilia($a['id_familia']).'</td>';
        $html .= '<td>'.$a['logradouro'].' - '.$a['numero'].'</td>';
        $html .= '<td>'.'<img src="../imagens/next.png" class="__idFamilia" id="'.$a['id_familia'].'">'.'</td>';
        $html .= '</tr>';      
    }    
}

 else {//a pesquisa é texto, pode ser um endereço ou titular
   $resultado3= $pD->buscaPessoabyFamilia($id);
}
 $html  .= "</table>";
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
