<?php

session_start();

$_SESSION['username'] ="Example";

if(!isset($_SESSION['utype'])){
	header("location:login.php");
}
else{
	if($_SESSION['utype']=="patient"){
		
		header("location:pat_profile.php");
	}
	else
	{
		header("location:login.php");
	}
}




?>

