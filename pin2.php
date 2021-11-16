<?php
session_set_cookie_params ( 0, "/~jb695/assignment2/" );
session_start();

if (!isset ($_SESSION["logged"] ) ) 
{
	echo "<br> Not authorized. Please enter Captcha to proceed." ;
	header ( "refresh: 2; url=captcha.html");
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
  


echo "Verifying PIN match. <br>";

//get pin submitted from the form
$pin1 = safe("pin"); 
//get remembered pin from $_SESSION
$pin2 = $_SESSION["pin"];
echo "<br> The randomly generated PIN is:  $pin2" ;


if($pin1 == $pin2)
{
	echo "<br><br> Successful PIN Match!      Redirecting... " ;
	$_SESSION["pinpass"] = true; 
	header ( "refresh: 2; url=service1.php");
	exit();
}

else							
	{
	echo "<br><br> PIN match failed. Please reenter."	;
	header ("refresh:	2; url=pin1.php		"); 
	exit(); 
	}	

?>