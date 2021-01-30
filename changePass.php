<?php

session_start();

require "includes/db_connect.inc.php";

//--- SESSION VALIDATION---\\


if(!isset($_SESSION['utype']))
  {
  	header("location:login.php"); 
  }

//--- SESSION VALIDATION---\\



$realPass = $hash = '';
$old_pass = $new_pass = $re_pass ='';
$error_oldPass = $error_newPass = $error_rePass = '';

if($_SERVER["REQUEST_METHOD"]=="POST")
{
	if(isset($_POST['logOut']))
	{

		session_destroy();
		header("location:login.php");
	}
	else
	{
		$emptyFlag = 0;

		$old_pass = mysqli_real_escape_string($conn, $_POST['old_pass']);
		$new_pass = mysqli_real_escape_string($conn, $_POST['new_pass']);
		$re_pass = mysqli_real_escape_string($conn, $_POST['re_pass']);


		if(empty($_POST['old_pass']))
		{
			$error_oldPass = "Cannot be Empty !"; $emptyFlag = 1;
		}
		if(empty($_POST['new_pass']))
		{
			$error_newPass = "Cannot be Empty !"; $emptyFlag = 1;
		}
		if(empty($_POST['re_pass']))
		{
			$error_rePass = "Cannot be Empty !"; $emptyFlag = 1;
		}




		if ($emptyFlag==0) 
		{

////////////////////////////////////////////////////////admin

			if ($_SESSION['utype']=='admin') 
			{

				if ($new_pass != $re_pass) 
				{
					$error_rePass = "New Password does not match";
				}
				else
				{
					$sql_realPass = "SELECT * FROM admin where id = ".$_SESSION['userid']." ";
					$result_realPass = mysqli_query($conn,$sql_realPass);

					while($row = mysqli_fetch_assoc($result_realPass)) 
					{	
						if(password_verify($old_pass, $row['password']))
						{
							$hash = password_hash($new_pass, PASSWORD_DEFAULT);

							$sql_update = "UPDATE `admin` SET `password`='".$hash."' WHERE id = ".$_SESSION['userid']." ";
							mysqli_query($conn,$sql_update);

							header("location:admin_profile.php");
						}
						else
						{
							$error_oldPass = "Old Password does not match";
						}

							
					}
				}
			}

			////////////////////////////////////////////////////////doctor

			if ($_SESSION['utype']=='doctor') 
			{

				if ($new_pass != $re_pass) 
				{
					$error_rePass = "New Password does not match";
				}
				else
				{
					$sql_realPass = "SELECT * FROM doctor where id = ".$_SESSION['userid']." ";
					$result_realPass = mysqli_query($conn,$sql_realPass);

					while($row = mysqli_fetch_assoc($result_realPass)) 
					{	
						if(password_verify($old_pass, $row['password']))
						{
							$hash = password_hash($new_pass, PASSWORD_DEFAULT);

							$sql_update = "UPDATE `doctor` SET `password`='".$hash."' WHERE id = ".$_SESSION['userid']." ";
							mysqli_query($conn,$sql_update);

							header("location:doc_profile.php");
						}
						else
						{
							$error_oldPass = "Old Password does not match";
						}

							
					}
				}
			}

			////////////////////////////////////////////////////////patient

			if ($_SESSION['utype']=='patient') 
			{

				if ($new_pass != $re_pass) 
				{
					$error_rePass = "New Password does not match";
				}
				else
				{
					$sql_realPass = "SELECT * FROM patient where id = ".$_SESSION['userid']." ";
					$result_realPass = mysqli_query($conn,$sql_realPass);

					while($row = mysqli_fetch_assoc($result_realPass)) 
					{	
						if(password_verify($old_pass, $row['password']))
						{
							$hash = password_hash($new_pass, PASSWORD_DEFAULT);

							$sql_update = "UPDATE `patient` SET `password`='".$hash."' WHERE id = ".$_SESSION['userid']." ";
							mysqli_query($conn,$sql_update);

							header("location:pat_profile.php");
						}
						else
						{
							$error_oldPass = "Old Password does not match";
						}

							
					}
				}
			}

			////////////////////////////////////////////////////////support

			if ($_SESSION['utype']=='support') 
			{

				if ($new_pass != $re_pass) 
				{
					$error_rePass = "New Password does not match";
				}
				else
				{
					$sql_realPass = "SELECT * FROM support where id = ".$_SESSION['userid']." ";
					$result_realPass = mysqli_query($conn,$sql_realPass);

					while($row = mysqli_fetch_assoc($result_realPass)) 
					{	
						if(password_verify($old_pass, $row['password']))
						{
							$hash = password_hash($new_pass, PASSWORD_DEFAULT);

							$sql_update = "UPDATE `support` SET `password`='".$hash."' WHERE id = ".$_SESSION['userid']." ";
							mysqli_query($conn,$sql_update);

							header("location:support_profile.php");
						}
						else
						{
							$error_oldPass = "Old Password does not match";
						}

							
					}
				}
			}


///////////////////////////////////////////////////////			
		}
	}

	
}




?>

<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="shortcut icon" href="" type=""> 
	<title>Change Password</title>

<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- ---fonts S--- -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet"> 
<!-- ---fonts E--- -->

<link rel="stylesheet" type="text/css" href="StyleSheet/panel.css">
<link rel="stylesheet" type="text/css" href="StyleSheet/changePass.css">
<link rel="stylesheet" type="text/css" href="StyleSheet/common.css">
</head>


<body>

	<?php

		if($_SESSION['utype']=="admin")
		{
			include 'includes/leftNav_admin.php';
		}
		else if($_SESSION['utype']=="doctor")
		{
			include 'includes/leftNav_doc.php';
		}
		else if($_SESSION['utype']=="patient")
		{
			include 'includes/leftNav_patient.php';
		}
		else if($_SESSION['utype']=="support")
		{
			include 'includes/leftNav_support.php';
		}

		?>

	<div id="board">

		<h1 class="header">Change Password</h1>
		
		<form method="POST">

			<p class="common_label">Old Password</p>
			<input class="common_inputField" type="password" name="old_pass" value="<?php echo $old_pass; ?>">
			<span class="errorMsg"><?php echo $error_oldPass; ?></span>

			<p class="common_label">New Password</p>
			<input class="common_inputField" type="password" name="new_pass" value="<?php echo $new_pass; ?>">
			<span class="errorMsg"><?php echo $error_newPass; ?></span>

			<p class="common_label">Re-Type Password</p>
			<input class="common_inputField" type="password" name="re_pass" value="<?php echo $re_pass; ?>">
			<span class="errorMsg"><?php echo $error_rePass; ?></span>

			<br><input style="margin-top: 50px;" class="common_btn" type="submit" name="save" value="SAVE">
			
		</form>

	</div>





</body>
</html>