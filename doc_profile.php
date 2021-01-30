<?php

session_start();


//--- SESSION VALIDATION---\\


if(!isset($_SESSION['utype']))
  {
  header("location:login.php"); 
  }
  
  else
  {
    if($_SESSION['utype']!="doctor"){
      header("location:login.php");
    }
    else
    {
      
    }
}

//--- SESSION VALIDATION---\\

require "includes/db_connect.inc.php";
require "includes/validation.php";



$id = $username = $name = $age = $spec = $phone = $address = $mail = $details = '';

$sql_name= "select * from doctor where ID = ".$_SESSION['userid']." ";
$result= mysqli_query($conn, $sql_name);


while($row = $result->fetch_assoc()) 
{	
	$id= $row["id"];
	$username = $row["username"];
	$name= $row["Name"];
	$spec= $row["Speciality"];
	$phone= $row["phone"];
	$mail= $row["email"];
	$address = $row['Address'];
	$details = $row['Details'];
}

if($_SERVER["REQUEST_METHOD"]=="POST")
{
	
	if(isset($_POST['logOut']))
	{
		session_destroy();
		header("location:login.php");
	}
	else{
		$name = mysqli_real_escape_string($conn,$_POST['u_name']);
		$spec = mysqli_real_escape_string($conn,$_POST['u_spec']);
		$phone =mysqli_real_escape_string($conn,$_POST['u_phone']);
		$address =mysqli_real_escape_string($conn,$_POST['u_address']);
		$details = mysqli_real_escape_string($conn,$_POST['details']);


		$flag=0;

		if(!validate_name($name))
		{
			$flag=1;
		}

		if(!validate_phone($phone))
		{
			$flag=1;
		}

		if(!validate_name($spec))
		{
			$flag=1;
		}


		if($flag==0){
			$sql_update = "UPDATE doctor SET `name`='".$name."',`Speciality`='".$spec."',`phone`='".$phone."',`address`='".$address."' WHERE ID = ".$_SESSION['userid']." ";
			mysqli_query($conn, $sql_update);
			header("Refresh:0");
		}
		else{
			echo "<script>alert(\"Invalid Input\");</script>";
			header("Refresh:0");
		}
	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="shortcut icon" href="" type=""> 
	<title>Doctor Panel</title>

<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- ---fonts S--- -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet"> 
<!-- ---fonts E--- -->

<link rel="stylesheet" type="text/css" href="StyleSheet/leftNav.css">
<link rel="stylesheet" type="text/css" href="StyleSheet/footer.css">
<link rel="stylesheet" type="text/css" href="StyleSheet/panel.css">
<link rel="stylesheet" type="text/css" href="StyleSheet/common.css">
</head>


<body>

	<?php include 'includes/leftNav_doc.php'; ?>

	<!-- -------------------------------------------------------------- -->

	<section id="board">

		<h1 class="header">My Profile</h1>
		<button class="add_btn" onclick="edit()">Edit</button>

		<form action="doc_profile.php" method="POST">

		<div style="margin-top: 50px">
			<p class="common_label">ID</p>
			<input class="common_inputField" type="text" name="u_id" value="<?php echo $id; ?>" readonly>
		</div>
		<div>
			<p class="common_label">Username</p>
			<input class="common_inputField" type="text" name="user_name" value="<?php echo $username; ?>" readonly>
		</div>
		<div>
			<p class="common_label">Full Name</p>
			<input class="info common_inputField" type="text" name="u_name" value="<?php echo $name; ?>" readonly>
		</div>
		<div>
			<p class="common_label">Speciality</p>
			<input class="info common_inputField" type="text" name="u_spec" value="<?php echo $spec; ?>" readonly>
		</div>

		<div>
			<p class="common_label">Details</p>
			<textarea class="info common_inputField" style="resize: none;" type="text" name="details"  rows="2" cols="65" readonly><?php echo $details; ?></textarea>
		</div>


		<div>
			<p class="common_label">Phone</p>
			<input class="info common_inputField" type="text" name="u_phone" value="<?php echo $phone; ?>" readonly>
		</div>
		<div>
			<p class="common_label">E-mail</p>
			<input class="common_inputField" type="text" name="u_mail" value="<?php echo $mail; ?>" readonly>
		</div>
		<div>
			<p class="common_label">Address</p>
			<input class="info common_inputField" type="text" name="u_address" value="<?php echo $address; ?>" readonly>
		</div>


		<input id="save_btn" class="common_btn" style="display: none; margin-top: 20px;" type="submit" name="save_btn" value="SAVE">
		<br>
	</form>
	 <a href="changePass.php"><button class="common_btn" style="margin-top: 20px; margin-bottom: 60px">Change Password</button></a>
	</section>

	<script>

		function edit()
		{
			var save = document.getElementById("save_btn");
			save.style.display="block";

			// alert("hi");
			var info = document.getElementsByClassName("info");
			for( i=0 ; i < info.length ; i++)
			{
				info[i].readOnly=false;
			}

			
		}
	</script>

</body>
</html>