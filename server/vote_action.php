<?php
    session_start();
    if(isset($_POST['option_id'], $_POST['poll_id'])){
        include_once "database.php";

        $option_id = $_POST['option_id'];
        $poll_id = $_POST['poll_id'];
        $user_id = $_SESSION['id'];

        $query = "SELECT * FROM user_vote WHERE user_id={$user_id} AND poll_id={$poll_id}";
        $result = mysqli_query($conn, $query); 
        
        if($result->num_rows == 0){
            $query = "INSERT INTO user_vote(`user_id`, `poll_id`, `option_id`) VALUES('{$user_id}', '{$poll_id}', '{$option_id}')";
            $result = mysqli_query($conn, $query);

            if($result == 1){
                $query = "SELECT * FROM options WHERE id='{$option_id}'";
                $result = mysqli_query($conn, $query);

                $votes = $result->fetch_assoc()['votes'];
                $new_vote = $votes+1;
                
                $query = "UPDATE options SET votes={$new_vote} WHERE id={$option_id}";
                $result = mysqli_query($conn, $query);

                if($result == 1) echo true;
                else "Unknown error.";
            }
            else echo "Unknown error.";
        }

        else echo "You have already voted on this poll.";
    }
?>