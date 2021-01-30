<?php

session_start();

//
if(isset($_SESSION['utype']))
{
	if($_SESSION['utype']!='admin')
	{	
		header("location:login.php");
	}
}

//

require "includes/db_connect.inc.php";
require "includes/validation.php";
$username = $fullname = $age = $address = $contact = $mail = $hiredate = $pass = '';
$url ="";

$UserError = $NameError = $AgeError = $AddressError = $ContactError = $MailError = $DateError = $PassError = '';

if($_SERVER["REQUEST_METHOD"] == "POST")
{

	$username = mysqli_real_escape_string($conn, $_POST['username']);
	$fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
	$address = mysqli_real_escape_string($conn, $_POST['address']);
	$contact = mysqli_real_escape_string($conn, $_POST['contact']);
	$mail = mysqli_real_escape_string($conn, $_POST['mail']);
	$hiredate = mysqli_real_escape_string($conn, $_POST['hiredate']);
	$pass = mysqli_real_escape_string($conn, $_POST['pass']);


	if(isset($_POST['cancel']))
	{
		header("location:admin_support.php");
	}
	if(isset($_POST['reg']))
	{
		$url ="#regBtn";	
		$flag=0;

		if(empty($_POST['username']))
		{  	$UserError = "Username cannot be empty!"; $flag=1;  }

		if(empty($_POST['fullname']))
		{  	$NameError = "Fullname cannot be empty!"; $flag=1;  }

		if(empty($_POST['address']))
		{  	$AddressError = "Address cannot be empty!"; $flag=1;  }

		if(empty($_POST['contact']))
		{  	$ContactError = "Contact cannot be empty!"; $flag=1;  }

		if(empty($_POST['mail']))
		{  	$MailError = "E-mail cannot be empty!"; $flag=1;  }

		if(empty($_POST['hiredate']))
		{  	$DateError = "Hiredate cannot be empty!"; $flag=1;  }

		if(empty($_POST['pass']))
		{  	$PassError = "Password cannot be empty!"; $flag=1;  }



		if($flag==0)
		{
			// echo "<script>alert('test msgbox')</script>";

			

			if(!validate_username($username))
			{
				$UserError = "Username Not Available(Minimum 4 Character)!"; $flag=1;
			}
			
			if(!validate_name($fullname))
			{
				$NameError = "Invalid Name!"; $flag=1;
			}
			
			if(!validate_hiredate($hiredate)){

				$DateError = "Hiredate Can Not be In Future"; $flag=1;
			}

			if(!validate_phone($contact))
			{
				
				$ContactError = "Invalid Contact Information"; $flag=1;
			}
			else if(!validate_phone_existence($contact))
			{
				$ContactError = "Phone Number Already Used"; $flag=1;
			}

			if(!validate_email($mail))
			{
				$MailError = "Invalid Email!"; $flag=1;
			}
			else if (!validate_email_existence($mail))
			{
				$MailError = "Email Already used"; $flag=1;
			}
			

			if(!validate_password($pass))
			{
				$PassError = "Minimum Lenght of Password is 4"; $flag=1; 
			}




			if($flag==0)
			{
				// echo $dob;
				$url="";

				$hashedPass = password_hash($pass, PASSWORD_DEFAULT);

				$sql_insert = "INSERT INTO `support`(`username`, `Name`, `password`, `phone`, `email`, `address`, `hiredate`) VALUES ('".$username."','".$fullname."','".$hashedPass."','".$contact."','".$mail."','".$address."','".$hiredate."')";

				if(mysqli_query($conn, $sql_insert)==TRUE);
				{
					
					header("location:admin_support.php");
				}

				


				// if ($conn->query($sql_insert) === TRUE) {
			 //  	echo "Record updated successfully";
				// } else {
				//   echo "Error updating record: " . $conn->error;
				// }

			}
		}
	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="shortcut icon" href="" type=""> 
	<title>Support Registration</title>

<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- ---fonts S--- -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet"> 
<!-- ---fonts E--- -->


<link rel="stylesheet" type="text/css" href="StyleSheet/topNav.css">
<link rel="stylesheet" type="text/css" href="StyleSheet/common.css">
<link rel="stylesheet" type="text/css" href="StyleSheet/reg.css">
</head>


<body>
	<a href="index.php"><img class="logo" src="skins/logo2.png"></a>

	<div class="regTop">
		<!-- <img class="logo" src="skins/logo.png"> -->
		<p class="txt">SUPPORT REGISTRATION</p>
	</div>

	<section class="container">
		
		

		<form  id="reg_form" action="<?php echo $_SERVER['PHP_SELF'].$url ; $url =""; ?>" method="POST">

			<input class="inputField" type="text" name="username" placeholder="Username" value="<?php echo $username ;?>">
			<span class="errorMsg"><?php echo $UserError; ?></span>

			<input class="inputField" type="text" name="fullname" placeholder="Full Name" value="<?php echo $fullname ;?>">
			<span class="errorMsg"><?php echo $NameError; ?></span>

			<textarea class="inputField" style="resize:none;" type="text" name="address" rows="4" cols="65" placeholder="Address" ><?php echo $address ;?></textarea>
			<span class="errorMsg"><?php echo $AddressError; ?></span>

			<input class="inputField" type="text" name="contact" placeholder="Contact" value="<?php echo $contact ;?>">
			<span class="errorMsg"><?php echo $ContactError; ?></span>

			<input class="inputField" type="email" name="mail" placeholder="E-mail" value="<?php echo $mail ;?>">
			<span class="errorMsg"><?php echo $MailError; ?></span>

			<input class="inputField" type="text" onfocus="(this.type='date')" name="hiredate" placeholder="Hiredate"  value="<?php echo $hiredate ;?>">
			<span class="errorMsg"><?php echo $DateError; ?></span>

			<input class="inputField" type="password" name="pass" placeholder="Password" value="<?php echo $pass ;?>">
			<span class="errorMsg"><?php echo $PassError; ?></span>

			<br><input id="regBtn" class="submit_btn" type="Submit" name="reg" value="Register">
			<input id="canBtn" class="cancelBtn" type="Submit" name="cancel" value="Cancel">
		</form>

	</section>

</body>
</html>