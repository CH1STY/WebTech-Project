<?php

session_start();
if(!isset($_SESSION['utype'])){
	header("location:login.php");
}
else{
	if($_SESSION['utype']=="admin"){
	header("location: admin_profile.php");
	}
	else
	{
		header("location:login.php");
	}
}

?>

