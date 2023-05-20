<?php
 include("_includes/config.inc");
 include("_includes/dbconnect.inc");
 include("_includes/functions.inc");

  header("Content-type: image/jpeg");

  $sql = "SELECT profileimage FROM student WHERE id='" . $_GET['studentid'] ."';";
 

  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_array($result);
 
  $jpg = $row["profileimage"];

  echo $jpg;
?>