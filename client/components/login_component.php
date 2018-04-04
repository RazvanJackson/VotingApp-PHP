<div class="container-fluid login">
    <h1 class="text-center">Login</h1>

    <form method="POST">
        <div class="form-group">
            <label class="label" for="username">Username:</label>
            <input type="text" class="form-control" name="username">
        </div>
        <div class="form-group">
            <label class="label" for="password">Password:</label>
            <input type="password" class="form-control" name="password">
        </div>
        <div class="form-group">
            <button type="button" class="btn custom_button" name="submit">Login</button>
        </div>
    </form>
</div>

<script>
    $(document).ready(function(){
        const $submit_button = $("[name='submit']");
        
        $submit_button.on('click', function(){
            const username_value = $("[name='username']")[0].value
            const password_value = $("[name='password']")[0].value
            
            $.post('../../server/login_action.php', {
                username: username_value,
                password: password_value
            }, function(data){
                if(data == true) window.location.pathname = "/PHP/client/pages/"
            })
        })
    })
</script>