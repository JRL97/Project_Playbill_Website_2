<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

$data['content'] = "";
$sid = $_POST['stitle'];
$showing = $_POST['showing'];
$pid = $_POST['ptitle'];
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
                <h2 align="center"><?php echo $title . " on " . $showing . " performance"?> </h2>
             </div>
        <div class="card-body">
             <table class="table">
                 <tr>
                     <td width="10%">
                         <b>Synopsis</b>
                     </td>
                     <td width="90" word-wrap="break-word">
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
    

<?php

 $data['content'] .="<div class='card'>"; 
    $data['content'].="<div class='card-header'>";
        $data['content'] .= "<h3 colspan='4' align='center'>Appearing At This Performance</h3>";
    $data['content'] .="</div>";
  
   $data['content'].="<div class='card-body'>";
     $data['content'] .="<table class='table'>";


 $sql = "SELECT role.role_name, actor.actor_name
FROM perfrole 
INNER JOIN role ON perfrole.role_id = role.role_id
INNER JOIN actor ON perfrole.actor_id = actor.actor_id
WHERE perfrole.performance_id = $pid AND role.rank= 'main'";
$result = mysqli_query($conn,$sql);

$count =0; 

foreach($result as $row) {
    if($count % 2 == 0){
        $data['content'] .= "<tr>";
    }
    $data['content'] .= "<td width= 20%> <b>{$row['actor_name']}</b> </td>";
    $data['content'] .= "<td width= 10%> as </td>";
    $data['content'] .= "<td width= 20%>{$row['role_name']} </td>";
    if($count % 2 == 1){
        $data['content'] .= "<tr>";
    }
    $count++;
}
if($count % 2 == 0){
    $data['content'] .= "<tr>";
}




     
    $data['content'] .="</table>";
    $data['content'] .="</div>";
    $data['content'] .="</div>";

//Support Cast Table


$data['content'] .="<div class='card'>"; 
$data['content'].="<div class='card-header'>";
    $data['content'] .= "<h4 colspan='4' align='center'>Supported By</h4>";
$data['content'] .="</div>";

$data['content'].="<div class='card-body'>";
 $data['content'] .="<table class='table'>";


$sql = "SELECT role.role_name, actor.actor_name
FROM perfrole 
INNER JOIN role ON perfrole.role_id = role.role_id
INNER JOIN actor ON perfrole.actor_id = actor.actor_id
WHERE perfrole.performance_id = $pid AND role.rank= 'supporting'";
$result = mysqli_query($conn,$sql);

$count =0; 

foreach($result as $row) {
if($count % 2 == 0){
    $data['content'] .= "<tr>";
}
$data['content'] .= "<td width= 20%> <b>{$row['actor_name']}</b> </td>";
$data['content'] .= "<td width= 10%> as </td>";
$data['content'] .= "<td width= 20%>{$row['role_name']} </td>";
if($count % 2 == 1){
    $data['content'] .= "<tr>";
}
$count++;
}
if($count % 2 == 0){
$data['content'] .= "<tr>";
}




 
$data['content'] .="</table>";
$data['content'] .="</div>";
$data['content'] .="</div>";

//Ensemble Table 

$data['content'] .="<div class='card'>"; 
$data['content'].="<div class='card-header'>";
    $data['content'] .= "<h5 colspan='4' align='center'>Ensemble</h5>";
$data['content'] .="</div>";

$data['content'].="<div class='card-body'>";
 $data['content'] .="<table class='table'>";


$sql = "SELECT role.role_name, actor.actor_name
FROM perfrole 
INNER JOIN role ON perfrole.role_id = role.role_id
INNER JOIN actor ON perfrole.actor_id = actor.actor_id
WHERE perfrole.performance_id = $pid AND role.rank= 'ensemble'";
$result= mysqli_query($conn,$sql);

$count = 0; 
$string = "";

foreach($result as $row) {
if($count == 0){
    $string = $row['actor_name'];
    $count++;
}
elseif($count == 3){
    $string = $string . " , " . $row['actor_name'];
    $data['content'] .= "<tr>";
    $data['content'] .= "<td width= 20%> <b>$string</b> </td>";
    $data['content'] .= "</tr>";
    $count = 0;
    $string = "";
}
else{
    $string = $string . " , " . $row['actor_name'];
    $count++;
}
   

}

if($count != 0){
    $data['content'] .= "<tr>";
    $data['content'] .= "<td width= 20% align='center'> <b>$string</b> </td>";
    $data['content'] .= "</tr>";
}




 
$data['content'] .="</table>";
$data['content'] .="</div>";
$data['content'] .="</div>";

$data['content'] .="</div>";
$data['content'] .="</div>";
?>
   

    



<?php 
echo template("templates/default.php", $data);

?> 