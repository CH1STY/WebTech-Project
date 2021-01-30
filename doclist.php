<?php

session_start();
require "includes/db_connect.inc.php";

$sql_table = "Select Name,phone,visitingHour,email,speciality,details from doctor ORDER BY hireDate DESC";
$result = mysqli_query($conn, $sql_table);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="shortcut icon" href="" type=""> 
	<title>CMS</title>

<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- ---fonts S--- -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet"> 
<!-- ---fonts E--- -->

<link rel="stylesheet" type="text/css" href="StyleSheet/topNav.css">
<link rel="stylesheet" type="text/css" href="StyleSheet/footer.css">
<link rel="stylesheet" type="text/css" href="StyleSheet/common.css">
<link rel="stylesheet" type="text/css" href="StyleSheet/table.css">
</head>


<body>

	<?php 


		if(isset($_SESSION["userid"]) && isset($_SESSION["username"]))
		{
			include 'includes/homeTopNavIfLoggedIn.php'; 
		}
		else
		{
			include 'includes/homeTopNav.php';
		}

	?>

	<section class="common_container">
		<table style="margin-top: 50px" class="blueTable">
	            <thead>
	              <tr>
	                <th>Name</th>
	                <th>Speciality</th>
	                <th>Details</th>
	                <th>Contact</th>
	                <th>E-mail</th>
	                <th>Visiting Hours</th>
	              </tr>
	            </thead>
	            <tbody>
	              <?php while($row = mysqli_fetch_assoc($result)) { ?>
	              		<tr>
		                  <td><?php echo $row['Name']; ?></td>
		                  <td><?php echo $row['speciality']; ?></td>
		                  <td><?php echo $row['details'];?></td>
		                  <td><?php echo $row['phone']; ?></td>
		                  <td><?php echo $row['email']; ?></td>
		                  <td><?php echo $row['visitingHour']; ?></td>
	                	</tr>
	              	<?php } ?>
	            </tbody>
	          </table>
	</section>
	


</body>
</html>
