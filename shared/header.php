<?php

if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

if (!isset($g_page)) 
{
    $g_page = '';
}
?>

<header>
    <nav>
        <div class="row">
            <div class="col-md-3">
                <ul class="list-group">
                    <div>
                        <li class="list-group-item">
                            <a href="index.php" >Home</a>
                        </li>
                    </div>

                    <?php if(!isset($_SESSION['username'])): ?>
                    <div>
                        <li class="list-group-item">
                            <a href="login.php">Login</a>
                        </li>
                    </div>
                    <?php endif; ?>

                    <?php if(isset($_SESSION['username'])): ?>
                    <div>
                        <li class="list-group-item">
                            <a href="logout.php">Logout</a>
                        </li>
                    </div>
                    <?php endif; ?>

                    <div>
                        <li class="list-group-item">
                            <a href="register.php">Register</a>
                        </li>
                    </div>

                    <div>
                        <li class="list-group-item">
                            <a href="about.php">About</a>
                        </li>
                    </div>
                </ul>
            </div>

            <div class="col-md-9 text-center">
                <h1>Austins Website</h1>
                <img src="images/manjaro.png" class="img-fluid" style="height: auto;width: 10%;" alt="">
            </div>
        </div>
    </nav>
</header>