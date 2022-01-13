<?php
    /* Austin Reaper
    *  Programmer
    *  March 2021
    *  Goose Corp.
    */

    ob_start();
    session_start();
    require '../config/db_connect.php';
    require '../config/pdo_connect.php'; 
    require '../vendor/autoload.php';

    // Check for errors on a post back
    if (isset($_GET['error']))
	{
		$error = $_GET['error'];
	}
    // instantiate the errors array 
    $errors = array();

    // Assign post data to variables
    $title=$_POST["ptitle"];
    $content=$_POST["pcontent"];
    $author=$_POST["author"];
    $date=date('Y-m-d H:i:s');

    // Ensure no post data is empty
    if (empty($title)) { array_push($errors, "Title is required!"); }
	if (empty($author)) { array_push($errors, "Author is required!"); }
	if (empty($content)) { array_push($errors, "Content is required!"); }

    if (count($errors) == 0) {
        $insert_sql = "INSERT INTO posts (title, content) VALUES (:title, :content)";
		$statement2 = $db->prepare($insert_sql);
		$statement2->bindParam(':title',$title);
		$statement2->bindParam(':content',$content);
		//$statement2->bindParam(':date',$date);
		$statement2->execute() or die(print_r($statement2->errorInfo(), true));
		$statement2->fetch();
		echo "Posted";
		header("Refresh:3; url=../index.php");
    }
    // Echo any errors to the page
    // Do not depoloy like this, error codes baby !!
    foreach ($errors as $error) {
        echo "<p>$error</p>";  
    }
    $_POST['errors'] = $errors;
?>