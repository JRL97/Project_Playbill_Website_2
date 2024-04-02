<div class="bg-image"
     style="background-image: url('images/BucksLogo.jpg'); background-repeat:no-repeat; height: 100vh;">
     
<h1 class="mt-4">Login </h1>

<?php 
if (!empty($message)) {
   echo '<div class="alert alert-danger" role="alert">' . $message . '</div';
}
?>

<form name="frmLogin" action="authenticate.php" method="post">
  <div class="mt-3">
    <label for="txtid" class="form-label">Username</label>
    <input type="text" class="form-control" id="txtid" name="txtid">
  </div>
  <div class="mt-3">
    <label for="txtpwd" class="form-label">Password</label>
    <input type="password" class="form-control" id="txtpwd" name="txtpwd">
  </div>
  <div class="mt-4">
  <input type="submit" name="btnlogin" class="btn btn-primary" value="Login"/>
  </div>
</form>
</div>