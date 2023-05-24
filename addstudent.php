<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

$data['content'] = "";

// check logged in
if (isset($_SESSION['id'])) {

   echo template("templates/partials/header.php");
   echo template("templates/partials/nav.php");

   // if the form has been submitted
   if (isset($_POST['submit'])) {

    //Check if any of the fields are empty
    if(empty($_POST['studentid']) || empty($_POST['password']) 
        || empty($_POST['dob']) || empty($_POST['firstname']) 
        || empty($_POST['lastname']) || empty($_POST['house']) 
        || empty($_POST['town']) || empty($_POST['county']) 
        || empty($_POST['country']) || empty($_POST['postcode'])) {

            //Print out error message if any of the fields are empty and return to the addstudent page button
            $data['content'] = "<p>Please Fill In All Required Fields</p><br>";    
            $data['content'] .= "<input type='button' value='Return' onclick='window.location.href=\"addstudent.php\"'>";
        } 
        $allowed_image_extension = array(
            "png",
            "jpg",
            "jpeg"
        );
    
        $file_extension = pathinfo($_FILES["profileimage"]["name"], PATHINFO_EXTENSION);
// Validate file input to check if is with valid extension
    if (! in_array($file_extension, $allowed_image_extension)) {
        echo "All Fields Are Required <br> ";
    echo "Only JPG and PNG are valid! <br> ";
    $data['content'] .= "<input type='button' value='Return' onclick='window.location.href=\"addstudent.php\"'>";
} 
        else
        {

     //Hash Password
     $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

     $image = $_FILES['profileimage']['tmp_name'];
     $imagedata = addslashes(fread(fopen($image, "r"), filesize($image)));
     $studentid = $_POST['studentid'];

     $firstname =  mysqli_real_escape_string($conn, $_POST['firstname']);
     $lastname =  mysqli_real_escape_string($conn, $_POST['lastname']);
     $house = mysqli_real_escape_string($conn, $_POST['house']);
     $town = mysqli_real_escape_string($conn, $_POST['town']);
     $county = mysqli_real_escape_string($conn, $_POST['county']);
     $country = mysqli_real_escape_string($conn, $_POST['country']); 
     $postcode = mysqli_real_escape_string($conn, $_POST['postcode']);

    //Insert sql query
    $sql = "INSERT INTO student (studentid, password, dob, firstname, 
    lastname, house, town, county, country, postcode, profileimage) 
    VALUES ('{$_POST['studentid']}', '$hashed_password', 
                '{$_POST['dob']}', '$firstname', 
                '$lastname', '$house', '$town', '$county', 
                '$country','$postcode','$imagedata')";

     //run the query
    $result = mysqli_query($conn,$sql);

      $data['content'] = "<div class='alert alert-success mt-3' role='alert'>Student Record Added</div>";
    
       }
   }
   else {
  
      // using <<<EOD notation to allow building of a multi-line string
      // see http://stackoverflow.com/questions/6924193/what-is-the-use-of-eod-in-php for info
      // also http://stackoverflow.com/questions/8280360/formatting-an-array-value-inside-a-heredoc
      $data['content'] = <<<EOD

   <div class="container mt-3">
   <div class="card">
   <div class="card-header">
   <h2>Add New Student</h2>
   </div>
   <div class="card-body">
   <form name="frmdetails" action="" method="post" enctype="multipart/form-data">

   Student ID: 
   <input class="form-control mt-2 mb-2" name="studentid" type="text" value=""  />
   Password:
   <input class="form-control mt-2 mb-2" name="password" type="password" value=""  />
   Date of Birth: 
   <input class="form-control mt-2 mb-2" name="dob" type="date" value="" />
   First Name :
   <input class="form-control mt-2 mb-2" name="firstname" type="text" value="" />
   Surname :
   <input class="form-control mt-2 mb-2" name="lastname" type="text"  value="" />
   Number and Street :
   <input class="form-control mt-2 mb-2" name="house" type="text"  value="" />
   Town :
   <input class="form-control mt-2 mb-2" name="town" type="text"  value="" />
   County :
   <input class="form-control mt-2 mb-2" name="county" type="text"  value="" />
   Country :
   <input class="form-control mt-2 mb-2" name="country" type="text"  value="" />
   Postcode :
   <input class="form-control mt-2 mb-2" name="postcode" type="text"  value="" />
   Profile Picture :
   <input class="form-control mt-2 mb-2" name="profileimage" type="file" value="" />
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

} else {
   header("Location: index.php");
}

echo template("templates/partials/footer.php");

?>
