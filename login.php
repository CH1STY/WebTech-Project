<?php

session_start();




//FROM REG
	if(isset($_SESSION["RegSuccessful"]))
	{
		if($_SESSION["RegSuccessful"]==1)
		{
			$_SESSION["RegSuccessful"]=0;
			echo '<script>alert("Registration Successful")</script>';
		}
	}
//

if(isset($_SESSION['utype']))
{
	if($_SESSION['utype']=="admin")
	{
		header("location:admin.php");
	}
	if($_SESSION['utype']=="doctor")
	{
		header("location:doctor.php");
	}
	if($_SESSION['utype']=="patient")
	{
		header("location:patient.php");
	}
	if($_SESSION['utype']=="support")
	{
		header("location:support.php");
	}
}

//

require "includes/db_connect.inc.php";

//FIRST TIME OPENING ADMIN CREATION
$sql = "Select * from admin";

$result = mysqli_query($conn,$sql);

if(mysqli_num_rows($result)<1)
{
	date_default_timezone_set('Asia/Dhaka');
	$pass = password_hash("admin", PASSWORD_DEFAULT);
	$today = date('Y-m-d');

	$insert_Query = "INSERT INTO `admin`(`id`, `username`, `name`, `password`, `phone`, `email`, `hiredate`, `address`) VALUES ( NULL , 'admin', 'admin','".$pass."','00000000000','admin@admin.com','".$today."','admin' )";

	mysqli_query($conn,$insert_Query);
}

//---------------------------

$username = $userpass ='';

$errorFlag=0;


if($_SERVER["REQUEST_METHOD"]=="POST"){

	$found = 0;
	$errorFlag=0;
	$username =  mysqli_real_escape_string($conn, $_POST['u_name']);
	$userpass =  mysqli_real_escape_string($conn, $_POST['u_pass']);

	if(empty($username) || empty($userpass))
	{

		$errorFlag =1;

	}
	else
	{

		$sql = "Select *from admin where username='".$username."' ;";
		$result = mysqli_query($conn,$sql);

		if ($row=mysqli_fetch_assoc($result))
		{

				 if (is_null($row["username"]))
				 {

				 }
				 else
				 {
				 	if(!password_verify($userpass, $row['password']))
				 	{
				 		$errorFlag = 1;
				 	}
				 	else if(is_null($row['resignDate']))
				 	{
				 		
					 	$_SESSION['userid']= $row["id"];
					 	$_SESSION['username'] = $row["username"];
					 	$_SESSION['utype'] = "admin";

					 	header("Location:admin.php"); 

				 	}
				 	else
				 	{
				 		$errorFlag=2;
				 	}

				 	 
				 }

		}

		$sql = "Select *from doctor where username='".$username."';";

		$result = mysqli_query($conn,$sql);

		if ($row=mysqli_fetch_assoc($result)){

				 if (is_null($row["username"]))
				 {
				 	
				 }
				 else
				 {

				 	if(!password_verify($userpass, $row['password']))
				 	{
				 		$errorFlag = 1;
				 	}
				 	else if(is_null($row['resignDate']))
				 	{
				 		
					 	$_SESSION['userid']= $row["id"];
					 	$_SESSION['username'] = $row["username"];
					 	$_SESSION['utype'] = "doctor";

					 	header("Location:doctor.php"); 

				 	}
				 	else
				 	{
				 		$errorFlag=2;
				 	}

				 }

		}

		$sql = "Select *from patient where username='".$username."';";

		$result = mysqli_query($conn,$sql);

		if ($row=mysqli_fetch_assoc($result)){

				 if (is_null($row["username"]))
				 {
				 
				 }
				 else
				 {
				 	if(!password_verify($userpass, $row['password']))
				 	{
				 		$errorFlag = 1;
				 	}
				 	else if(is_null($row['resignDate']))
				 	{
				 		
					 	$_SESSION['userid']= $row["id"];
					 	$_SESSION['username'] = $row["username"];
					 	$_SESSION['utype'] = "patient";

					 	header("Location:patient.php"); 

				 	}
				 	else
				 	{
				 		$errorFlag=2;
				 	} 
				 }

		}

		$sql = "Select *from support where username='".$username."';";

		$result = mysqli_query($conn,$sql);

		if ($row=mysqli_fetch_assoc($result)){

				 if (is_null($row["username"]))
				 {
				 	
				 }
				 else
				 {
				 	if(!password_verify($userpass, $row['password']))
				 	{
				 		$errorFlag = 1;
				 	}
				 	else if(is_null($row['resignDate']))
				 	{
				 		
					 	$_SESSION['userid']= $row["id"];
					 	$_SESSION['username'] = $row["username"];
					 	$_SESSION['utype'] = "support";

					 	header("Location:support.php"); 

				 	}
				 	else
				 	{
				 		$errorFlag=2;
				 	} 
				 }

		}
		if($errorFlag!=2)
		{
		$errorFlag = 1;
		}
	}



}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="shortcut icon" href="" type=""> 
	<title>Login</title>

<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- ---fonts S--- -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet"> 
<!-- ---fonts E--- -->

<link rel="stylesheet" type="text/css" href="StyleSheet/login.css">
<link rel="stylesheet" type="text/css" href="StyleSheet/common.css">
</head>


<body>

	<a href="index.php"><img class="logo" src="skins/logo2.png"></a>

	<section class="container">
		
		

		<h1>Login</h1>

		<form id="login_form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">

			<input class="inputField" type="text" name="u_name" placeholder="Username" required>
			<input class="inputField" type="password" name="u_pass" placeholder="Password" required>
			<input class="submit_btn" type="Submit" name="" value="Sign In">
			<?php

			if($errorFlag==1)
			{
			echo "<script type=\"text/javascript\">alert(\"Login Credentials Error\");</script>";
			$errorFlag = 0; 
			}

			if($errorFlag==2)
			{
			echo "<script type=\"text/javascript\">alert(\"Resigned User Can Not Login Contact Admin\");</script>";
			$errorFlag = 0; 
			}	
	
			?>
		</form>
	</section>

	<div class="divReg">

		<p>Don't have an account yet ?</p>
		<a href="patient_register.php"><button style="margin-top: 10px;" class="common_btn">Register as Patient</button></a>

	</div>

</body>
</html>