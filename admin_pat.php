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


$sql_table = "select * from patient ORDER BY id DESC ;";
$result = mysqli_query($conn, $sql_table);

if($_SERVER["REQUEST_METHOD"]=="POST")
  {
  
  if(isset($_POST['logOut']))
    {

      session_destroy();
      header("location:login.php");
    }
   else 
   {
      if (isset($_POST['Delete'])) 
      {
              
          $sql = "Delete FROM Appointments where patientId ='".$_POST['Delete']."';";

          mysqli_query($conn,$sql);

          $sql = "Delete FROM patient where id ='".$_POST['Delete']."';";

          mysqli_query($conn,$sql);

          $path ="Media/Patient/".$_POST['Delete'];
          try
          {  
            $dirOpener = opendir("Media/Patient/".$_POST['Delete']."/");

            $dirOpener2 = "Media/Patient/".$_POST['Delete'];

            $fi = new FilesystemIterator($dirOpener2, FilesystemIterator::SKIP_DOTS);

            $flag = 0;
            if(iterator_count($fi)==0)
            {
              if(!rmdir($path)) 
              {
                echo "DIRECTORY DOESN'T EXIST";
              }
              else
              {
                $flag =1;
              }

            }
            else
            {
              while(($entry = readdir($dirOpener)) !== false)
              { 
                if($entry !='.' && $entry !='..')
                {
                  unlink("Media/Patient/".$_POST['Delete']."/".$entry);
                }
              }
            }

            if($flag==0)
            {
              if(!rmdir($path)) 
              {
                echo "DIRECTORY DOESN'T EXIST";
              }
            }
          }catch(exception $ex)
          {
            
          }
         header("Refresh:0");

      }
      

      if(isset($_POST['ViewFile']))
      {

        setcookie('patientId',$_POST['ViewFile'],time()+3600 );

        header("location:viewPatientFiles.php");
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

<link rel="stylesheet" type="text/css" href="StyleSheet/leftNav.css">
<link rel="stylesheet" type="text/css" href="StyleSheet/footer.css">
<link rel="stylesheet" type="text/css" href="StyleSheet/panel.css">
<link rel="stylesheet" type="text/css" href="StyleSheet/table.css">
</head>


<body>

	<?php include 'includes/leftNav_admin.php'; ?>

	<!-- -------------------------------------------------------------- -->

	<section id="board">

		<h1 class="header">Patients</h1>
		<a href="patient_register.php"><button class="add_btn">Add A Patient</button></a>

		<table class="blueTable">
            <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Username</th>
                <th>Date of Birth</th>
                <th>Address</th>
                <th>Contact</th>
                <th>Email</th>
                <th>FILES</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              
              while($row = mysqli_fetch_assoc($result))
              {
              	echo "<tr>";
              	
              
              	
              		echo "<td>".$row['id']."</td>";
              		echo "<td>".$row['Name']."</td>";
                  echo "<td>".$row['username']."</td>";
              		echo "<td>".$row['dateOfBirth']."</td>";
              		echo "<td>".$row['address']."</td>";
              		echo "<td>".$row['phone']."</td>";
              		echo "<td>".$row['email']."</td>";
              	 
                  echo "<td style=\"color: red;\"><form method=\"post\"><button type=\"submit\" name=\"ViewFile\" value=\"".$row['id']."\">View Files</button></form></td>";

                  echo "<td style=\"color: red;\"><form method=\"post\"><button type=\"submit\" name=\"Delete\" value=\"".$row['id']."\">Delete</button></form><br>!Warning All Appointments and Files Will Be Deleted Related to This Patient</td>";

              	echo "</tr>";
              }

              
               ?>
            </tbody>
          </table>
  <h1><br>------------------------------------------------</h1>

	</section>

	<script type="text/javascript">
		function lead(id)
		{
			alert(id);
		}
	</script>

	

</body>
</html>