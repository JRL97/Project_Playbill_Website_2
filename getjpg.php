<?php
 include("_includes/config.inc");
 include("_includes/dbconnect.inc");
 include("_includes/functions.inc");

  header("Content-type: image/jpeg");

  $sql = "SELECT profileimage FROM student WHERE id='" . $_GET['studentid'] ."';";
 

  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_array($result);
  $imagedata = $row['profileimage'];
 
  $data['content'] .= "<td> <img src='data:image/jpeg;base64," . base64_encode($imagedata) . "' alt='Profile Picture' height='80' width='80'> </td>";

  $jpg = $row["profileimage"];

  echo $jpg;
?>