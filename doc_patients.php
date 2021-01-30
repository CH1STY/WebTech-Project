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


$sql_table = "select DISTINCT patientId from appointments where doctorId = '".$_SESSION['userid']."' ORDER BY dateTime DESC;";
$result = mysqli_query($conn, $sql_table);

if($_SERVER["REQUEST_METHOD"]=="POST")
{
  
  if(isset($_POST['logOut']))
  {
    session_destroy();
    header("location:login.php");
  }
  if(isset($_POST['ViewFile']))
      {

        setcookie('patientId',$_POST['ViewFile'],time()+3600 );

        header("location:viewPatientFiles.php");
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
<link rel="stylesheet" type="text/css" href="StyleSheet/table.css">
</head>


<body>

	<?php include 'includes/leftNav_doc.php'; ?>

	<!-- -------------------------------------------------------------- -->

	<section id="board">

		<h1 class="header">My Patients</h1>
		

		<table class="blueTable">
            <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Date of Birth</th>
                <th>Address</th>
                <th>Contact</th>
                <th>Email</th>
                <th>FILES</th>
              </tr>
            </thead>
            <tbody>
              <?php
              
              while($row = mysqli_fetch_assoc($result))
              {
              	echo "<tr>";
              	$innerQuery = "Select DISTINCT * from patient where id =".$row['patientId'].";";
              	$patientResult = mysqli_query($conn, $innerQuery);
              	if($row2=mysqli_fetch_assoc($patientResult))
              	{
              		echo "<td>".$row2['id']."</td>";
              		echo "<td>".$row2['Name']."</td>";
              		echo "<td>".$row2['dateOfBirth']."</td>";
              		echo "<td>".$row2['address']."</td>";
              		echo "<td>".$row2['phone']."</td>";
              		echo "<td>".$row2['email']."</td>";

                  echo "<td style=\"color: red;\"><form method=\"post\"><button type=\"submit\" name=\"ViewFile\" value=\"".$row2['id']."\">View Files</button></form></td>";
              	}

              	echo "</tr>";
              }

              
               ?>
            </tbody>
          </table>


	</section>

	<script type="text/javascript">
		function lead(id)
		{
			alert(id);
		}
	</script>

	

</body>
</html>