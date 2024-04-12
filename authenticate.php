<?php

   include("_includes/config.inc");
   include("_includes/dbconnect.inc");
   include("_includes/functions.inc");

   // If the student has already been authenticated the $_SESSION['id'] variable
   // will been assigned their student id.


   // redirect to userindex if $_POST values not set or $_SESSION['id'] is already set
   if (!isset($_POST['txtid']) || !isset($_POST['txtpwd']) || isset($_SESSION['id'])) {
      header("Location: userindex.php");
	} else {
      if (validateuserlogin($_POST['txtid'],$_POST['txtpwd']) == true) {
         // valid
         header("Location: userindex.php?return=success");
      } else {
         // invalid
         unset($_SESSION['id']);
         header("Location: userindex.php?return=fail");
      }
	}
?>
