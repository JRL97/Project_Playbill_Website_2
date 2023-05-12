<?php

   include("_includes/config.inc");
   include("_includes/dbconnect.inc");
   include("_includes/functions.inc");


   //check if we are logged in
   if (isset($_SESSION['id'])) {
    // build inster query 
    // run query 
    //x5
     
    for ($i=0; $i < 5; $i++;) {
    $sql = "INSERT INTO student";

    $result = mysqli_query($conn,$sql);
    }

   } 
?>
