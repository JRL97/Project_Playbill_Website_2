<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

$data['content'] = "";

$id = $_POST['stitle'];

echo template("templates/partials/header.php");
echo template("templates/partials/nav.php");

//sql to get the name of the show that is currently being displayed. 

$sql = "SELECT title FROM theatreshow WHERE show_id = $id";
$result = mysqli_query($conn,$sql);
while ($row = mysqli_fetch_array($result)) {
    //unset($id, $name);
    $currenttitle = $row['title'];
}



$data['content'] .= "<table class='table table-bordered border-dark mt-3'>";
      $data['content'] .= "<tr><th colspan='10' align='center'>Current Role List for $currenttitle </th></tr>";
      $data['content'] .=  "<tr>
                                <th>Role</th>
                            </tr>";


$sql = "SELECT role_name FROM role WHERE show_id = $id AND rank= 'main'";
$result = mysqli_query($conn,$sql);

foreach($result as $row) {
    $data['content'] .= "<tr>";
    $data['content'] .= "<td>{$row['role_name']} </td>";
    $data['content'] .= "<tr>";
}

$sql = "SELECT role_name FROM role WHERE show_id = $id AND rank= 'supporting'";
$result = mysqli_query($conn,$sql);

foreach($result as $row) {
    $data['content'] .= "<tr>";
    $data['content'] .= "<td>{$row['role_name']}</td>";
    $data['content'] .= "<tr>";
}

$sql = "SELECT role_name FROM role WHERE show_id = $id AND rank= 'ensemble'";
$result = mysqli_query($conn,$sql);

foreach($result as $row) {
    $data['content'] .= "<tr>";
    $data['content'] .= "<td>{$row['role_name']}</td>";
    $data['content'] .= "<tr>";
}





if (isset($_POST['submit1'])) {

    if(empty($_POST['role_name']) || empty($_POST['rank']))
  
    
    {
        //Print out error message if any of the fields are empty and return to the addstudent page button
        $data['content'] = "<p>Please Fill In All Required Fields</p><br>";    
        $data['content'] .= "<input type='button' value='Return' onclick='window.location.href=\"addrole.php\"'>";
    } 

    else
    {

        
        $id = mysqli_real_escape_string($conn, $_POST['stitle']);
$role_name =  mysqli_real_escape_string($conn, $_POST['role_name']);
$rank =  mysqli_real_escape_string($conn, $_POST['rank']);

$sql = "INSERT INTO role (show_id, role_name, rank) 
VALUES ('$id', '$role_name', '$rank')";
$result = mysqli_query($conn,$sql);



$data['content'] = "<div class='alert alert-success mt-3' role='alert'>Role Record Added</div>";
?> <form action="" method="post"><input type="hidden" name="stitle" value="<?php echo $id; ?>"> 
<input type="submit" value="Return" name="submit"/> </form> <?php 

               }

}
else {


?>
               <div class="container mt-3">
               <div class="card">
               <div class="card-header">
               <h2>Add New Role</h2>
               </div>
               <div class="card-body">
               <form name="frmdetails" action="" method="post" enctype="multipart/form-data">
               
               <input type="hidden" name="stitle" value="<?php echo $id; ?>">
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
               <input type="submit" value="Save" name="submit1"/>
               </div>
               </form>
               </div>
               </div>
            


<?php
}
             // render the template
   echo template("templates/default.php", $data);






?>

