<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

$data['content'] = "";

//if (isset($_SESSION['id'])) {

   echo template("templates/partials/header.php");
   echo template("templates/partials/nav.php");

   // if the form has been submitted
   if (isset($_POST['submit'])) {

    //Check if any of the fields are empty
    if(empty($_POST['actor_name'])) 
        
        {
            //Print out error message if any of the fields are empty and return to the addstudent page button
            $data['content'] = "<p>Please Fill In All Required Fields</p><br>";    
            $data['content'] .= "<input type='button' value='Return' onclick='window.location.href=\"addactor.php\"'>";
        } 
    
        else
        {

            $actor_name =  mysqli_real_escape_string($conn, $_POST['actor_name']);
          

            $sql = "INSERT INTO actor (actor_name) 
            VALUES ( '$actor_name')"; 
        
        
             //run the query
            $result = mysqli_query($conn,$sql);
        
              $data['content'] = "<div class='alert alert-success mt-3' role='alert'>Actor Added</div>";
              $data['content'] .= "<input type='button' value='Return' onclick='window.location.href=\"addactor.php\"'>";
               }
   }
            else {

               $data['content'] = <<<EOD

               <div class="container mt-3">
               <div class="card">
               <div class="card-header">
               <h2>Add New Actor</h2>
               </div>
               <div class="card-body">
               <form name="frmdetails" action="" method="post" enctype="multipart/form-data">
            
               Actor Name: 
               <input class="form-control mt-2 mb-2" name="actor_name" type="text" value=""  /> 
               </div>
               <div class="card-footer">
               <input type="submit" value="Save" name="submit"/>
               </div>
               </form>
               </div>
               </div>
            EOD;
            }
               // render the template
   echo template("templates/default.php", $data);

// } else {
  // header("Location: index.php");
//}

echo template("templates/partials/footer.php");

?>