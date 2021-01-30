<?php

	

	function validate_name($name)
	{
			if(!preg_match('/^[a-z , " ",".",","]*$/i', $name) || $name=="")
			{
					
					return false;
				
			}
			else
			{
					return true;
			}

	}

	function validate_phone($phone)
	{

		if(!preg_match("/^[0-9]{11}$/", $phone) || strlen($phone)!=11)
		{
			
			return false;
		}
		else
		{
			
			return true;
		}

	}


	function validate_phone_existence($phone){

			require "includes/db_connect.inc.php";

			$sql_phone_check_admin = "select * from admin where phone='".$phone."';";
			$sql_phone_check_patient = "select * from patient where phone='".$phone."';";
			$sql_phone_check_doctor = "select * from doctor where phone='".$phone."';";
			$sql_phone_check_support = "select * from support where phone='".$phone."';";


			$sql_phone_result_admin = mysqli_query($conn,$sql_phone_check_admin);
			$sql_phone_result_patient = mysqli_query($conn,$sql_phone_check_patient);
			$sql_phone_result_doctor = mysqli_query($conn,$sql_phone_check_doctor);
			$sql_phone_result_support = mysqli_query($conn,$sql_phone_check_support);


			if(mysqli_num_rows($sql_phone_result_admin)>0){
				return false;
			}
			else if(mysqli_num_rows($sql_phone_result_patient)>0){
				return false;
			}
			else if(mysqli_num_rows($sql_phone_result_doctor)>0){
				return false;
			}
			else if(mysqli_num_rows($sql_phone_result_support)>0){
				return false;
			}
			else
			{
				return true;
			}


	}

	function validate_password($password){

		if(strlen($password)<4)
		{
			return false;
		}
		else
		{
			return true;
		}

	}

	function validate_date($date){
		if(!preg_match("/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/", $date)){

			return false;
		}
		else{

			$year =$date[0].$date[1].$date[2].$date[3];
			$month = $date[5].$date[6];
			$day = $date[8].$date[9];
			if(checkdate($month, $day, $year))
			{	
				return true;
			}
			return false;
		}
	}

	function validate_email($email){

		if(!filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			return false;
		}
		else
		{
			return true;
		}


	}

	function validate_email_existence($email){

			require "includes/db_connect.inc.php";

			$sql_email_check_admin = "select * from admin where email='".$email."';";
			$sql_email_check_patient = "select * from patient where email='".$email."';";
			$sql_email_check_doctor = "select * from doctor where email='".$email."';";
			$sql_email_check_support = "select * from support where email='".$email."';";


			$sql_email_result_admin = mysqli_query($conn,$sql_email_check_admin);
			$sql_email_result_patient = mysqli_query($conn,$sql_email_check_patient);
			$sql_email_result_doctor = mysqli_query($conn,$sql_email_check_doctor);
			$sql_email_result_support = mysqli_query($conn,$sql_email_check_support);


			if(mysqli_num_rows($sql_email_result_admin)>0){
				return false;
			}
			else if(mysqli_num_rows($sql_email_result_patient)>0){
				return false;
			}
			else if(mysqli_num_rows($sql_email_result_doctor)>0){
				return false;
			}
			else if(mysqli_num_rows($sql_email_result_support)>0){
				return false;
			}
			else
			{
				return true;
			}


	}

	function validate_dateOfBirth($dateOfBirth){

		$birthdate = new Datetime($dateOfBirth);
		$today = new Datetime(date('Y-m-d'));

		$diff = $today->diff($birthdate);

		if ($diff->y<14)
		{
			return false;
		}
		else
		{
			return true;
		}
	}

	function validate_hiredate($hiredate){

		date_default_timezone_set('Asia/Dhaka');
		$hiredate = new Datetime($hiredate);
		$today = new Datetime(date('Y-m-d'));

		if($hiredate>$today)
		{
			return false;
		}
		else
		{
			return true;
		}
		
	}

	function validate_appointmentDateTime($dateTime){

		date_default_timezone_set('Asia/Dhaka');


		$dateTime = new Datetime($dateTime);

		$minTimeToSetAppointment = date('Y-m-d H:i:s');

		$minTimeToSetAppointment = new Datetime($minTimeToSetAppointment);

		$minTimeToSetAppointment = $minTimeToSetAppointment->modify('+3 hour');
			
		
		
		if($minTimeToSetAppointment>$dateTime)
		{
			
			return false;

		}
		else
		{

			return true;
		}
	}


	function validate_doctorId($doctorId){
		require "includes/db_connect.inc.php";

		$sql_doctorId_check = "select * from doctor where id='".$doctorId."';";

		$sql_doctorId_result = mysqli_query($conn,$sql_doctorId_check);

		if(mysqli_num_rows($sql_doctorId_result)<1)
		{
				return false;
		}
		else
		{
			return true;
		}


	}

	function validate_username($username){

		

		if(strlen($username)<4){
			return false;
		}
		else{
			require "includes/db_connect.inc.php";

			$sql_username_check_admin = "select * from admin where username='".$username."';";
			$sql_username_check_patient = "select * from patient where username='".$username."';";
			$sql_username_check_doctor = "select * from doctor where username='".$username."';";
			$sql_username_check_support = "select * from support where username='".$username."';";


			$sql_username_result_admin = mysqli_query($conn,$sql_username_check_admin);
			$sql_username_result_patient = mysqli_query($conn,$sql_username_check_patient);
			$sql_username_result_doctor = mysqli_query($conn,$sql_username_check_doctor);
			$sql_username_result_support = mysqli_query($conn,$sql_username_check_support);


			if(mysqli_num_rows($sql_username_result_admin)>0){
				return false;
			}
			else if(mysqli_num_rows($sql_username_result_patient)>0){
				return false;
			}
			else if(mysqli_num_rows($sql_username_result_doctor)>0){
				return false;
			}
			else if(mysqli_num_rows($sql_username_result_support)>0){
				return false;
			}
			else
			{
				return true;
			}
		}

	}


?>