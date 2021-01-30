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


//----IS FROM APPOINTMENT CREATION?

if(isset($_SESSION['appointmentCreated']))
{
  echo '<script>alert("Appointment Request Successful");</script>';
  unset($_SESSION['appointmentCreated']);
}


//---------------------------


require "includes/db_connect.inc.php";


$sql_table = "select * from appointments where patientId = '".$_SESSION['userid']."' ORDER BY dateTime DESC; ";
$result = mysqli_query($conn, $sql_table);


if($_SERVER["REQUEST_METHOD"]=="POST"){

  if(isset($_POST['logOut']))
  {
    session_destroy();
    header("location:login.php");
  }

  if (isset($_POST['cancel'])) {
        $sql = "UPDATE `appointments` SET `status` = '4' WHERE `appointments`.`id` = ".$_POST['cancel'].";";
        mysqli_query($conn,$sql);
        header("Refresh:0");
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

<link rel="stylesheet" type="text/css" href="Stylesheet/leftNav.css">
<link rel="stylesheet" type="text/css" href="Stylesheet/footer.css">
<link rel="stylesheet" type="text/css" href="Stylesheet/panel.css">
<link rel="stylesheet" type="text/css" href="Stylesheet/table.css">



</head>


<body>

	<?php include 'includes/leftNav_patient.php'; ?>

	<!-- -------------------------------------------------------------- -->

	<section id="board">

		<h1 class="header">My Appointments</h1>
		<a href="pat_newAppointment.php"><button class="add_btn" >Create an Appointment</button></a>

		<table class ="blueTable">
            <thead>
              <tr>
                <th>ID</th>
                <th>Appointment Information</th>
                <th>Date</th>
                <th>Doctor Name</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php 

                while($row = mysqli_fetch_assoc($result))
                {
                  echo "<tr>";

                  echo "<td>".$row['id']."</td>";
                  echo "<td>".$row['appointment_query']."</td>";

                  echo "<td>".$row['dateTime']."</td>";

                  $innerQuery = "Select name from doctor where id ='".$row['doctorId']."';";
                  $innerQueryRes = mysqli_query($conn,$innerQuery );

                  if($res = mysqli_fetch_assoc($innerQueryRes))
                  {
                    echo "<td>".$res['name']."</td>";
                  }

                  if($row['status']==0)
                  {
                    echo "<td> Pending </td>";
                  }
                  else if($row['status']==1)
                  {
                    echo "<td> Accepted </td>";
                  }
                  else if($row['status']==2)
                  {
                    echo "<td> Completed </td>";
                  }
                  else if($row['status']==3)
                  {
                    echo "<td> Doctor Requested to Cancel </td>";
                  }
                  else if($row['status']==4)
                  {
                    echo "<td> Patient Requested to Cancel </td>";
                  }

                  else if($row['status']==5)
                  {
                    echo "<td>Canceled</td>";
                  }


                  if($row['status']==1)
                  {
                    echo "<td><form method=\"post\"><button type=\"submit\" name=\"cancel\" value=\"".$row['id']."\">Cancel</button>
                    </form>                          
                          </td>";
                    
                  }
                  else
                  {
                    echo "<td> NO ACTION AVAILABLE </td>";
                  }

                  echo "</tr>";
                }

              ?>
            </tbody>
          </table>

      <h1><br>------------------------------------------------</h1>
	</section>
	

</body>
</html>