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


$sql_table = "select *  from support ORDER BY hiredate DESC;";
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

      if (isset($_POST['Resign'])) {

            date_default_timezone_set('Asia/Dhaka');
            $date = date('Y-m-d');
            $sql = "UPDATE `support` SET `resignDate` = '".$date."' WHERE `id` = ".$_POST['Resign'].";";
            mysqli_query($conn,$sql);
            header("Refresh:0");
        }
        elseif (isset($_POST['Recall'])) {
            $sql = "UPDATE `support` SET `resignDate` = NULL WHERE `id` = ".$_POST['Recall'].";";
            
            mysqli_query($conn,$sql);
            header("Refresh:0");
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

		<h1 class="header">SUPPORTS</h1>
		<a href="support_register.php"><button class="add_btn" >Add new Support</button></a>

		<table class="blueTable">
            <thead>
              <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Address</th>
                <th>HireDate</th>
                <th>ResignDate</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              
              while($row = mysqli_fetch_assoc($result))
              {
              	echo "<tr>";
            
              	{
              		echo "<td>".$row['id']."</td>";
              		echo "<td>".$row['username']."</td>";
              		echo "<td>".$row['Name']."</td>";
              		echo "<td>".$row['phone']."</td>";
              		echo "<td>".$row['email']."</td>";
                  echo "<td>".$row['address']."</td>";
                  echo "<td>".$row['hiredate']."</td>";
                  echo "<td>".$row['resignDate']."</td>";

                  if(is_null($row['resignDate']))
                  {
                   echo "<td><form method=\"post\"><button type=\"submit\" name=\"Resign\" value=\"".$row['id']."\">Resign</button></form>";
                  }
                  else
                  {
                      echo "<td><form method=\"post\"><button type=\"submit\" name=\"Recall\" value=\"".$row['id']."\">Recall</button></form>";
                  }



              	}

              	echo "</tr>";
              }

              
               ?>
            </tbody>
          </table>


	</section>

	

	

</body>
</html>