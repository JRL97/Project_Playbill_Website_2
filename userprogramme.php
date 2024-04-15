<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

$data['content'] = "";
$sid = $_POST['stitle'];
$showing = $_POST['showing'];
echo template("templates/partials/header.php");
echo template("templates/partials/usernav.php");

//Get show info
$sql = "SELECT title, synopsis, theatre, run_time FROM theatreshow WHERE show_id = $sid";
$result = mysqli_query($conn,$sql);
while ($row = mysqli_fetch_array($result)) {
    //unset($pid, $showing);
     $title = $row['title'];
     $synopsis = $row['synopsis'];
     $theatre = $row['theatre'];
     $runtime = $row['run_time'];
    
 }

//$sql = ""

//create tables of info for the user programmes. 
?>

<html>
<head>
  <link rel="stylesheet" href="css/programme.css">
</head>
<body>


<div = @page>
<div class="container mt-3">
   <div class="card">
    <div class="card-header">
    <h2><?php echo $title . " on " . $showing . " performance"?> </h2>
    </div>
    <div class="card-body">
    <table>
      <tr>
        <td>
            <b>Synopsis</b>
        </td>
        <td>
            <?php echo $synopsis ?>
        </td>
       </tr>     
       <tr>
        <td>
            <b>Theatre</b>
        </td>
        <td>
            <?php echo $theatre ?>
        </td>
       </tr>   
       <tr>
        <td>
            <b>Run Time</b>
        </td>
        <td>
            <?php echo $runtime ?>
        </td>
       </tr>   
    </table>
    </div>
   </div>

   <div class="card"> 
     <?php
        
        $sql = "SELECT role.role_name, actor.actor_name
FROM perfrole 
INNER JOIN role ON perfrole.role_id = role.role_id
INNER JOIN actor ON perfrole.actor_id = actor.actor_id
WHERE perfrole.performance_id = $performanceid AND role.rank= 'main'";
$result = mysqli_query($conn,$sql);


foreach($result as $row) {
    if($count % 2 == 0){
$data['content'] .= "<tr>";
$data['content'] .= "<td>{$row['role_name']} </td>";
$data['content'] .= "<td>{$row['actor_name']} </td>";
$data['content'] .= "<tr>";
    //echo $row['role_name'] . $row['actor_name'];
}





     ?>
   </div>

    
</div>
</div>


  <?php