<?php
    include_once "../../server/mypolls_action.php";
?>

<div class="container-fluid mypolls">
    <?php if(isset($polls_this_page) && $polls_this_page != null){ ?>
    <h1 class="text-center">My Polls</h1>
    <h4 class="text-center"><?php echo "Page: ".$page ?></h4>

    <?php
        while($row = $result->fetch_assoc()){
            echo "<a href='/PHP/client/pages/poll.php?id={$row['id']}' class='poll_question'>{$row['question']}</a>";
        }
    ?>
    <div class="pagination">
        <div class="pagination_components">
            <button class="btn btn-primary" id="prev_button" <?php if($page == 1) echo "disabled"; ?>>Prev</button>
            <button class="btn btn-primary" id="next_button" <?php if($polls_next_page) echo "disabled"; ?>>Next</button>

            <input type="text" name="page_search_to" id="page_search_to">
            <button class="btn btn-primary" id="search_button">Search</button>
        </div>
    </div>
    <?php } else { ?>
    <h1 class="text-center">You don't have so many polls.</h1>
    <div class="no_polls_div">
        <a href="/PHP/client/pages/mypolls.php" class="btn btn-primary" id="no_polls_button">Click here to go to your first poll page</a>
    </div>
    <?php } ?>
</div>

<script>
    $(document).ready(function(){
        $prev_button = $('#prev_button')
        $next_button = $('#next_button')
        $page_search_to = $('#page_search_to')
        $search_button = $('#search_button')

        $prev_button.on('click', function(){
            let page = parseInt(window.location.search.replace('?page=', ''));
            if(page > 1){
                window.location = "http://localhost/PHP/client/pages/mypolls.php?page="+parseInt(page-1)
            }
        })

        $next_button.on('click', function(){
            let page
            if(window.location.search) page = parseInt(window.location.search.replace('?page=', ''))
            else page = 1;
                
            window.location = "http://localhost/PHP/client/pages/mypolls.php?page="+parseInt(page+1)
        })

        $search_button.on('click', function(){
            let page_to_go = $page_search_to[0].value
            window.location = "http://localhost/PHP/client/pages/mypolls.php?page="+parseInt(page_to_go)
        })
    })
</script>