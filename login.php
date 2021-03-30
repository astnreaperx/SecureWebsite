<?php 
    /* Austin Reaper
    *  Programmer
    *  March 2021
    *  Goose Corp.
    */
	
	require 'config/db_connect.php';
	require 'config/pdo_connect.php';
	require 'vendor/autoload.php';

	use PhpRbac\Rbac;
    $rbac = new Rbac();

	// check is there is an error if so assign to
	if (isset($_GET['error']))
	{
		$error = $_GET['error'];
	}



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
	<form name="form1" method="post" action="scripts/check_login.php"> 
			<table width="100%" border="0" cellpadding="3" cellspacing="1" >
				<tr>
					<td colspan="3"><strong>Member Login </strong></td>
				</tr>
				<tr>
					<td width="78">Username</td>
					<td width="6">:</td>
					<td width="294"><input name="username" id="username" required></td>
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
			<?php if(isset($error)) :?>
				<p>Failed to login</p>
			<?php endif; ?>
		</td>
	</form>
</div>
</body>
</html>