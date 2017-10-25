<?php
session_start();
if(isset($_SESSION['ed_id']))
{
	$ed_id = $_SESSION['ed_id'];
}



?>
<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Insert title here</title>
<link type="text/css" rel="stylesheet" href="css/style.css"/>
</head>
<body>
<nav>
	<ul>
		<li><a href="index.php">Home</a></li>
		
		
		<li><a href="logout.php">Logout</a></li>
	</ul>
</nav>
<br><br><br>
<?php



?>

</body>
</html>