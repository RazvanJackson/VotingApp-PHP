<div class="container-fluid new_poll">
    <h1 class="text-center">New poll</h1>
    <form method="POST" >
        <div class="options">
            <div class="form-group">
                <label class="label" for="question">Question:</label>
                <input type="text" class="form-control" name="question">
            </div>
            <div class="form-group">
                <p class="option_title">Options:</p>
            </div>
            <div class="form-group">
                <input type="text" class="form-control option" name="option1">
            </div>
            <div class="form-group">
                <input type="text" class="form-control option" name="option2"> 
            </div>
        </div>
        <div class="form-group">
            <button type="button" class="btn custom_button" name="submit">Create Poll</button>
            <button type="button" class="btn custom_button" name="add_option_button">Add option</button>
            <button type="button" class="btn custom_button" name="remove_option_button">Remove last option</button>
        </div>
    </form>
</div>

<script>
    $(document).ready(function(){
        let options = document.querySelectorAll('.option')
        let number_of_options = options.length;
        
        let $add_option_button = $('[name="add_option_button"]')
        $add_option_button.on('click', function(e){
            number_of_options++;
            $('.options').append(
            `<div class="form-group">
                <input type="text" class="form-control option" name="option${number_of_options}"> 
            </div>`)
        })

        let $remove_option_button = $('[name="remove_option_button"]')
        $remove_option_button.on('click', function(e){
            if(number_of_options > 2){
                options = document.querySelectorAll('.option')
                options[number_of_options-1].remove();
                number_of_options--;
            }
        })

        let $submit_button = $('[name="submit"]')
        $submit_button.on('click', function(){
            let array = [];
            let $options = $('.option')
            let $question = $('[name="question"]')[0]
            $options.each(function(index){
                if(this.value != "") array.push(this.value)
            })
            
            if ($question.value == ""){
                $('.notification').removeClass("custom-success").addClass("custom-danger").fadeIn(250);
                $('#notification-text').text("You do not have a question!");
            }
            else if(array.length < 2){
                $('.notification').removeClass("custom-success").addClass("custom-danger").fadeIn(250);
                $('#notification-text').text("You must have at least 2 options!");
            }
            else $.post("../../server/new_poll_action.php",
            {
                question : $question.value,
                options: array
            },
            function(data){
                if(data==true){
                    $('.notification').removeClass("custom-danger").addClass("custom-success").fadeIn(250);
                    $('#notification-text').text("You have succesfully created a poll!");
                }
                else{
                    $('.notification').removeClass("custom-success").addClass("custom-danger").fadeIn(250);
                    $('#notification-text').text("You are not logged in!");
                }
            })
        })
    })
</script>