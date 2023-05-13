<?php

   include("_includes/config.inc");
   include("_includes/dbconnect.inc");
   include("_includes/functions.inc");

   require_once 'vendor/autoload.php';

   //check if we are logged in
   //if (isset($_SESSION['id'])) {
    // build inster query 
    // run query 
    //x5

    $faker = Faker\Factory::create();

   
    for ($i=0; $i < 5; $i++) {

      $student_id =  $faker->unique()->numberBetween(20000001, 29999999);

     $sql = "INSERT INTO student (studentid, password, dob, firstname, 
      lastname, house, town, county, country, postcode)
      VALUES ('$student_id', '{$faker->password}', 
      '{$faker->date}', '{$faker->firstName}', '{$faker->lastName}', '{$faker->word}', 
      '{$faker->city}', '{$faker->city}', '{$faker->country}', '{$faker->postcode}')";

   
    } 
    $result = mysqli_query($conn,$sql);
    echo "5 records successfully inserted.";
?>
