<?php

session_start();



//--- SESSION VALIDATION---\\


if(!isset($_SESSION['utype']))
  {
  header("location:login.php"); 
  }
  
  else
  {
    if($_SESSION['utype']!="admin" && $_SESSION['utype']!="doctor"){
      header("location:login.php");
    }
    else
    {
      $imageDestination = 'Media/Patient/'.$_COOKIE['patientId'];
          
      if(!is_dir($imageDestination))
      {
        mkdir($imageDestination,0777,true);
      }

      
    }
}

//--- SESSION VALIDATION---\\

//--COOKIE VALIDATION

if(!isset($_COOKIE['patientId']))
{
  if($_SESSION['utype']!="admin")
  {
    header("location:admin_pat.php");
  }
  else if($_SESSION['utype']!="doctor")
  {
    header("location:doc_patients.php");
  }
  else
  {
    header("location:login.php"); 
  }
}

//---

require "includes/db_connect.inc.php";


if($_SERVER["REQUEST_METHOD"]=="POST")
{

  if(isset($_POST['logOut']))
  {
    session_destroy();
    header("location:login.php");
  }

  if(isset($_POST['back']))
  {
    if($_SESSION['utype']=="admin")
    {
      header("location:admin_pat.php");

    }
    else if($_SESSION['utype']=="doctor")
    {
      header("location:doc_patients.php");
    }
  }
  
  if(isset($_POST['delete']))
  {
    unlink($_POST['delete']);
  }


}

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="shortcut icon" href="" type=""> 
	<title>PATIENT DETAILS</title>

<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- ---fonts S--- -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet"> 
<!-- ---fonts E--- -->


<link rel="stylesheet" type="text/css" href="Stylesheet/footer.css">
<link rel="stylesheet" type="text/css" href="Stylesheet/panel.css">
<link rel="stylesheet" type="text/css" href="Stylesheet/reg.css">
<link rel="stylesheet" type="text/css" href="Stylesheet/filesUpDown.css">
<link rel="stylesheet" type="text/css" href="Stylesheet/filesView.css">



</head>


<body class="greyBG">

	<!-- -------------------------------------------------------------- -->

	<section id="container">

    <a href="index.php"><img class="logo" src="skins/logo2.png"></a>
    <div align="center">

    <form align="center" method="POST"><input id="canBtn" class="cancelBtn" type="Submit" name="back" value="Back"></form>

		<h1 class="header">Files of Patient <?php 

    $sql = "Select Name from Patient where id = ".$_COOKIE['patientId'].";";

    $result = mysqli_query($conn,$sql);

    if($row = mysqli_fetch_assoc($result))
    {
      echo "Named : ".$row['Name'];
    }
    else
    {

      echo "id :". $_COOKIE['patientId'];

    }
      ?> </h1>
    
    
	
    <?php

     


      $dirOpener = opendir("Media/Patient/".$_COOKIE['patientId']."/");

      $dirOpener2 = "Media/Patient/".$_COOKIE['patientId'];

      $fi = new FilesystemIterator($dirOpener2, FilesystemIterator::SKIP_DOTS);

      if(iterator_count($fi)==0)
      {
        echo  "<h1 class=\"header\" align=\"Center\">NO FILES UPLOADED YET</h1>" ;
      }
      else
      { 
        $count = 0;
        while(($entry = readdir($dirOpener)) !== false)
        {
          

          if($entry !='.' && $entry !='..')
          {
            $count++;
            echo "<div class=\"cont_files\"><h1 class=\"fileName\">File ".$count."</h1>";
            echo "<div class=\"imgView\"><a target=\"_blank\" href=\"Media/Patient/".$_COOKIE['patientId']."/".$entry."\"> <embed src =\"Media/Patient/".$_COOKIE['patientId']."/".$entry."\" style=\"width: 300px; height:300px;\"></a></div>";
            if($_SESSION['utype']=="admin")
            {
              echo "<form method=\"POST\">"."<button class=\"cancelBtn\" type=\"Submit\" name=\"delete\" value=\"Media/Patient/".$_COOKIE['patientId']."/".$entry."\"".">Delete</button></form>" ;
            }

            echo "</div>";
            
          }
        }
      }

    ?>
  </div>
    
    

	</section>
	

</body>
</html>