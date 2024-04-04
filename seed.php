<?php

   include("_includes/config.inc");
   include("_includes/dbconnect.inc");
   include("_includes/functions.inc");

   //Faker Library Composer Required
   /*  require_once 'vendor/autoload.php';

   // New instance of Faker Library
   $faker = Faker\Factory::create();

   //Insert 5 users with unique IDs into database
   for ($i=0; $i < 5; $i++) {

      $student_id =  $faker->unique()->numberBetween(20000001, 29999999);

      $sql = "INSERT INTO student (studentid, password, dob, firstname, 
      lastname, house, town, county, country, postcode)
      VALUES ('$student_id', '{$faker->password}', 
      '{$faker->date}', '{$faker->firstName}', '{$faker->lastName}', '{$faker->address}', 
      '{$faker->city}', '{$faker->state}', '{$faker->country}', '{$faker->postcode}')";
      $result = mysqli_query($conn,$sql);

      //echo out each student successfullhy created
      echo "Student number " . $i . " has been added to the database! ";
    } 



    Password hasing: 
     $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    */
   
    $sql = "CREATE TABLE user (user_id INT(25) AUTO_INCREMENT PRIMARY KEY, username VARCHAR(25) NOT NULL, 
    password VARCHAR(100) NOT NULL, firstname VARCHAR(25) NOT NULL, lastname VARCHAR(25) NOT NULL,
     email VARCHAR(50) NOT NULL)";


     $result = mysqli_query($conn, $sql);

     
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
