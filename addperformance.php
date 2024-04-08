<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

$data['content'] = "";

echo template("templates/partials/header.php");
echo template("templates/partials/nav.php");

//select all shows and order by title
$sql = "SELECT show_id, title FROM theatreshow ORDER BY title";
$result = mysqli_query($conn,$sql);


// Drop down menu for all shows
echo "<select id='show_id' name='title'>"; 

while ($row = mysqli_fetch_array($result)) {
    unset($id, $name);
    $id = $row['show_id'];
    $name = $row['title'];
    echo '<option value="'.$id.'">'. $name.'</option>';
}
echo "</select>";

//$name =  mysqli_real_escape_string($conn, $_POST['title']);

if (isset($_POST['submit'])) {

    if(empty($_POST['performance_date']) || empty($_POST['mat_eve']))
  
    
    {
        
        //Print out error message if any of the fields are empty and return to the addstudent page button
        $data['content'] = "<p>Please Fill In All Required Fields</p><br>";    
        $data['content'] .= "<input type='button' value='Return' onclick='window.location.href=\"addperformance.php\"'>";
    } 

    else
    {

        
//$performance_date =  $_POST['performance_date'];
$mat_eve =  mysqli_real_escape_string($conn, $_POST['mat_eve']);


$sql = "INSERT INTO performance (show_id, performance_date, mat_eve) 
VALUES ('$id', '{$_POST['performance_date']}', '$mat_eve')";
$result = mysqli_query($conn,$sql);

echo $id . $name;
//$data['content'] = "<div class='alert alert-success mt-3' role='alert'>Role Record Added</div>";
//$data['content'] .= "<input type='button' value='Return' onclick='window.location.href=\"addperformance.php\"'>";
               }

}
else {


$data['content'] = <<<EOD
<div class="container mt-3">
   <div class="card">
   <div class="card-header">
   <h2>Add New Student</h2>
   </div>
   <div class="card-body">
   <form name="frmdetails" action="" method="post" enctype="multipart/form-data">

   Date of Performance: 
   <input class="form-control mt-2 mb-2" name="performance_date" type="date" value="" />
   Matinee or Evening Show:
   <select name="mat_eve">
   <option value="matinee">Matinee</option>
   <option value="evening">Evening</option>
   </select>

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

?>