<?php
    require 'config/db_connect.php';

	// check is there is an error if so assign to
	if (isset($_GET['error']))
	{
		$error = $_GET['error'];
	}

	$myusername='';
	$myemail='';
 ?>


<?php

if(isset($_POST['username']))
{
	ob_start(); // session management

	require 'config/pdo_connect.php'; 

	$tbl_name="members"; // Table name if you wish to use a variable

	$myusername=$_POST['username'];
	$myemail = $_POST['email'];
	$mypassword= $_POST['password'];
	$mypassword2= $_POST['password2'];

	// set an error array so you can // print out all problems
	$errors = array();

	if (empty($myusername)) { array_push($errors, "Username required!"); }
	if (empty($myemail)) { array_push($errors, "Email is required!"); }
	if (empty($mypassword)) { array_push($errors, "Password required!"); }
	if (!filter_var($myemail, FILTER_VALIDATE_EMAIL)) { array_push($errors, "Email is not valid!"); }
	if ($mypassword != $mypassword2) { array_push($errors, "The two passwords do not match!"); }

	$user_check_query = "SELECT username, email FROM members WHERE username=:myusername OR email=:myemail LIMIT 1";
	$statement = $db->prepare($user_check_query);
	$statement->bindParam(':myusername',$myusername);
	$statement->bindParam(':myemail',$myemail);
	$statement->execute() or die(print_r($statement->errorInfo(), true));
	$user = $statement->fetch();

	if($user) 
	{// if user exists, which field?
		if ($user['username'] == $myusername) {
			array_push($errors, "Username already exists!");
		}
		if ($user['email'] == $myemail) {
			array_push($errors, "Email already exists!");
		}
	}
	if(count($errors) == 0) 
	{// salting adds uniqueness to each entry
		$salt=uniqid() ;
		$salted_password=$salt.$mypassword;
		$encrypted_password = hash("sha512", $salted_password);

		$insert_sql="insert into members (username,password,salt,email) values (:myusername,:encrypted_password,:salt,:email)";
		$statement = $db->prepare($insert_sql);
		$statement->bindParam(':myusername',$myusername);
		$statement->bindParam(':encrypted_password',$encrypted_password);
		$statement->bindParam(':salt',$salt);
		$statement->bindParam(':email',$myemail);
		$statement->execute() or die(print_r($statement->errorInfo(), true));
		$pass = $statement->fetch();

		echo "Registered";
		// Added this to redirect to home page
		header("Refresh:3; url=login.php");
	}
	else
	{
		foreach ($errors as $error) {echo "<p>$error</p>";}
	}
	ob_end_flush();
}
?>


<?php if(!isset($_POST['username']) || count($errors) > 0 ): ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<?php require 'shared/header.php'; ?>
	<form name="form1" method="post" action="register.php">
		<td>
			<table width="100%" border="0" cellpadding="3" cellspacing="1" >

				<tr>
				<td colspan="3"><strong>Member Register </strong></td>
				</tr>

				<tr>
				<td>Username</td>
				<td>:</td>
				<td><input type="text" name="username" id="username" required value="<?= $myusername ?>"></td>
				</tr>

				<tr>
				<td>Email</td>
				<td>:</td>
				<td><input type="text" name="email" id="email" required value="<?= $myemail ?>"></td>
				</tr>

				<tr>
				<td>Password</td>
				<td>:</td>
				<td><input type="password" name="password" id="password" required></td>
				</tr>

				<tr>
				<td>Password</td>
				<td>:</td>
				<td><input type="password" name="password2" id="password2" required></td>
				</tr>

				<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td><input type="submit" value="Register"></td>
				</tr>

			</table>
		</td>
	</form>
</body>
</html>
<?php endif; ?>

<?php if(isset($error)): ?>
	<p style="color: red">Failed to Register</p>
<?php endif; ?>


