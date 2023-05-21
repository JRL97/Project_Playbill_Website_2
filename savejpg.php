<?php
  include("_includes/config.inc");
  include("_includes/dbconnect.inc");
  include("_includes/functions.inc");

// Obtain the file sent to the server within the response.
$image = $_FILES['profileimage']['tmp_name']; 

  // Get the file binary data
  $imagedata = addslashes(fread(fopen($image, "r"), filesize($image)));
  $studentid = $_POST['studentid'];
   
  $sql = "INSERT INTO student (profileimage) VALUES'$imagedata' WHERE studentid='$studentid'";

  $result = mysqli_query($conn, $sql);

  header("location: students.php");
   mysqli_close();
?>