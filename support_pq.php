<?php

session_start();

require "includes/db_connect.inc.php";

//--- SESSION VALIDATION---\\


if(!isset($_SESSION['utype']))
  {
  header("location:login.php"); 
  }
  
  else
  {
    if($_SESSION['utype']!="support"){
      header("location:login.php");
    }
    else
    {

    }
}

if($_SERVER["REQUEST_METHOD"]=="POST")
{
	
	if(isset($_POST['logOut']))
	{
		session_destroy();
		header("location:login.php");
	}
	else if(isset($_POST['status_change']))
	{
      $sql_status = "UPDATE `query` SET `status` = '1' WHERE `id` = ".$_POST['status_change']." ";
      mysqli_query($conn, $sql_status);
    }
}

//--- SESSION VALIDATION---\\

$sql_query = "SELECT * FROM query where status=0 ORDER BY dateTime DESC";
$result = mysqli_query($conn, $sql_query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="shortcut icon" href="" type=""> 
	<title>Patient Panel</title>

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

	<?php include 'includes/leftNav_support.php'; ?>

	<!-- -------------------------------------------------------------- -->

	<section id="board">

		<h1 class="header">Pending Queries</h1>

		<table style="margin-top: 50px" class="blueTable">
			
	            <thead>
	              <tr>
	                <th>ID</th>
	                <th>Name</th>
	                <th>Query</th>
	                <th>E-mail</th>
	                <th>Date & Time</th>
	                <th>Status</th>
	                <th>Reply</th>
	                <th>Action</th>
	              </tr>
	            </thead>
	            <tbody>
	              <?php while($row = mysqli_fetch_assoc($result)) { ?>
	              		<tr>
	              		  <td><?php echo $row['id']; ?></td>
		                  <td><?php echo $row['Name']; ?></td>
		                  <td><?php echo $row['Query']; ?></td>
		                  <td><?php echo $row['email']; ?></td>
		                  <td><?php echo $row['dateTime']; ?></td>
		                  <td>Pending</td>

		                  <td><?php echo "<a target=\"_blank\" href=\"https://mail.google.com/mail/u/0/?view=cm&fs=1&to=".$row['email']."&su=CMS_QUERY_REPLY&tf=1\"><button>Reply</button></a>" ?></td>

		                  <form action="" method="POST">
		                  	<td><button type="submit" name="status_change" value=<?php echo $row['id'] ?>>✔ Done</button></td>
		                  </form>

	                	</tr>
	              	<?php } ?>
	            </tbody>
	            
	          </table>


		

	</section>

</body>
</html>