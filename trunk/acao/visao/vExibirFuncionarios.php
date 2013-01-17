<script>
function zebra(id, classe) {
var tabela = document.getElementById(id);
var linhas = tabela.getElementsByTagName("tr");
	for (var i = 0; i < linhas.length; i++) { 
	((i%2) == 0) ? linhas[i].className = classe : void(0);
	}
}
</script>
</head>
<style>
* { font-family:Arial, Helvetica, sans-serif; font-size:11px; }
h1 { font-size:24px; color:#e63c1e; }
th, td { padding:6px; border-bottom:1px solid #ddd; text-align:left; }
th { background:#0033ff; font-weight:bold; color:#fff; }
tr.zb td { background:#eee; }
</style>

    <?php    
    include_once '../bd/LoginDAO.php';
    $log = new LoginDAO();    
    $funcionarios = $log->busca();
    echo '
    <table cellpadding="0" cellspacing="0" id="minhatabela">
    <tr>
        <th>Usuário</th>
        <th>Nível</th>
    </tr>';
    
    while ($row = mysql_fetch_assoc($funcionarios)) {        
        echo "<tr>
                <td>".$row['usuario']."</td>
                <td>".$row['nivel']."</td>
              </tr>";
    }
    echo "</table> <script>zebra('minhatabela','zb');</script>"
    
?>    