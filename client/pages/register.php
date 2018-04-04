<?php
    session_start();
    if(!isset($_SESSION['username'])){
        include_once "../components/header.php";
        include_once "../components/jumbotron.php";
        include_once "../components/register_component.php";
        include_once "../components/footer.php";
    }
    else header("Location: http://localhost/PHP/client/pages/");
?>