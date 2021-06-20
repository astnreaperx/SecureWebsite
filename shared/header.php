<?php
session_start();

if (!isset($g_page)) 
{
    $g_page = '';
}
?>

<header>
    <nav>
        <div>
            <ul>
                <div>
                    <a href="index.php">Home</a>
                </div>

                <?php if(!$_SESSION['username']): ?>
                <div>
                    <a href="login.php">Login</a>
                </div>
                <?php endif; ?>

                <?php if($_SESSION['username']): ?>
                <div>
                    <a href="logout.php">Logout</a>
                </div>
                <?php endif; ?>

                <div>
                    <a href="register.php">Register</a>
                </div>

                <div>
                    <a href="about.php">About</a>
                </div>
            </ul>
        </div>
    </nav>
</header>