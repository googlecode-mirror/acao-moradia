<?php	
    session_start();
    if(isset($_SESSION['nivel'])){
        header("Location: visao/vAtendente.php");
    }else{
        header("Location: visao/vLogin.php");
    }
?>
Something is wrong with the XAMPP installation :-(
