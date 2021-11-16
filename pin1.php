<?php
session_set_cookie_params ( 0, "/~jb695/assignment2/" );
session_start(); 

if(!isset($_SESSION["logged"] )) //if SESSION is undefined, then they didn't pass login test

{
	echo " <br> Not authorized. Please enter Captcha to proceed." ;
	header ("refresh:	2; url=captcha.html		"); 
	exit(); 
}
include (  "account.php"     ) ;
include ("myfunctions2.php"); 

error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display errors', 1);

$db = mysqli_connect($hostname, $username, $password, $project);

if (mysqli_connect_errno())
  {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  exit();
  }
mysqli_select_db( $db, $project ); 
  
 

echo "PIN Handling.";

//make pin
$pin = mt_rand ( 1000 , 9999 );
//mail pin
$subject = "Your Pin";
$message  = $pin;
$to   = "jb695@njit.edu";   //spam
mail ( $to, $subject, $message );
//remember the pin
$_SESSION["pin"] = $pin;

echo "<br>The randomly generated pin is: $pin";

?>

<form action = "pin2.php" autocomplete ="off" >

<input type = text name = "pin" > Enter Pin
<input type = submit >
</form>
