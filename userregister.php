<?php

   include("_includes/config.inc");
   include("_includes/dbconnect.inc");
   include("_includes/functions.inc");
   $data['content'] = "";

   echo template("templates/partials/header.php");
   
   //Needs to register a user and insert into the table the new user but check,
   //that the username and email is not already in use. 
?>
   <div class="bg-image"
     style="background-image: url('images/BucksLogo.jpg'); background-repeat:no-repeat; height: 100vh;">

     <input type="button" value="Back to User Login?" onclick="location='index.php'" />
     
<h1 class="mt-4"> Register as a User</h1>

<?php 
if (!empty($message)) {
   echo '<div class="alert alert-danger" role="alert">' . $message . '</div';
}


if (isset($_POST['btnRegister'])) {

  $username = mysqli_real_escape_string($conn, $_POST['txtid']);
  $sql = "SELECT COUNT(*) AS num_rows FROM user WHERE username = '{$username}' LIMIT 1"; 
  $result = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result);
if($row["num_rows"] > 0){
    $data['content']= "<div class='alert alert-success mt-3' role='alert'>Username already taken</div>";
    $data['content'] .= "<input type='button' value='Return' onclick='window.location.href=\"userregister.php\"'>";
}
 
    else
    {

    $hashed_password = password_hash($_POST['txtpwd'], PASSWORD_DEFAULT);
    //$password =  mysqli_real_escape_string($conn, $_POST['txtpwd']);
    $firstname =  mysqli_real_escape_string($conn, $_POST['txtfn']);
    $lastname =  mysqli_real_escape_string($conn, $_POST['txtln']);
    $email =  mysqli_real_escape_string($conn, $_POST['txtem']);

    $sql = "INSERT INTO user (username, password, firstname, lastname, email) 
    VALUES ('$username', '$hashed_password', '$firstname', '$lastname', '$email')";
    $result = mysqli_query($conn,$sql);

    $data['content']= "<div class='alert alert-success mt-3' role='alert'>Successfully Registered!</div>";
$data['content'] .= "<input type='button' value='Go To Login' onclick='window.location.href=\"index.php\"'>";
}

}      
else {

?>

<form name="frmuRegister" action=" " method="post">
  <div class="mt-3">
    <label for="txtid" class="form-label">Username</label>
    <input type="text" class="form-control" id="txtid" name="txtid">
  </div>
  <div class="mt-3">
    <label for="txtpwd" class="form-label">Password</label>
    <input type="password" class="form-control" id="txtpwd" name="txtpwd">
  </div>
  <div class="mt-3">
    <label for="txtfn" class="form-label">First Name</label>
    <input type="text" class="form-control" id="txtfn" name="txtfn">
  </div>
  <div class="mt-3">
    <label for="txtln" class="form-label">Last Name</label>
    <input type="text" class="form-control" id="txtln" name="txtln">
  </div>
  <div class="mt-3">
    <label for="txtem" class="form-label">Email</label>
    <input type="text" class="form-control" id="txtem" name="txtem">
  </div>
  <div class="mt-4">
  <input type="submit" name="btnRegister" class="btn btn-primary" value="Register"/>
  </div>
</form>
</div>

<?php
}
echo template("templates/default.php", $data);
?> 
