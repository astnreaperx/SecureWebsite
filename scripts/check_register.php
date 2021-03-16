<?php
    require '../config/db_connect.php';
	require '../vendor/autoload.php';
	require '../config/pdo_connect.php'; 
    ob_start(); // session management
    use PhpRbac\Rbac;
    $rbac = new Rbac();

	// check is there is an error if so assign to
	if (isset($_GET['error']))
	{
		$error = $_GET['error'];
	}

	$myusername='';
	$myemail='';


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
		echo "Test";
		$salt=uniqid() ;
		$salted_password=$salt.$mypassword;
		$encrypted_password = hash("sha512", $salted_password);
		echo " Test 1";
		$insert_sql = "INSERT INTO members (username, password, salt, email) VALUES (:myusername, :encrypted_password, :salt, :email)";
		echo " Test 2";
		$statement2 = $db->prepare($insert_sql);
		$statement2->bindParam(':myusername',$myusername);
		$statement2->bindParam(':encrypted_password',$encrypted_password);
		$statement2->bindParam(':salt',$salt);
		$statement2->bindParam(':email',$myemail);
		echo " Test 3";
		$statement2->execute() or die(print_r($statement2->errorInfo(), true));
		echo " Test 4";
		$pass = $statement2->fetch();
		echo $pass;
		echo "Registered";
		// Added this to redirect to home page
		header("Refresh:3; url=../login.php");
	}
	else
	{
		foreach ($errors as $error) {
            echo "<p>$error</p>";  
        }
        $_POST['errors'] = $errors;
        header("Refresh:3; url=../register.php");
            

	}
	ob_end_flush();
?>