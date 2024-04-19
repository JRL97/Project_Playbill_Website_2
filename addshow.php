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
    if(empty($_POST['title']) || empty($_POST['synopsis']) 
        || empty($_POST['theatre']) || empty($_POST['run_time']) )
        
        
        {
            //Print out error message if any of the fields are empty and return to the addstudent page button
            $data['content'] = "<p>Please Fill In All Required Fields</p><br>";    
            $data['content'] .= "<input type='button' value='Return' onclick='window.location.href=\"addshow.php\"'>";
        } 
    
        else
        {

            $title =  mysqli_real_escape_string($conn, $_POST['title']);
            $synopsis =  mysqli_real_escape_string($conn, $_POST['synopsis']);
            $theatre = mysqli_real_escape_string($conn, $_POST['theatre']);
            $run_time = mysqli_real_escape_string($conn, $_POST['run_time']);
          

            $sql = "INSERT INTO theatreshow (title, synopsis, theatre, run_time) 
            VALUES ( '$title', '$synopsis', '$theatre', '$run_time')"; 
        
             //run the query
            $result = mysqli_query($conn,$sql);
          
        
              $data['content'] = "<div class='alert alert-success mt-3' role='alert'>Show Record Added</div>";
              $data['content'] .= "<input type='button' value='Return' onclick='window.location.href=\"addshow.php\"'>";
               }
   }
            else {

               $data['content'] = <<<EOD

               <div class="container mt-3">
               <div class="card">
               <div class="card-header">
               <h2>Add New Show</h2>
               </div>
               <div class="card-body">
               <form name="frmdetails" action="" method="post" enctype="multipart/form-data">
            
               Title: 
               <input class="form-control mt-2 mb-2" name="title" type="text" value=""  />
               Synopsis:
               <input class="form-control mt-2 mb-2" name="synopsis" type="text" value=""  />
               Theatre: 
               <input class="form-control mt-2 mb-2" name="theatre" type="text" value="" />
               Run Time (In Minutes) :
               <input class="form-control mt-2 mb-2" name="run_time" type="int" value="" />
               
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


echo template("templates/partials/footer.php");

?>