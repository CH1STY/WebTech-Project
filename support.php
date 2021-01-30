<?php

session_start();

if(!isset($_SESSION['utype'])){
	header("location:login.php");
}
else{
	if($_SESSION['utype']=="support"){
		
		header("location:support_profile.php");
	}
	else
	{
		header("location:login.php");
	}
}

?>

