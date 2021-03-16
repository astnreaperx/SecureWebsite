<?php
    ob_start();

    require 'config/db_connect.php';
    require 'config/pdo_connect.php';
    require 'vendor/autoload.php';
    
    $total_failed_login = 1;
    $lockout_time       = 15;
    $account_locked     = false;

    date_default_timezone_set("America/Winnipeg");

    $user=$_POST['username'];

    $data = $db->prepare( "SELECT failed_login, last_login FROM members WHERE username = (:username) LIMIT 1;");
    $data->bindParam( ':username', $user, PDO::PARAM_STR );
    $data->execute();
    $row = $data->fetch();

    if( ( $data->rowCount() == 1 ) && ( $row['failed_login' ] >= $total_failed_login ) )  
    {
        echo "<pre><br />This account has been locked due to too many incorrect logins.</pre>";
        header("Refresh:3; url=login.php");
        $last_login = strtotime( $row['last_login' ] );
        $timeout    = $last_login + ($lockout_time);
        $timenow    = time();
        print "The timenow is: " . date ("h:i:s", $timenow) . "<br />";
        print "The timeout is: " . date ("h:i:s", $timeout) . "<br />";
        
        // if timeout is before time now
        if($timenow < $timeout ) 
        {
            echo "<br> wait 15 min";
            $account_locked = true;
            die();
        }		
    }

    $select_sql = "SELECT id, password, salt FROM members WHERE username=:username;";
    $statement = $db->prepare($select_sql);
    $statement->bindParam(':username',$_POST['username']);
    $statement->execute();
    $pass = $statement->fetch();

    $returnedpassword=$pass['password'];
    $returnedsalt=$pass['salt'];

    $salted_password=$returnedsalt.$_POST['password'];
    $checkpassword = hash("sha512", $salted_password);

    if($checkpassword == $returnedpassword && $_POST['password']<>'' && $account_locked == false)
    {
        session_start();
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['userid'] = $pass['id'];
        echo "Success";
        header("Refresh:3; url=index.php");

        // Reset login
        $data = $db->prepare( 'UPDATE members SET failed_login = "0" WHERE username = (:username) LIMIT 1;' );
        $data->bindParam( ':username', $user, PDO::PARAM_STR );
        $data->execute();
    }
    else 
    {
        echo "Wrong Username or Password";
        $data = $db->prepare( 'UPDATE members SET failed_login = (failed_login + 1) WHERE username = (:username) LIMIT 1;' );
        $data->bindParam( ':username', $user, PDO::PARAM_STR );
        $data->execute();
        header("Refresh:3; url=login.php");
    }

    // Update Locuout 
    $data = $db->prepare( 'UPDATE members SET last_login = now() WHERE username = (:username) LIMIT 1;' );
    $data->bindParam( ':username', $user, PDO::PARAM_STR );
    $data->execute();
    ob_end_flush();

?>