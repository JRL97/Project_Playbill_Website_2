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




?>
<div class="container mt-3">
   <div class="card">
   <div class="card-header">
   <h2>Select Show To Add Roles To</h2>
   </div>
   <div class="card-body">
   <form name="frmdetails" action="addrole.php" method="POST" enctype="multipart/form-data">

   


<select name="stitle"> 

<?php while ($row = mysqli_fetch_array($result)) {
   unset($id, $name);
    $id = $row['show_id'];
    $name = $row['title'];
    echo '<option value="'.$id.'">'. $name.'</option>';
}
?>


</select>

<?php
//echo $id. $name; 
//$option = $_POST['stitle'];
?>

</div>
  <div class="card-footer">
  <input type="submit" value="Go To Add Roles" name="submit"/>
  </div>
  </form>
  </div>
  </div>



<?php


// render the template
echo template("templates/default.php", $data);






?>