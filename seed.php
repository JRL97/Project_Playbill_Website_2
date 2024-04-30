<?php

   include("_includes/config.inc");
   include("_includes/dbconnect.inc");
   include("_includes/functions.inc");

  
    //Password hasing: 
     //$hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
   
    $sql = "CREATE TABLE user (user_id INT(25) AUTO_INCREMENT PRIMARY KEY, username VARCHAR(25) NOT NULL, 
    password VARCHAR(100) NOT NULL, firstname VARCHAR(25) NOT NULL, lastname VARCHAR(25) NOT NULL,
     email VARCHAR(50) NOT NULL)";


     $result = mysqli_query($conn, $sql);

     //Insert fake data into user table
     
     require_once 'vendor/autoload.php';

    $faker = Faker\Factory::create();

    for ($i=0; $i < 4; $i++) {

      $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
      $unique_email = $faker->unique()->safeEmail;

    $sql = "INSERT INTO user (username, password, firstname, lastname, email)
    VALUES ('{$faker->username}', '$hashed_password', '{$faker->firstname}', '{$faker->lastname}',
    '$unique_email')";

     $result = mysqli_query($conn, $sql);

     echo "User number " . $i . "has been added to the database!";
    }
?>
