<?php
session_set_cookie_params ( 0, "/~jb695/assignment2/" );
session_start();

if (!isset ($_SESSION["pinpass"] ) ) 
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


echo '<a href="logout.php">Click here to logout!</a>';
echo '<br><br><a href="service1.php">Click here to go back to the list of services!</a><br><br>'; 
  
$ucid = $_SESSION["ucid"];





$choice = safe("choice");

if($choice == "List")
	{
		$number = safe("number");
		retrieve($ucid, $number);
	}

if($choice == "Perform")
	
	{
		$account = safe("account");
		$amount = safe("amount");
		transact($ucid, $account, $amount);
		
	}
	
if($choice == "Clear")
	
	{
		$account = safe("account"); 
		clear($ucid, $account);
	}
	

?>
