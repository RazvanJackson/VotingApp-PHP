<div class="container-fluid register">
    <h1 class="text-center">Register</h1>

    <form method="POST">
        <div class="form-group">
            <label class="label" for="username">Username:</label>
            <input type="text" class="form-control" name="username">
            <small id="username_helper"></small>
        </div>
        <div class="form-group">
            <label class="label" for="email">Email:</label>
            <input type="text" class="form-control" name="email">
            <small id="email_helper"></small>
        </div>
        <div class="form-group">
            <label class="label" for="password">Password:</label>
            <input type="password" class="form-control" name="password">
            <small id="password_helper"></small>
        </div>
        <div class="form-group">
            <label class="label" for="confirm_password">Confirm Password:</label>
            <input type="password" class="form-control" name="confirm_password">
            <small id="confirm_password_helper"></small>
        </div>
        <div class="form-group">
            <button type="button" class="btn custom_button" name="submit">Register</button>
        </div>
    </form>
</div>

<script>
    $(document).ready(function(){
        let $username_input = $("[name='username']")
        let $email_input = $("[name='email']")
        let $password_input = $("[name='password']")
        let $confirm_password_input = $("[name='confirm_password']");
        let $submit_button = $("[name='submit']");

        let username_value;
        let email_value;
        let password_value;
        let confirm_password_value;
        
        $username_input.on('input', function(){
            username_value = this.value
            $.post('../../server/register_action.php', {username:this.value}, function(data){
                $('#username_helper').text(data);
            })
        })

        $email_input.on('input', function(){
            email_value = this.value
            $.post('../../server/register_action.php', {email:this.value}, function(data){
                $('#email_helper').text(data)
            })
        })

        $password_input.on('input', function(){
            password_value = this.value;
            $.post('../../server/register_action.php', {password:this.value, confirm_password:confirm_password_value}, function(data){
                $('#password_helper').text(data.password_message)
                $('#confirm_password_helper').text(data.confirm_password_message)
            })
        })

        $confirm_password_input.on('input', function(){
            confirm_password_value = this.value
            $.post('../../server/register_action.php', {confirm_password:this.value, password: password_value}, function(data){
                $('#confirm_password_helper').text(data.confirm_password_message)
                $('#password_helper').text(data.password_message)
            })
        })

        $submit_button.on('click', function(){
            $.post('../../server/register_action.php', {
                username:username_value,
                email:email_value,
                password:password_value,
                confirm_password:confirm_password_value,
                submit: true
                }, function(data){
                if(data == true) window.location.pathname = "/PHP/client/pages/login.php"
            })
        })
    })
</script>