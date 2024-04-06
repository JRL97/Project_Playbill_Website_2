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

$sql = "SELECT role_name FROM role WHERE show_id = $id AND rank= 'main'";
$result = mysqli_query($conn,$sql);

foreach($result as $row) {
    echo $row['role_name'];
}

$sql = "SELECT role_name FROM role WHERE show_id = $id AND rank= 'supporting'";
$result = mysqli_query($conn,$sql);

foreach($result as $row) {
    echo $row['role_name'];
}

$sql = "SELECT role_name FROM role WHERE show_id = $id AND rank= 'ensemble'";
$result = mysqli_query($conn,$sql);

foreach($result as $row) {
    echo $row['role_name'];
}

if (isset($_POST['submit'])) {

    if(empty($_POST['role_name']) || empty($_POST['rank']))
  
    
    {
        //Print out error message if any of the fields are empty and return to the addstudent page button
        $data['content'] = "<p>Please Fill In All Required Fields</p><br>";    
        $data['content'] .= "<input type='button' value='Return' onclick='window.location.href=\"addrole.php\"'>";
    } 

    else
    {

$role_name =  mysqli_real_escape_string($conn, $_POST['role_name']);
$rank =  mysqli_real_escape_string($conn, $_POST['rank']);

$sql = "INSERT INTO role (show_id, role_name, rank) 
VALUES ('$id', '$role_name', '$rank')";
$result = mysqli_query($conn,$sql);

$data['content'] = "<div class='alert alert-success mt-3' role='alert'>Role Record Added</div>";
$data['content'] .= "<input type='button' value='Return' onclick='window.location.href=\"addrole.php\"'>";
               }

}
else {


$data['content'] = <<<EOD

               <div class="container mt-3">
               <div class="card">
               <div class="card-header">
               <h2>Add New Role</h2>
               </div>
               <div class="card-body">
               <form name="frmdetails" action="" method="post" enctype="multipart/form-data">
            
               Role Name: 
               <input class="form-control mt-2 mb-2" name="role_name" type="text" value=""  />
                Rank:
                <select name="rank">
                <option value="main">Main</option>
                <option value="supporting">Supporting</option>
                <option value="ensemble">Ensemble</option>
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

