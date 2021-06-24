<?php
    /* Austin Reaper
    *  Programmer
    *  March 2021
    *  Goose Corp.
    */

    ob_start();
    session_start();
    require 'config/db_connect.php';
    require 'config/pdo_connect.php'; 
    require_once 'vendor/autoload.php';
    use PhpRbac\Rbac;
    $rbac = new Rbac();

    $role_id = $rbac->Roles->returnId('admin');
    $user_id = $_SESSION['userid'];
    echo $user_id;
    
    # all non logged in users
    if($user_id = 0){
        $var_testoutput = "<h2>You should not be here!</h2>";
    }

    $g_page = 'admin';

    echo("Test");
    // Verify User
    // will show nothing if not user id
    if ($rbac->Users->hasRole($role_id, $user_id) ){
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/bootstrap.css">
    <script src="styles/bootstrap.bundle.js"></script>
    <title>Document</title>
</head>
<?php require 'shared/header.php' ?>
<body>
    <?php echo $var_testoutput; ?>
</body>
</html>