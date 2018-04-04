<?php
    include_once "functions.php";
    include_once "database.php";

    $username = isset($_POST['username']) ? mysqli_real_escape_string($conn,$_POST['username']) : null;
    $email = isset($_POST['email']) ? mysqli_real_escape_string($conn,$_POST['email']) : null;
    $password = isset($_POST['password']) ? mysqli_real_escape_string($conn,$_POST['password']) : null;
    $confirm_password = isset($_POST['confirm_password']) ? mysqli_real_escape_string($conn,$_POST['confirm_password']) : null;
    $submit = isset($_POST['submit']) ? mysqli_real_escape_string($conn,$_POST['submit']) : null;

    $check = array(
        "username" => false,
        "email" => false,
        "password" => false,
        "confirm_password" => false
    );

    $validation = array(
        "username" => "/[a-zA-Z]{3,15}/",
        "email" => FILTER_VALIDATE_EMAIL,
        "password" => "/[a-zA-Z0-9!@#$%^&*]{3,25}/"
    );

    global $submit, $check, $validation;

    if($username){
        if(!$submit) echo check_username($conn, $username);
        else if($submit) check_username($conn, $username);
    }

    if($email){
        if(!$submit) echo check_email($conn, $email);
        else if($submit) check_email($conn, $email);
    }

    if($password || $confirm_password){
        if(!$submit) echo check_passwords($password, $confirm_password);
        else if($submit) check_passwords($password, $confirm_password);
    }

    if($submit){
        if(
            $check['username'] &&
            $check['email'] &&
            $check['password'] &&
            $check['confirm_password']
        ){
            $password = md5($password);
            $query = "INSERT INTO users(`username`, `email`, `password`) VALUES('{$username}', '{$email}', '{$password}')";
            $result = mysqli_query($conn, $query);
            if($result == 1) echo true;
        }
    }

    function check_username($conn, $username){
        if(preg_match($GLOBALS["validation"]["username"], $username)){
            $query = "SELECT * FROM users WHERE username='{$username}'";
            $result = mysqli_query($conn,$query);
            if($result->num_rows == 0){
                $GLOBALS["check"]["username"] = true;
                return "Valide username.";
            } 
            else return "Username already exist.";
        }
        else return "Invalid username.";
    }

    function check_email($conn, $email){
        $query = "SELECT * FROM users WHERE email='{$email}'";
        $result = mysqli_query($conn,$query);
        if($result->num_rows == 0){
            if(filter_var($email, $GLOBALS["validation"]['email'])){
                $GLOBALS["check"]['email'] = true;
                return "Valide email.";
            }
            else return "Invalide email.";
        }
        else return "This email already exists";
    }

    function check_passwords($password, $confirm_password){
        $json;
        if(preg_match($GLOBALS["validation"]['password'], $password)){
            $GLOBALS["check"]['password'] = true;
            $json = '"password_message": "Valide passsword."';
        }

        else $json = '"password_message": "Invalide password."';

        if($confirm_password == $password){
            $GLOBALS["check"]['confirm_password'] = true;
            $json = $json . ',"confirm_password_message": "Password do match."';
        }

        else $json = $json . ',"confirm_password_message": "Password do not match."';
        
        if(!$GLOBALS['submit']){
        $json = '{'.$json.'}';
        header('Content-Type: application/json');
        print_r(json_encode(json_decode($json)));
        }
    }

    
?>