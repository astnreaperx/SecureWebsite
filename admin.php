<?php
    /* Austin Reaper
    *  Programmer
    *  March 2021
    *  Goose Corp.
    */

    ob_start();
    session_start();
    #require 'config/db_connect.php';
    require 'config/pdo_connect.php'; 
    require 'vendor/autoload.php';
    #require_once 'PhpRbac/autoload.php'; 

    $rbac = new \PhpRbac\Rbac();

    $role_id = $rbac->Roles->returnId('admin');
    $user_id = $_SESSION['userid'];

    // Verify User
    // will show nothing if not user id
    if ($rbac->Users->hasRole($role_id, $user_id))
    {
        $var_testoutput = <<<EOD
        <form action="scripts/check_admin_post.php" method="post">
        <label for="ptitle">Post Title:</label><br>
        <input type="text" id="ptitle" name="ptitle"><br>
        <label for="author">Post Author:</label><br>
        <input type="text" id="author" name="author"><br>
        <label for="pcontent">Post Content:</label><br>
        <textarea id="pcontent" name="pcontent" rows="10" ></textarea><br>
        <input type="submit" value="Post">
        </form>
        EOD;
    }else{
        $var_testoutput = "<h2>You should not be here!</h2>";
    }	
?>
<!DOCTYPE html>

    <?php require 'shared/head.php'; ?>

    <div class="container">
        <?php require 'shared/header.php'; ?>
            <body>
                <?php echo $var_testoutput; ?>
            </body>
        <?php require 'shared/footer.php'; ?>
        <link href="images/favicon.ico" rel="icon" type="image/x-icon" />
    </div>
</html>