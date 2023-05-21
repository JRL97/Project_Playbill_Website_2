<html>
<head></head>
<body>

<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");
  
  

  $sql = "SELECT studentid, firstname, lastname FROM student;";

  $result = mysqli_query($conn, $sql);
  
  
  echo "<table align='center' border='1'>";
  echo "<tr><th width='200' align='left'>ID</th><th width='200' align='left'>Student ID</th><th>First Name</th><th>Lastname</th><th>Profile Picture</th></tr>";
  
  while($row = mysqli_fetch_assoc($result)){
    echo "<tr>";
    echo "<td>" . $row['studentid'] . "</td>";
    echo "<td>" . $row['firstname'] . "</td>";
    echo "<td>" . $row['lastname'] . "</td>";
    echo "<td><img src='getjpeg.php?studentid=" . $row['studentid']. "' height='100' width='100'</td>";
    echo "</tr>";
  }
  
  echo "</table>";
  
  mysqli_close();
  ?>