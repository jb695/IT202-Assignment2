<?php
session_set_cookie_params ( 0, "/~jb695/assignment2/" );
session_start();

$guess = $_GET["captcha"]; 
$delay = $_GET["delay"];

$actual = $_SESSION["captcha"]; 

if($guess == $actual ) 

	{ 
	   echo "Correct Captcha. Redirecting...<br>";
	   $_SESSION["captchapass"] = true;
	   header("refresh:$delay; url = authForm.php");
	} 
	
else 
	{
		echo "Wrong Captcha. Try again. Redirecting...<br>";
		header("refresh:$delay; url = captcha.html");
		exit();
	}
	
?>