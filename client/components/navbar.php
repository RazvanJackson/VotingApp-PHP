<nav class="navbar navbar-expand-lg">
    <a href="/PHP/client/pages/" class="navbar-brand">Home</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-user-content">
        <span class="navbar-toggler-icon"><i class="fas fa-user navbar-icon"></i></span>
    </button>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-poll-content">
        <span class="navbar-toggler-icon"><i class="fas fa-chart-bar navbar-icon"></i></span>
    </button>
    <div class="collapse navbar-collapse" id="navbar-poll-content">
        <ul class="navbar-nav">
            <?php
                if(isset($_SESSION['username'])){
                    
            ?>
                <li class="nav-item">
                    <a href="/PHP/client/pages/mypolls.php" class="nav-link">My Polls</a>
                </li>
                <li class="nav-item">
                    <a href="/PHP/client/pages/newpoll.php" class="nav-link">New Poll</a>
                </li>
            <?php 
                } 
            ?>
        </ul>
    </div>
    <div class="collapse navbar-collapse" id="navbar-user-content">
        <ul class="navbar-nav ml-auto">
            <?php
                if(!isset($_SESSION['username'])){
                    
            ?>
                <li class="nav-item">
                    <a href="/PHP/client/pages/login.php" class="nav-link">Login</a>
                </li>
                <li class="nav-item">
                    <a href="/PHP/client/pages/register.php" class="nav-link">Register</a>
                </li>
            <?php
                }else {
            ?>
                <li class="nav-item">
                    <a href="/PHP/client/pages/login.php" class="nav-link"><?php echo $_SESSION['username']; ?></a>
                </li>
                <li class="nav-item">
                    <a href="/PHP/client/pages/logout.php" class="nav-link">Logout</a>
                </li>
            <?php } ?>
        </ul>
    </div>
</nav>