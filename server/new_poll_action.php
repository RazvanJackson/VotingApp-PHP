<?php
    include_once "database.php";
    session_start();
    if(isset($_SESSION['id'])){
        $question = isset($_POST['question']) ? $_POST['question'] : null;
        $options = isset($_POST['options']) ? $_POST['options'] : null;

        $query = "INSERT INTO polls(`question`, `creator_id`) VALUES('{$question}', '{$_SESSION['id']}')";
        $result = mysqli_query($conn, $query);
        $query = "SELECT LAST_INSERT_ID()";
        $result = mysqli_query($conn, $query);
        $last_id = $result->fetch_assoc()['LAST_INSERT_ID()'];

        foreach($options as $value){
            $query = "INSERT INTO options(`option`, `poll_id`, `votes`) VALUES('{$value}', '{$last_id}', 0)";
            $result = mysqli_query($conn, $query);
        }

        echo true;
    }
    else echo false;


?>