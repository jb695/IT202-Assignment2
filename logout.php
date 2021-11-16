<?php
session_set_cookie_params ( 0, "/~jb695/assignment2/" );
session_start();

error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display errors', 1);


$sidvalue = session_id(); 
echo "<br>Your session id: " . $sidvalue . "<br>";

$_SESSION = array();		//Make $_SESSION  empty
session_destroy();			//Terminate session on server
setcookie("PHPSESSID", "", time()-3600, '/~jb695/assignment2/', "", 0,0);

echo "Your session is terminated."; 

?>
