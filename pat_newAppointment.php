<?php

session_start();

//--- SESSION VALIDATION---\\


if(!isset($_SESSION['utype']))
  {
  header("location:login.php"); 
  }
  
  else
  {
    if($_SESSION['utype']!="patient"){
      header("location:login.php");
    }
    else
    {
      
    }
}

//--- SESSION VALIDATION---\\


require "includes/db_connect.inc.php";
require "includes/validation.php";
$docId = $dateTime = $query = '';
$ErrorSelect = $ErrorDateTime = $ErrorQuery = '';

if($_SERVER["REQUEST_METHOD"]=="POST"){

  if(isset($_POST['logOut']))
  {
    session_destroy();
    header("location:login.php");
  }

    //////////////////////////////////////////////////////////////////////

  if(isset($_POST['app_submit']))
  {  

    $flag=0;

    

    $docId = mysqli_real_escape_string($conn, $_POST['doctor']);
	$dateTime = mysqli_real_escape_string($conn, $_POST['dateTime']);
	$query = mysqli_real_escape_string($conn, $_POST['query']);

    if(empty($_POST['doctor']))
    {   $ErrorSelect = "Select a Doctor"; $flag=1;  }
    if(empty($_POST['dateTime']))
    {   $ErrorDateTime = "Select a Date & Time"; $flag=1;  }
    if(empty($_POST['query']))
    {   $ErrorQuery = "Write your query"; $flag=1;  }

	
	if($flag==0){

		if(!validate_doctorId($docId))
		{
			 $ErrorSelect = "INVALID DOCTOR"; $flag=1;
		}
		
		if(!validate_appointmentDateTime($dateTime))
		{
			$ErrorDateTime = "Time Should Be Atleast After 3 Hours From Now"; $flag=1; 
		}



	   if($flag==0)
	    {
	      


	      $sql_appInsert = "INSERT INTO `appointments`(`dateTime`, `appointment_query`, `patientId`, `doctorId`, `status`) VALUES ('".$dateTime."','".$query."',".$_SESSION['userid'].",".$docId.",0)";

	      mysqli_query($conn, $sql_appInsert);

	      $docId = $dateTime = $query = '';
		    $ErrorSelect = $ErrorDateTime = $ErrorQuery = '';

	      $_SESSION['appointmentCreated'] = 'True';
        header("location:pat_appoinments.php");
	    }
	}
  }


  
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="shortcut icon" href="" type=""> 
	<title>Appointment Form</title>

<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- ---fonts S--- -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet"> 
<!-- ---fonts E--- -->

<link rel="stylesheet" type="text/css" href="Stylesheet/leftNav.css">
<link rel="stylesheet" type="text/css" href="Stylesheet/footer.css">
<link rel="stylesheet" type="text/css" href="Stylesheet/panel.css">
<link rel="stylesheet" type="text/css" href="Stylesheet/table.css">
<link rel="stylesheet" type="text/css" href="StyleSheet/reg.css">
<link rel="stylesheet" type="text/css" href="StyleSheet/common.css">



</head>


<body>

	<?php include 'includes/leftNav_patient.php'; ?>

	<!-- -------------------------------------------------------------- -->

	<section id="board">

		<h1 class="header">Make an Appointment</h1>


    <form style="margin-top: 50px;"  id="app_form" action="" method="POST">
      <p class="common_label">Select doctor</p>




      <!-- doc selection dropdown -->
      <select style="display: inline-block;" class="common_inputField" name="doctor" required>

      <option selected value="" disabled>Select</option>

      <?php 
      $result_doc = mysqli_query($conn, "SELECT id, CONCAT(\"Doctor: \",Name, \" -Speciality: \", Speciality) AS doc FROM doctor ORDER BY Speciality");

      while ($row = mysqli_fetch_assoc($result_doc))

        { echo "<option ";
    	  
    	  if($docId==$row['id'])
    	  {
    	  	echo " selected ";

    	  }
          echo "value=\"".$row['id']."\">" . $row['doc'] . "</option>"; } ?>
      </select>

      <a href="doclist.php" target="_blank"><div class="common_btn" style="display: inline-block;margin-left: 50px">
      Check Doctors' Visiting Hours</div></a>

      <br><span class="errorMsg"><?php echo $ErrorSelect; ?></span>

      <!-- dropdown ends -->




      <br><p class="common_label" style="margin-top: 20px;">Select Date & Time [Choosing Inapporopiate Time Will Make the Appointment Invalid]</p>
      <input style="width: 475px;" class="common_inputField" type="datetime-local" name="dateTime" value="<?php echo $dateTime ?>">
      <span class="errorMsg"><?php echo $ErrorDateTime; ?></span>

      <br><p class="common_label">Appointment Query</p>
      <textarea class="common_inputField" style="resize:none;" type="text" name="query" rows="4" cols="65"><?php echo $query ?></textarea>
      <span class="errorMsg"><?php echo $ErrorQuery; ?></span>

      <br><input style="margin-top: 20px;" class="common_btn" type="submit" name="app_submit" value="Submit Request">


    </form>
		

    <!-- <h1><br>------------------------------------------------</h1> -->
	</section>
	

</body>
</html>