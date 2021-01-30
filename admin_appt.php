<?php

session_start();

//--- SESSION VALIDATION---\\


if(!isset($_SESSION['utype']))
  {
  header("location:login.php"); 
  }
  
  else
  {
    if($_SESSION['utype']!="admin"){
      header("location:login.php");
    }
    else
    {
      
    }
}

//--- SESSION VALIDATION---\\


require "includes/db_connect.inc.php";

$sql_table = "select * from appointments ORDER BY dateTime DESC ";
$result = mysqli_query($conn, $sql_table);


if($_SERVER["REQUEST_METHOD"]=="POST")
  {

    if(isset($_POST['logOut']))
    {
      session_destroy();
      header("location:login.php");
    }
    else{
        if (isset($_POST['cancel'])) {
              $sql = "UPDATE `appointments` SET `status` = '5' WHERE `appointments`.`id` = ".$_POST['cancel'].";";
              mysqli_query($conn,$sql);
              //header("Refresh:0");
          }
          elseif (isset($_POST['accept'])) {
              $sql = "UPDATE `appointments` SET `status` = '1' WHERE `appointments`.`id` = ".$_POST['accept'].";";
              mysqli_query($conn,$sql);
              //header("Refresh:0");
          }

    }
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="shortcut icon" href="" type=""> 
	<title>Admin Panel</title>

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

	<?php include 'includes/leftNav_admin.php'; ?>

	<!-- -------------------------------------------------------------- -->

	<section id="board">

		<h1 class="header">ALL APPOINTMENTS</h1>
		
    <h2 class="header"> Pending Appointments</h2>
             

    <table class ="blueTable">
            <thead>
              <tr>
                <th>ID</th>
                <th>Appointment Information</th>
                <th>Date & Time</th>
                <th>Patient Name</th>
                <th>Doctor Name</th>
                <th>Status</th>
                <th>Action</th>

              
              </tr>
            </thead>
            <tbody>
              <?php 
                $result = mysqli_query($conn, $sql_table);
                while($row = mysqli_fetch_assoc($result))
                {
                  if($row['status']==0){
                  echo "<tr>";

                  echo "<td>".$row['id']."</td>";
                  echo "<td>".$row['appointment_query']."</td>";

                  echo "<td>".$row['dateTime']."</td>";

                  $innerQuery = "Select name from patient where id ='".$row['patientId']."';";
                  $innerQueryRes = mysqli_query($conn,$innerQuery );

                  if($res = mysqli_fetch_assoc($innerQueryRes))
                  {
                    echo "<td>".$res['name']."</td>";
                  }

                  $innerQuery = "Select name from doctor where id ='".$row['doctorId']."';";
                  $innerQueryRes = mysqli_query($conn,$innerQuery );

                  if($res = mysqli_fetch_assoc($innerQueryRes))
                  {
                    echo "<td>".$res['name']."</td>";
                  }

                  echo "<td>Pending</td>";

                  echo "<td><form method=\"post\"><button type=\"submit\" name=\"cancel\" value=\"".$row['id']."\">Cancel</button>
                     <button type=\"submit\" name=\"accept\" value=\"".$row['id']."\">Accept</button>
                    </form>                          
                          </td>";


                 
                  echo "</tr>";
                }
                }

              ?>
            </tbody>
          </table>
		

    <h2 class="header">Doctor Requested to Cancel</h2>

    <table class ="blueTable">
            <thead>
              <tr>
                <th>ID</th>
                <th>Appointment Information</th>
                <th>Date & Time</th>
                <th>Patient Name</th>
                <th>Doctor Name</th>
                <th>Status</th>
                <th>Action</th>
              
              </tr>
            </thead>
            <tbody>
              <?php 
                $result = mysqli_query($conn, $sql_table);
                while($row = mysqli_fetch_assoc($result))
                {
                  if($row['status']==3){
                  echo "<tr>";

                  echo "<td>".$row['id']."</td>";
                  echo "<td>".$row['appointment_query']."</td>";

                  echo "<td>".$row['dateTime']."</td>";

                  $innerQuery = "Select name from patient where id ='".$row['patientId']."';";
                  $innerQueryRes = mysqli_query($conn,$innerQuery );

                  if($res = mysqli_fetch_assoc($innerQueryRes))
                  {
                    echo "<td>".$res['name']."</td>";
                  }

                  $innerQuery = "Select name from doctor where id ='".$row['doctorId']."';";
                  $innerQueryRes = mysqli_query($conn,$innerQuery );

                  if($res = mysqli_fetch_assoc($innerQueryRes))
                  {
                    echo "<td>".$res['name']."</td>";
                  }

                  echo "<td>Doctor Requested To Cancel</td>";

                  echo "<td><form method=\"post\"><button type=\"submit\" name=\"cancel\" value=\"".$row['id']."\">Agree</button>
                     <button type=\"submit\" name=\"accept\" value=\"".$row['id']."\">Deny</button>
                    </form>                          
                          </td>";

                  

                  echo "</tr>";
                }
                }

              ?>
            </tbody>
          </table>

    <h2 class="header">Patient Requested to Cancel</h2>

    <table class ="blueTable">
            <thead>
              <tr>
                <th>ID</th>
                <th>Appointment Information</th>
                <th>Date & Time</th>
                <th>Patient Name</th>
                <th>Doctor Name</th>
                <th>Status</th>
                <th>Action</th>
              
              </tr>
            </thead>
            <tbody>
              <?php 
                $result = mysqli_query($conn, $sql_table);
                while($row = mysqli_fetch_assoc($result))
                {
                  if($row['status']==4){
                  echo "<tr>";

                  echo "<td>".$row['id']."</td>";
                  echo "<td>".$row['appointment_query']."</td>";

                  echo "<td>".$row['dateTime']."</td>";

                  $innerQuery = "Select name from patient where id ='".$row['patientId']."';";
                  $innerQueryRes = mysqli_query($conn,$innerQuery );

                  if($res = mysqli_fetch_assoc($innerQueryRes))
                  {
                    echo "<td>".$res['name']."</td>";
                  }

                  $innerQuery = "Select name from doctor where id ='".$row['doctorId']."';";
                  $innerQueryRes = mysqli_query($conn,$innerQuery );

                  if($res = mysqli_fetch_assoc($innerQueryRes))
                  {
                    echo "<td>".$res['name']."</td>";
                  }


                  echo "<td>Patient Requested To Cancel</td>";

                  echo "<td><form method=\"post\"><button type=\"submit\" name=\"cancel\" value=\"".$row['id']."\">Agree</button>
                     <button type=\"submit\" name=\"accept\" value=\"".$row['id']."\">Deny</button>
                    </form>                          
                          </td>";

                  

                  echo "</tr>";
                }
                }

              ?>
            </tbody>
          </table>

          <h2 class="header">Accepted</h2>

         <table class ="blueTable">
            <thead>
              <tr>
                <th>ID</th>
                <th>Appointment Information</th>
                <th>Date & Time</th>
                <th>Patient Name</th>
                <th>Doctor Name</th>
                <th>Status</th>
                <th>Action</th>
              
              </tr>
            </thead>
            <tbody>
              <?php 
                $result = mysqli_query($conn, $sql_table);
                while($row = mysqli_fetch_assoc($result))
                {
                  if($row['status']==1){
                  echo "<tr>";

                  echo "<td>".$row['id']."</td>";
                  echo "<td>".$row['appointment_query']."</td>";

                  echo "<td>".$row['dateTime']."</td>";

                  $innerQuery = "Select name from patient where id ='".$row['patientId']."';";
                  $innerQueryRes = mysqli_query($conn,$innerQuery );

                  if($res = mysqli_fetch_assoc($innerQueryRes))
                  {
                    echo "<td>".$res['name']."</td>";
                  }

                  $innerQuery = "Select name from doctor where id ='".$row['doctorId']."';";
                  $innerQueryRes = mysqli_query($conn,$innerQuery );

                  if($res = mysqli_fetch_assoc($innerQueryRes))
                  {
                    echo "<td>".$res['name']."</td>";
                  }

                  echo "<td>Accepted Waiting for visit</td>";

                  echo "<td><form method=\"post\"><button type=\"submit\" name=\"cancel\" value=\"".$row['id']."\">Cancel</button>
                     
                    </form>                          
                          </td>";

                  

                  echo "</tr>";
                }
                }

              ?>
            </tbody>
          </table>

        <h2 class="header">Completed</h2>

         <table class ="blueTable">
            <thead>
              <tr>
                <th>ID</th>
                <th>Appointment Information</th>
                <th>Date & Time</th>
                <th>Patient Name</th>
                <th>Doctor Name</th>
                <th>Status</th>
                <th>Action</th>
              
              </tr>
            </thead>
            <tbody>
              <?php 
                $result = mysqli_query($conn, $sql_table);
                while($row = mysqli_fetch_assoc($result))
                {
                  if($row['status']==2){
                  echo "<tr>";

                  echo "<td>".$row['id']."</td>";
                  echo "<td>".$row['appointment_query']."</td>";

                  echo "<td>".$row['dateTime']."</td>";

                  $innerQuery = "Select name from patient where id ='".$row['patientId']."';";
                  $innerQueryRes = mysqli_query($conn,$innerQuery );

                  if($res = mysqli_fetch_assoc($innerQueryRes))
                  {
                    echo "<td>".$res['name']."</td>";
                  }

                  $innerQuery = "Select name from doctor where id ='".$row['doctorId']."';";
                  $innerQueryRes = mysqli_query($conn,$innerQuery );

                  if($res = mysqli_fetch_assoc($innerQueryRes))
                  {
                    echo "<td>".$res['name']."</td>";
                  }

                  echo "<td>Appointment Done (Confirmed By Doctor)</td>";

                  echo "<td>No Action Available</td>";
                  echo "</tr>";
                }
                }

              ?>
            </tbody>
          </table>

          <h2 class="header">Canceled</h2>

         <table class ="blueTable">
            <thead>
              <tr>
                <th>ID</th>
                <th>Appointment Information</th>
                <th>Date & Time</th>
                <th>Patient Name</th>
                <th>Doctor Name</th>
                <th>Status</th>
                <th>Action</th>
              
              </tr>
            </thead>
            <tbody>
              <?php 
                $result = mysqli_query($conn, $sql_table);
                while($row = mysqli_fetch_assoc($result))
                {
                  if($row['status']==5){
                  echo "<tr>";

                  echo "<td>".$row['id']."</td>";
                  echo "<td>".$row['appointment_query']."</td>";

                  echo "<td>".$row['dateTime']."</td>";

                  $innerQuery = "Select name from patient where id ='".$row['patientId']."';";
                  $innerQueryRes = mysqli_query($conn,$innerQuery );

                  if($res = mysqli_fetch_assoc($innerQueryRes))
                  {
                    echo "<td>".$res['name']."</td>";
                  }

                  $innerQuery = "Select name from doctor where id ='".$row['doctorId']."';";
                  $innerQueryRes = mysqli_query($conn,$innerQuery );

                  if($res = mysqli_fetch_assoc($innerQueryRes))
                  {
                    echo "<td>".$res['name']."</td>";
                  }

                  echo "<td>Appointment Canceled</td>";

                  echo "<td>No Action Available</td>";
                  echo "</tr>";
                }
                }

              ?>
            </tbody>
          </table>

		<h1><br>------------------------------------------------</h1>


	</section>
	 

</body>
</html>