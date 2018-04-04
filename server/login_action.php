<?php
    session_start();

    $username = isset($_POST['username']) ? $_POST['username'] : null;
    $password = isset($_POST['password']) ? $_POST['password'] : null;

    $username = "aaa";
    $password = "aaa";
    if($username && $password){
        include_once "database.php";

        $hash_password = md5($password);
        $query = "SELECT id, username, email FROM users WHERE `username`='{$username}' AND `password`='{$hash_password}'";
        $result = mysqli_query($conn, $query);
        if($result->num_rows == 1){
            $user = $result->fetch_assoc();
            foreach($user as $key => $value){
                $_SESSION[$key] = $value;
            }
            echo true;
        }
        else echo "Username and password do not match.";
    }  
    else echo "All fields must be completed";
?>