<?php

   include("_includes/config.inc");
   include("_includes/dbconnect.inc");
   include("_includes/functions.inc");



     $sql = "ALTER TABLE student ADD profileimage blob";
      
      $result = mysqli_query($conn,$sql);

     
     
    
  
?>