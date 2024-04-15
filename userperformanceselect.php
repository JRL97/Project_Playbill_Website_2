<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

$data['content'] = "";
$id = $_POST['stitle'];
echo template("templates/partials/header.php");
echo template("templates/partials/usernav.php");




//select all performances
$sql = "SELECT performance_id, CONCAT_WS(' ', performance_date, mat_eve) AS showing FROM performance WHERE show_id = $id ORDER BY 1";
$result = mysqli_query($conn,$sql);




?>
<div class="container mt-3">
   <div class="card">
   <div class="card-header">
   <h2>Select Show To Add Cast To To</h2>
   </div>
   <div class="card-body">
   <form name="frmdetails" action="userprogramme.php" method="POST" enctype="multipart/form-data">

   


<select name="ptitle"> 

<?php while ($row = mysqli_fetch_array($result)) {
   unset($pid, $showing);
    $performanceid = $row['performance_id'];
    $showing = $row['showing'];
    echo '<option value="'.$performanceid.'">'. $showing.'</option>';
}
?>


</select>



</div>
  <div class="card-footer">
  <input type="hidden" name="stitle" value="<?php echo $id; ?>">
  <input type="hidden" name="showing" value="<?php echo $showing; ?>">
  <input type="submit" value="Generate Showing Info" name="submit"/>
  </div>
  </form>
  </div>
  </div>



<?php


// render the template
echo template("templates/default.php", $data);






?>