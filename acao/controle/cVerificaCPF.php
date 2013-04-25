<?php    
    require_once '../bd/Debug.php';    
    require_once '../bd/PessoaDAO.php';    
    
    $cpf = $_POST['cpf'];
    
    $pessoaDAO = new PessoaDAO();        
    
    //$return = '<input type="hidden" name="ex" id="ex" value="'.mysql_num_rows($pessoaDAO->buscaPessoaByCPF($cpf)).'">'.$cpf;
    $return = mysql_num_rows($pessoaDAO->buscaPessoaAtivaByCPF($cpf));
    Debug::gravaEmArquivo($return);
    //Debug::alert($return." ");
    echo $return;
?>