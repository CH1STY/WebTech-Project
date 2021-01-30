<?php

session_start();

if(!isset($_SESSION['utype'])){
	header("location:login.php");
}
else{
	if($_SESSION['utype']=="doctor"){
		
		header("location:doc_profile.php");
	}
	else
	{
		header("location:login.php");
	}
}

?>

