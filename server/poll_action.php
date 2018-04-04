<?php
    if(isset($_GET['id'])){
        include_once "database.php";

        $poll_id = $_GET['id'];

        $query = "SELECT * FROM polls WHERE id = {$poll_id}";
        $poll_result = mysqli_query($conn, $query)->fetch_assoc();


        if(isset($poll_result)){
            $query = "SELECT * FROM options WHERE poll_id = {$poll_id}";
            $options_result = mysqli_query($conn, $query);

            $total_votes = 0;
            while($row = $options_result->fetch_assoc()){
                $total_votes += $row['votes'];
            }
            mysqli_data_seek($options_result, 0);
        }
    }
?>