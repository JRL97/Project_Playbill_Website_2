<?php

   include("_includes/config.inc");
   include("_includes/dbconnect.inc");
   include("_includes/functions.inc");

   require_once 'vendor/autoload.php';

   $faker = Faker\Factory::create();

   
   for ($i=0; $i < 5; $i++) {

      $student_id =  $faker->unique()->numberBetween(20000001, 29999999);

      $sql = "INSERT INTO student (studentid, password, dob, firstname, 
      lastname, house, town, county, country, postcode)
      VALUES ('$student_id', '{$faker->password}', 
      '{$faker->date}', '{$faker->firstName}', '{$faker->lastName}', '{$faker->address}', 
      '{$faker->city}', '{$faker->state}', '{$faker->country}', '{$faker->postcode}')";
      $result = mysqli_query($conn,$sql);
      echo "Student number " . $i . " has been added to the database! ";
    } 
    
  
?>
