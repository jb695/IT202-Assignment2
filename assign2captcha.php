<?php
session_set_cookie_params ( 0, "/~jb695/assignment2/" );
session_start(); 

header("Content-Type: image/png" ); //generates a header based on PNG file

$font = "Yokelvision-J6yx.ttf"; //imports the font files and stores to a variable value
$font2 = "ninja-naruto.ttf";

$im = imagecreatetruecolor( 600, 200 ); //600x200 dimensions, black square


$blue = imagecolorallocate ( $im, 0, 0, 255 ); //creates a variable filling with the ID # for blue
$green = imagecolorallocate ( $im, 0,128,0 ); //creates a variable filling with the ID # for green
$yellow = imagecolorallocate($im, 255,255,0);
$black = imagecolorallocate ( $im, 0, 0, 0 );

imagefilledrectangle($im, 10, 10, 590, 190, $yellow );  //references image object, places a rectangle based on coordinates and color
imagefill($im, 0, 0, $blue); //references image object, changes default black color to blue




$sidvalue = session_id(); //stores session value in a variable
$text1 = substr (str_shuffle (md5 ( time() ) ), 0, 2); //creates a random string of two characters
$text2 = substr (str_shuffle (md5 ( time() ) ), 0, 2);
$_SESSION["captcha"] = $text1.$text2; //dot is javascript concatenator, store in session variable
//so it's usable in other files

imagettftext($im, 20 , -20, 100, 50, $blue, $font, $text1); //displays specified text based on given parameters
imagettftext($im, 20 , -40, 500, 100, $green, $font, $text2);
imagettftext($im, 13 , 0, 30, 165, $black, $font2, "Session ID: $sidvalue");
imagettftext($im, 13 , 0, 30, 185, $black, $font2, "Captcha: $text1$text2");

//parameters are image source, font size, angle, x axis, y axis, color, font, text
 

imagepng($im); //creates the image
imagedestroy($im); //destroys it so it doesn't keep on existing after terimnation.

?>