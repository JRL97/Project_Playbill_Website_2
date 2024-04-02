<?php

include "passwordLib.php";

/**
 * Validate Admin Login function
 *
 * @param $ausername        - admin user name 
 * @param $apassword  - admin plaintext password
 * @return boolean   - returns true or false depending on successful authentication of user.
 */
function validateadminlogin($ausername,$apassword) {
   global $conn;
   // Build an SQL statment that will return a record with a matching username
   $sql = "select * from admin where username='$ausername';";
	//echo $sql;
   $loginresult = mysqli_query($conn, $sql);
   $admindetails = mysqli_fetch_assoc($loginresult);
	//print_r($admindetails);

	// use PHP's verify_password function to check whether the stored
	// hash matches the given password
	if (password_verify($password, $admindetails['password'])) {
		$_SESSION['id'] = $ausername;
		return true;
	}
	else {
		$_SESSION['id'] = '';
		return false;
	}
}

/**
 * Validate User Login function
 *
 * @param $uusername        - users username
 * @param $upassword  - user plaintext password
 * @return boolean   - returns true or false depending on successful authentication of user.
 */
function validateuserlogin($uusername,$upassword) {
   global $conn;
   // Build an SQL statment that will return a record with a matching id
   $sql = "select * from users where username='$uusername';";
	//echo $sql;
   $loginresult = mysqli_query($conn, $sql);
   $userdetails = mysqli_fetch_assoc($loginresult);
	//print_r($userdetails);

	// use PHP's verify_password function to check whether the stored
	// hash matches the given password
	if (password_verify($password, $userdetails['password'])) {
		$_SESSION['id'] = $uusername;
		return true;
	}
	else {
		$_SESSION['id'] = '';
		return false;
	}
}


/**
 * Simple Templating function
 *
 * @param $file   - Path to the PHP file that acts as a template.
 * @param $args   - (optional) Associative array of variables to pass to the template file.
 * @return string - Output of the template file. Likely HTML.
 *
 * Source: http://www.daggerhart.com/create-simple-php-templating-function/
 */
function template( $file, $args=array() ){
   // ensure the file exists
   if ( !file_exists( $file ) ) {
      return '';
   }

   // Make values in the associative array easier to access by extracting them
   if ( is_array( $args ) ){
      extract( $args );
   }

   // buffer the output (including the file is "output")
   ob_start();
   include $file;
   return ob_get_clean();
}

?>
