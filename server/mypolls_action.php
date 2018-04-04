<?php
    if(isset($_SESSION['id'])){
        include_once "database.php";

        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $polls_per_page = 5;

        $query = "SELECT* FROM polls WHERE creator_id = {$_SESSION['id']}";
        $result = mysqli_query($conn, $query);

        $polls_created_by_user = $result->num_rows;
        $polls_next_page =  $polls_created_by_user > $page * $polls_per_page &&  $polls_created_by_user < ($page+1) * $polls_created_by_user? false : true;
        
        if($polls_created_by_user <= $polls_per_page) $pages = 1;
        else if($polls_created_by_user % $polls_per_page == 0) $pages = $polls_created_by_user / $polls_per_page;
        else if($polls_created_by_user % $polls_per_page != 0) $pages = $polls_created_by_user / $polls_per_page + 1;

        $skip = ($page-1)*$polls_per_page;
    

        $query = "SELECT * FROM polls WHERE creator_id = {$_SESSION['id']} LIMIT {$skip},{$polls_per_page}";
        $result = mysqli_query($conn, $query);
        $polls_this_page = $result->num_rows;
    }

    else{
        header("Location: /PHP/client/pages/login.php");
    }
?>