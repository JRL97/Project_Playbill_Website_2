<?php

   include("_includes/config.inc");
   include("_includes/dbconnect.inc");
   include("_includes/functions.inc");

   $data['content'] = "";
   echo template("templates/partials/header.php");    

   if (isset($_GET['return'])) {
      $msg = "";
      if ($_GET['return'] == "fail") {$msg = "Login Failed. Please try again.";}
      $data['message'] = "<p>$msg</p>";
   }

   if (isset($_SESSION['id'])) {
      
      
     // $data['content'] .= "<img src='images/TheatreShowInfoLogo.jpg' class='position-absolute top-50 start-50 translate-middle opacity-25' >";
      $data['content'] .= "<h1 class='text-center mt-5'>Welcome to your dashboard.<br>";
      
      echo template("templates/partials/nav.php");
      echo template("templates/default.php", $data);
   } else {
      echo template("templates/login.php", $data);
   }

   echo template("templates/partials/footer.php");

  

?>
