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
    $pTitle=$_POST["ptitle"];
    $pContent=$_POST["pcontent"];
    $pPoster=$_POST["poster"];
    $pDate='';

    // Ensure no post data is empty
    if (empty($pTitle)) { array_push($errors, "Title is required!"); }
	if (empty($pPoster)) { array_push($errors, "Author is required!"); }
	if (empty($pContent)) { array_push($errors, "Content is required!"); }


    // Echo any errors to the page
    // Do not depoloy like this, error codes baby !!
    foreach ($errors as $error) {
        echo "<p>$error</p>";  
    }
    $_POST['errors'] = $errors;
?>