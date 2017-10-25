<?php
session_start();
if(isset($_SESSION['id']))
{
	$user_id = $_SESSION['id'];
}


?>
<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Json's World</title>
<link type="text/css" rel="stylesheet" href="css/style.css"/>
</head>
<body>
<nav>
	<ul>
		<li><a href="index.php">Home</a></li>
		
		<?php
			if(isset($_SESSION['id']))
			{
		?>
		<li><a href="logout.php">Logout</a></li>

		<?php
			}
			else 
			{
		?>
		<li><a href="login.php">Login</a></li>
		<li><a href="register.php">Register</a></li>
		<?php
			}

		?>
		
		
	</ul>
</nav>
<br><br><br>
<?php


?>

</body>
</html>