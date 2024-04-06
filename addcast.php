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

//select a performance from the show

$sql= "SELECT performance_id, performance_date FROM performance WHERE show_id = $id";
$result = mysqli_query($conn,$sql);

// Drop down menu for performances
echo "<select id='performance_id' name='performance_date'>"; 

while ($row = mysqli_fetch_array($result)) {
    unset($performanceid, $performancename);
    $performanceid = $row['performance_id'];
    $performancename = $row['performance_date'];
    echo '<option value="'.$performanceid.'">'. $performancename.'</option>';
}
echo "</select>";

$sql = "SELECT role.role_name, actor.actor_name
FROM perfrole 
INNER JOIN role ON perfrole.role_id = role.role_id
INNER JOIN actor ON perfrole.actor_id = actor.actor_id
WHERE perfrole.performance_id = $performanceid AND role.rank= 'main'";
$result = mysqli_query($conn,$sql);

foreach($result as $row) {
    echo $row['role_name'] . $row['actor_name'];
}

$sql = "SELECT role.role_name, actor.actor_name
FROM perfrole 
INNER JOIN role ON perfrole.role_id = role.role_id
INNER JOIN actor ON perfrole.actor_id = actor.actor_id
WHERE perfrole.performance_id = $performanceid AND role.rank= 'supporting'";
$result = mysqli_query($conn,$sql);

foreach($result as $row) {
    echo $row['role_name'] . $row['actor_name'];
}

$sql = "SELECT role.role_name, actor.actor_name
FROM perfrole 
INNER JOIN role ON perfrole.role_id = role.role_id
INNER JOIN actor ON perfrole.actor_id = actor.actor_id
WHERE perfrole.performance_id = $performanceid AND role.rank= 'ensemble'";
$result = mysqli_query($conn,$sql);

foreach($result as $row) {
    echo $row['role_name'] . $row['actor_name'];
}

if (isset($_POST['submit'])) {

//Unassigned Role Dropdown
$sql = "SELECT role_id, role_name FROM role
WHERE show_id = $id
AND NOT role_id in 
    (SELECT role_id 
    FROM perfrole 
    WHERE performance_id = $performanceid)
 ORDER BY role_name";
$result = mysqli_query($conn,$sql);



echo "<select id='role_id' name='role_name'>"; 

while ($row = mysqli_fetch_array($result)) {
    unset($roleid, $rolename);
    $roleid = $row['role_id'];
    $rolename = $row['role_name'];
    echo '<option value="'.$roleid.'">'. $rolename.'</option>';
}
echo "</select>";

//Actor drop down
$sql = "SELECT actor_id, actor_name FROM actor ORDER BY actor_name";
$result = mysqli_query($conn,$sql);



echo "<select id='actore_id' name='actor_name'>"; 

while ($row = mysqli_fetch_array($result)) {
    unset($actorid, $actorname);
    $actorid = $row['actor_id'];
    $actorname = $row['actor_name'];
    echo '<option value="'.$actorid.'">'. $actorname.'</option>';
}
echo "</select>";

$data['content'] = "<div class='alert alert-success mt-3' role='alert'>Role Record Added</div>";
$data['content'] .= "<input type='button' value='Return' onclick='window.location.href=\"addcast.php\"'>";
               }


else {


echo '<div class="container mt-3">
   <div class="card">
   <div class="card-header">
   <h2>Add Cast</h2>
   </div>
   <div class="card-body">
   <form name="frmdetails" action="" method="post" enctype="multipart/form-data">

   
   </div>
  <div class="card-footer">
  <input type="submit" value="Save" name="submit"/>
  </div>
  </form>
  </div>
  </div>';


}

// render the template
echo template("templates/default.php", $data);

?>