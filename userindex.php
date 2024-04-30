<?php

   include("_includes/config.inc");
   include("_includes/dbconnect.inc");
   include("_includes/functions.inc");

   echo template("templates/partials/header.php");

   if (isset($_GET['return'])) {
      $msg = "";
      if ($_GET['return'] == "fail") {$msg = "Login Failed. Please try again.";}
      $data['message'] = "<p>$msg</p>";
   }

   if (isset($_SESSION['id'])) {
      //$data['content'] .= "<img src='images/TheatreShowInfoLogo.jpg' class='position-absolute top-50 start-50 translate-middle opacity-25' >";
      $data['content'] .= "<h1 class='text-center mt-5'>Please Select a Show<br>";
      
      echo template("templates/partials/usernav.php");
      echo template("templates/default.php", $data);


//select all shows and order by title
$sql = "SELECT show_id, title FROM theatreshow ORDER BY title";
$result = mysqli_query($conn,$sql);




?>
<div class="container mt-3">
   <div class="card">
   <div class="card-header">
   <h2>Select Show To Add Cast To To</h2>
   </div>
   <div class="card-body">
   <form name="frmdetails" action="userperformanceselect.php" method="POST" enctype="multipart/form-data">

   


<select name="stitle"> 

<?php while ($row = mysqli_fetch_array($result)) {
   unset($id, $name);
    $id = $row['show_id'];
    $name = $row['title'];
    echo '<option value="'.$id.'">'. $name.'</option>';
}
?>


</select>


</div>
  <div class="card-footer">
  <input type="submit" value="Select Show" name="submit"/>
  </div>
  </form>
  </div>
  </div>




<?php







   } else {
      echo template("templates/login.php", $data);
   }

   echo template("templates/partials/footer.php");

   // another test edit

?>
