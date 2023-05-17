<?php

   include("_includes/config.inc");
   include("_includes/dbconnect.inc");
   include("_includes/functions.inc");


    // check logged in
    if (isset($_SESSION['id'])) {

        if (empty($_POST['students'])){
        echo "No Student Selected!";
        echo "</br>"; 
        echo "Would you like to return to the students table?";

     echo'<form action ="students.php" method="POST">
    <input type="submit" name="returnbtn" value="Return" />
    </form>';

        }

    else{
    foreach($_POST['students'] as $studentID)
    {

    //build the query
    $sql = "DELETE FROM student WHERE studentid = '$studentID'";
    $result = mysqli_query($conn,$sql);
        
    }
 header("Location: students.php");
} 

    
      
    
   } else {
      header("Location: index.php");
   }




   ?>