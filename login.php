<?php
	include 'header.php';
	include 'conn.php';

?>
<!DOCTYPE html>
<html>
<head>
	<title>Login to your account</title>
</head>
<body>
<div class="main_div">
<?php
if(isset($_POST['au_login']))
	{
		//echo "He";
		$au_user_name_ok = 0;
		$au_password_ok = 0;
		if((isset($_POST['au_user_name'])) && !empty($_POST['au_user_name']))
		{
			$au_user_name = $_POST['au_user_name'];
			$au_user_name_ok = 1;
		}
		if((isset($_POST['au_password'])) && !empty($_POST['au_password']))
		{
			$au_password = $_POST['au_password'];
			$au_password_ok = 1;
		}
		//echo $au_password_ok; 
		if($au_user_name_ok && $au_password_ok)
		{
			//echo "OK";
			$sql = "SELECT * FROM `user_data` WHERE `user_name`='$au_user_name' AND `password`='$au_password'";
			$query = mysqli_query($conn,$sql);
			if($query)
			{
				$affected_row = mysqli_affected_rows($conn);
				if($affected_row!=0)
				{
						$row = mysqli_fetch_assoc($query);					
						$id=$row['id'];
						$full_name = $row['full_name'];
						$email = $row['email'];
						$inst = $row['inst'];
						$user_name = $row['user_name'];
						$password = $row['password'];					
					if($au_user_name==$user_name && $au_password==$password)
					{
						session_start();
						$_SESSION['id']=$id;
						//echo $_SESSION['id'];
						header("Location: author_dashboard.php");
					}
					
				}
				else 
				{
			?>
			<h2 class="error">Sorry!! User name or Password is not Correct.</h2>

			<?php

				}
			}
			else echo mysqli_error($conn);
		}
		else echo "NOT OK";

	}
	else "dd";

	if(isset($_POST['ed_login']))
	{
		//echo "He";
		$ed_user_name_ok = 0;
		$ed_password_ok = 0;
		if((isset($_POST['ed_user_name'])) && !empty($_POST['ed_user_name']))
		{
			$ed_user_name = $_POST['ed_user_name'];
			$ed_user_name_ok = 1;
		}
		if((isset($_POST['ed_password'])) && !empty($_POST['ed_password']))
		{
			$ed_password = $_POST['ed_password'];
			$ed_password_ok = 1;
		}
		//echo "$ed_user_name_ok $ed_password_ok";
		//echo $au_password_ok; 
		if($ed_user_name_ok && $ed_password_ok)
		{
			//echo "OK";
			$sql = "SELECT * FROM `editors` WHERE `user_name`='$ed_user_name' AND `password`='$ed_password'";
			$query = mysqli_query($conn,$sql);
			if($query)
			{
				$affected_row = mysqli_affected_rows($conn);
				if($affected_row!=0)
				{
						$row = mysqli_fetch_assoc($query);					
						$id=$row['id'];
						$user_name = $row['user_name'];
						$password = $row['password'];					
					if($ed_user_name==$user_name && $ed_password==$password)
					{
						session_destroy();
						session_start();
						$_SESSION['ed_id']=$id;
						//echo $_SESSION['ed_id'];
						header("Location: editors_dashboard.php");
					}
				}
				else 
				{
		?>
		<h2 class="error">Sorry!! User name or Password is not Correct.</h2>

		<?php
				}
			}
			else echo mysqli_error($conn);
		}
		else echo "error";

	}
	//else "dd";


?>
	<div class="author_side">
		<div class="author_side_header">
			<h2>Login as a Author</h2>	
		</div>
		<br><br>
		<div class="author_login_form">			
			<form method="post" action="login.php">
				<label for="au_user_name">User Name : </label><br><br>
				<input type="text" name="au_user_name" id="au_user_name"><br><br>
				<label for="au_password">Password : </label><br><br>
				<input type="password" name="au_password" id="au_password"><br><br>
				<input type="submit" name="au_login" class="btn-orange">				
			</form>
		</div>		
	</div>
	<div class="editor_side">
		<div class="editor_side_header">
			<h2>Login as a Editor</h2>	
		</div>
		<br><br>
		<div class="editor_login_form">
			<form method="post" action="login.php">
				<label for="ed_user_name">User Name : </label><br><br>
				<input type="text" name="ed_user_name" id="ed_user_name"><br><br>
				<label for="ed_password">Password : </label><br><br>
				<input type="password" name="ed_password" id="ed_password"><br><br>
				<input type="submit" name="ed_login" class="btn-orange">				
			</form>
		</div>		
	</div>
</div>

</body>
</html>