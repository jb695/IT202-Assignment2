<?php
session_set_cookie_params ( 0, "/~jb695/assignment2/" );
session_start();

if (!isset ($_SESSION["captchapass"] ) ) 
{
	echo "<br> Not authorized. Please enter Captcha to proceed." ;
	header ( "refresh: 3; url=captcha.html");
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


if( isset ( $_GET["ucid"] ) )
{
	
	$flag = true;
	$ucid = safe("ucid"); 
	$pass = safe("pass");
	$amount = safe("amount");
	$delay = safe("delay");


	if(! $flag ) 
	{
		echo " <br><br> Did not match RegEx pattern. Enter again." ;
		header ("refresh: $delay; url=authForm.php		"); 
		exit(); 
	}
	

	if(!auth($ucid,$pass))	
		
		{
		echo " <br><br> Failed to authenticate. Enter credentials again." ;
		header ("refresh: $delay; url=authForm.php		"); 
		exit(); 
		}
		
		else	
		
		{
		echo "<br><br> Successfully authenticated."	;
		$_SESSION["logged"] = true; 
		$_SESSION[ "ucid"] = $ucid; 
		header ("refresh: $delay; url=pin1.php		"); 
		exit(); 
		}		
}


?>

<form action = "authForm.php" autocomplete ="off" >

<input type = text name = "ucid" value = "<?php echo $ucid; ?>" >UCID<br>
<input type = text name = "pass" value = "<?php echo $pass; ?> ">Password<br>
<input type = text name = "amount" value = "<?php echo $amount; ?> ">Amount<br>
<input type=text name="delay" autocomplete = off > Enter Refresh Delay<br>

<input type =submit>

</form>
