<?php 
    /* Austin Reaper
    *  Programmer
    *  March 2021
    *  Goose Corp.
    */
	
	require 'config/pdo_connect.php';
	require 'vendor/autoload.php';

	// check is there is an error if so assign to
	if (isset($_POST['errors']))
	{
		$error = $_POST['errors'];
		echo $error;
	}



?>

<!DOCTYPE html>
<?php require 'shared/head.php'; ?>
<div class="container">
<?php require 'shared/header.php'; ?>
	<body>
	<form name="form1" method="post" action="scripts/check_register.php">
		<td>
			<table width="100%" border="0" cellpadding="3" cellspacing="1" >

				<tr>
				<td colspan="3"><strong>Member Register </strong></td>
				</tr>

				<tr>
				<td>Username</td>
				<td>:</td>
				<td><input type="text" name="username" id="username" required "></td>
				</tr>

				<tr>
				<td>Email</td>
				<td>:</td>
				<td><input type="text" name="email" id="email" required "></td>
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
</div>
</html>

<?php if(isset($error)): ?>
	<p style="color: red">Failed to Register</p>
<?php endif; ?>


