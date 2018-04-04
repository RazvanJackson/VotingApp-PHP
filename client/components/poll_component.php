<?php
    include_once "../../server/poll_action.php"
?>

<div class="container poll">
    <?php
        if(!isset($_GET['id'])){
    ?>

    <h1 class="text-center">You don't have a choosen poll!</h1>
    <div class="redirect_to_poll">
        <input type="text" name="poll_id" class="form-control" id="poll_id"/>
        <button type="button" class="btn custom_button" id="search_poll_button">Submit</button>
    </div>

    <?php }else if(isset($poll_result)){ ?>
        <h1 class="text-center"> <?php echo $poll_result['question'] ?> </h1>

        <div class="poll_buttons">
            <button class="btn custom_button" id="options_view">Options</button>
            <button class="btn custom_button" id="results_view">Results</button>
        </div>
        <div class="poll_view">
    <?php 

        }
        if(isset($_GET['view'])){
            if($_GET['view'] == 'options'){
                while($row = $options_result->fetch_assoc()){
                    echo "
                        <button class='btn custom_button option' option_id='{$row['id']}'> {$row['option']} </button>
                    ";
                }
            }
            else if($_GET['view'] == 'results'){
                while($row = $options_result->fetch_assoc()){
                    if($row['votes'] != 0)  $this_vote_bar = $row['votes']/$total_votes*100;
                    else $this_vote_bar = 0;               
                    echo "
                        <div class='progress'>
                            <div class='progress-bar bg-warning' style='width:{$this_vote_bar}%'>
                                <span>{$row['option']} &nbsp; ( {$row['votes']} votes )</span> 
                            </div>
                        </div>
                    ";
                }
            }

        }else { ?>
            
            <?php
                while($row = $options_result->fetch_assoc()){
                    
                    echo "
                        <button class='btn custom_button option' option_id='{$row['id']}'> {$row['option']} </button>
                    ";
                }
            ?>

        <?php } ?> 
    
        </div>
    
</div>

<script>
    $(document).ready(function(){
        $submit = $('#search_poll_button')
        $submit.on('click', function(){
            let poll_id = $('#poll_id')[0].value
            window.location = `/PHP/client/pages/poll.php?id=${poll_id}`
        })

        $options_view = $('#options_view')
        $options_view.on('click', function(){
            if(window.location.search.match(/view/)) window.location.search = window.location.search.replace(/view=\w+/, "view=options")
            else window.location.search = window.location.search + "&&view=options"
        })

        $results_view = $('#results_view')
        $results_view.on('click', function(){
            if(window.location.search.match(/view/)) window.location.search = window.location.search.replace(/view=\w+/, "view=results")
            else window.location.search = window.location.search + "&&view=results"
        })

        $option = $(".option")
        $option.on('click', function(){
            let option_id = $(this).attr("option_id")
            let poll_id = window.location.search.split(/[(\?|&&)]/).filter(function(value){ return value != ''}).filter(function(value){
                if(value.match(/id=[0-9]+/)) return value
            })[0].substr(3)
            
            $.post("../../server/vote_action.php", {
                option_id:option_id,
                poll_id:poll_id
                }, 
                function(data){
                    console.log(data);
                if(data == true){
                    $('.notification').removeClass('custom-danger').addClass('custom-success').fadeIn(250);
                    $('#notification-text').text("You have succesfully voted.");
                }
                else{
                    $('.notification').removeClass("custom-success").addClass("custom-danger").fadeIn(250);
                    $('#notification-text').text(data);
                }
            })
        })
    })
</script>