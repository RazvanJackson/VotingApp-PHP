<?php
    session_start();

    if(isset($_SESSION['username'])){
        $_SESSION = array();
        header("Location: http://localhost/PHP/client/pages/");
    }
?>