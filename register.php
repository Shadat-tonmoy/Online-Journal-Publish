<?php
	include 'header.php';
	include 'conn.php';
	
?>
<!DOCTYPE html>
<html>
<head>
	<title>Signup</title>
</head>
<body>
<div class="main_div" style="height: 140vh">
<?php
	if(isset($_POST['reg_submit']))
	{
		$full_name = "";
		$user_name = "";
		$email = "";
		$inst = "";
		$signup = 1;
		$password="";
		$password_rpt="";
		if((isset($_POST['reg_full_name']) && !empty($_POST['reg_full_name'])))
		{
			$full_name = $_POST['reg_full_name'];
			//$signup=1;

		}
		else $signup=0;
		if((isset($_POST['reg_email']) && !empty($_POST['reg_email'])))
		{
			$email = $_POST['reg_email'];
			//$signup=1;
		}
		else $signup=0;
		if((isset($_POST['reg_password']) && !empty($_POST['reg_password'])))
		{

			$password = $_POST['reg_password'];
			//$signup=1;

		}
		else $signup=0;
		if((isset($_POST['reg_password_rpt']) && !empty($_POST['reg_password_rpt'])))
		{

			$password_rpt = $_POST['reg_password_rpt'];
			//$signup=1;

		}
		else $signup=0;
		if((isset($_POST['reg_inst']) && !empty($_POST['reg_inst'])))
		{

			$inst = $_POST['reg_inst'];
			//$signup=1;

		}
		else $signup=0;
		if((isset($_POST['reg_user_name']) && !empty($_POST['reg_user_name'])))
		{			
			$user_name = $_POST['reg_user_name'];
			//$signup=1;
		}
		else {
			$signup=0;
		?>
		<h2 class="error">Please Fill all the Form</h2>
		<?php
		}	
		if($password!=$password_rpt)
		{
			$signup=0;
			echo "<h2 class='error'>Your Password Didn't Matched</h2>";
			
		}
		if($signup==1)
		{
			$reg_sql = "INSERT INTO `user_data` (`full_name`,`user_name`,`password`,`email`,`inst`) VALUES ('$full_name','$user_name','$password','$email','$inst')";
			$reg_query = mysqli_query($conn,$reg_sql);
			if($reg_query)
			{
				echo "<h2 class='success'>Your Have Successfull Signed UP<h2>";
			}
			else echo mysqli_error($conn);
		}
	}






?>
<div class="signup_form">
	<h2 class="signup_header">Fill in the form to sign up</h2>
	<form method="post" action="register.php">
		<label for="reg_full_name">Full Name : </label><br><br>
		<input type="text" name="reg_full_name" id="reg_full_name" value=<?php if(isset($_POST['reg_full_name'])) echo $full_name?> ><br><br>
		<label for="reg_user_name">User Name : </label><br><br>
		<input type="text" name="reg_user_name" id="reg_user_name" value=<?php if(isset($_POST['reg_user_name'])) echo $user_name?>><br><br>

		<label for="reg_email">Email : </label> <br><br>
		<input type="email" name="reg_email" id="reg_email" value=<?php if(isset($_POST['reg_email'])) echo $email?>><br><br>
		<label for="reg_password">Password : </label><br><br>
		<input type="password" name="reg_password" id="reg_password"><br><br>
		<label for="reg_password_rpt">Password Repeat : </label><br><br>
		<input type="password" name="reg_password_rpt" id="reg_password_rpt"><br><br>
		<label for="reg_inst">Institurion Name : </label> <br><br>
		<input type="text" name="reg_inst" id="reg_inst" value=<?php if(isset($_POST['reg_inst'])) echo $inst?>><br><br>
		<input type="submit" name="reg_submit" value="Sign Up" class="btn-green">
		<input type="reset" name="reset" class="btn-red" value="Reset All Field">

		
	</form>
	
</div>
</div>

</body>
</html>