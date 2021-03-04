<?php
	require 'config/db_connect.php';
	require 'config/pdo_connect.php';

	$myusername='';
	$total_failed_login = 3;
	$lockout_time       = 15;
	$account_locked     = false;
?>


<?php if(!isset($_POST['password'])) {
// Only go here is the post password is not set(not tried logging in)
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<?php require 'shared/header.php'; ?>

<body>
<div class="w3-content" style="max-width:1100px;margin-top:80px;margin-bottom:80px">
	<form name="form1" method="post" action="login.php"> 
			<table width="100%" border="0" cellpadding="3" cellspacing="1" >
				<tr>
					<td colspan="3"><strong>Member Login </strong></td>
				</tr>
				<tr>
					<td width="78">Username</td>
					<td width="6">:</td>
					<td width="294"><input name="username" id="username" value="<?= $user ?>" required></td>
				</tr>
				<tr>
					<td>Password</td>
					<td>:</td>
					<td><input type="password" name="password" id="password" required></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td><input type="submit" value="Login"></td>
				</tr>
			</table>
		</td>
	</form>
</div>
</body>
</html>


<?php }else
{
ob_start(); 

	$user=$_POST['username'];

	$data = $db->prepare( 'SELECT failed_login, last_login FROM members WHERE username = (:username) LIMIT 1;' );
	$data->bindParam( ':username', $user, PDO::PARAM_STR );
	$data->execute();
	$row = $data->fetch();

	// Ensure we sreturn a siblge user who is not locked out
	if( ( $data->rowCount() == 1 ) && ( $row[ 'failed_login' ] >= $total_failed_login ) )  
	{
		echo "<pre><br />This account has been locked due to too many incorrect logins.</pre>";

		$last_login = strtotime( $row[ 'last_login' ] );
		$timeout    = $last_login + ($lockout_time * 60);
		$timenow    = time();
		header("Refresh:3; url=main_login.php");

		if( $timenow < $timeout ) 
		{
			$account_locked = true;
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

	if($checkpassword==$returnedpassword && $_POST['password']<>'' && $account_locked == false)
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
	ob_end_flush();
	// Update Locuout 
	$data = $db->prepare( 'UPDATE members SET last_login = now() WHERE username = (:username) LIMIT 1;' );
	$data->bindParam( ':username', $user, PDO::PARAM_STR );
	$data->execute();

}
	
?>

