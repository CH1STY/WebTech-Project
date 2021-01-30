<?php

session_start();


//--- SESSION VALIDATION---\\


//CREATING DESTINATION

//----

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
      $imageDestination = 'Media/Patient/'.$_SESSION['userid'];
          
      if(!is_dir($imageDestination))
      {
        mkdir($imageDestination,0777,true);
      }

      
    }
}

//--- SESSION VALIDATION---\\


if($_SERVER["REQUEST_METHOD"]=="POST")
{

  if(isset($_POST['logOut']))
  {
    session_destroy();
    header("location:login.php");
  }

  if(isset($_POST['submit']))
  {
    $image = $_FILES['image'];



    $image_name = $_FILES['image']['name'];
    $imageError = $_FILES['image']['error'];
    $image_tmpName = $_FILES['image']['tmp_name'];
    $image_size = $_FILES['image']['size'];
    $imageType = $_FILES['image']['type'];

    $imageExt = explode('.', $image_name);
    $imageActualExt = strtolower(end($imageExt));

    $allowedType = array('jpg','jpeg','png');


    if (in_array($imageActualExt, $allowedType))
    {

      if($imageError===0)
      { 

        if($image_size<10000000)
        {

          $imageUploadName = uniqid('',true).".".$imageActualExt;

          $imageDestination = 'Media/Patient/'.$_SESSION['userid'];
          
          if(!is_dir($imageDestination))
          {
            mkdir($imageDestination,0777,true);
          }

          $imageDestination = 'Media/Patient/'.$_SESSION['userid']."/".$imageUploadName;

          move_uploaded_file($image_tmpName,$imageDestination);

          header("Refresh:0");
        }
        else
        {
          $flag = 2;
        }
      }
      else
      {
        $flag=1;
      }
    }
    else
    {
      $flag = 1;
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
	<title>Doctor Panel</title>

<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- ---fonts S--- -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet"> 
<!-- ---fonts E--- -->

<link rel="stylesheet" type="text/css" href="Stylesheet/leftNav.css">
<link rel="stylesheet" type="text/css" href="Stylesheet/footer.css">
<link rel="stylesheet" type="text/css" href="Stylesheet/panel.css">
<link rel="stylesheet" type="text/css" href="Stylesheet/table.css">
<link rel="stylesheet" type="text/css" href="Stylesheet/filesUpDown.css">
<link rel="stylesheet" type="text/css" href="Stylesheet/filesView.css">



</head>


<body>

	<?php include 'includes/leftNav_patient.php'; ?>

	<!-- -------------------------------------------------------------- -->

	<section id="board">

		<h1 class="header">My Files</h1>
    <p class="errorMsg">NOTE: ONLY IMAGES(JPG,PNG) MAXIMUM FILE SIZE: 10MB. UP TO 5 FILES.</p>
	
    <?php

     


      $dirOpener = opendir("Media/Patient/".$_SESSION['userid']."/");

      $dirOpener2 = "Media/Patient/".$_SESSION['userid'];

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
            echo "<div class=\"cont_files\"><h1 class=\"filename\">File ".$count."</h1>";
            echo "<a target=\"_blank\" href=\"Media/Patient/".$_SESSION['userid']."/".$entry."\"> <embed src =\"Media/Patient/".$_SESSION['userid']."/".$entry."\" style=\"width: 300px; height:300px;\"></a><br>";

            echo "<form method=\"POST\">"."<button class=\"cancelBtn\" type=\"Submit\" name=\"delete\" value=\"Media/Patient/".$_SESSION['userid']."/".$entry."\"".">Delete</button></form> </div>" ;
          }
        }
      }

    ?>
    <?php

    $dirOpener2 = "Media/Patient/".$_SESSION['userid'];
    $fi = new FilesystemIterator($dirOpener2, FilesystemIterator::SKIP_DOTS);
    

    if(iterator_count($fi)>=5)
    {

    }
    else
    {
        echo "<form method=\"POST\" enctype=\"multipart/form-data\">
          
          <input class =\"submit_btn\" type=\"file\" name=\"image\">

          <button class=\"submit_btn\" type=\"submit\" name=\"submit\">Upload Image</button>


        </form>";
    }
    ?>

	</section>
	

</body>
</html>