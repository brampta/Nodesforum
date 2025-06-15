<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();

if(!isset($_GET['color']))
{$_GET['color']='#000000';}
if(!isset($_GET['bgcolor']))
{$_GET['bgcolor']='#FFFFFF';}

$color = str_split(substr($_GET['color'],1,6),2);
$bgcolor = str_split(substr($_GET['bgcolor'],1,6),2);
foreach($color as $key => $value)
{
	$color[$key]=hexdec($value);
}
foreach($bgcolor as $key => $value)
{
	$bgcolor[$key]=hexdec($value);
}


//// generate 5 digit random number
//$rand = rand(10000, 99999);
//// create the hash for the random number and put it in the session
$session_name='img_ver_'.(addslashes($_GET['name']));
//$_SESSION[$session_name] = md5($rand);
//// create the image
//$image = imagecreate(49, 18);
//// use white as the background image
//$bgColor = imagecolorallocate ($image, $bgcolor[0], $bgcolor[1], $bgcolor[2]);
//// the text color is black
//$textColor = imagecolorallocate ($image, $color[0], $color[1], $color[2]);
//// write the random number
//imagestring ($image, 5, 2, 2, $rand, $textColor);
//// send several headers to make sure the image is not cached
//// taken directly from the PHP Manual
//// Date in the past
//header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
//// always modified
//header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
//// HTTP/1.1
//header("Cache-Control: no-store, no-cache, must-revalidate");
//header("Cache-Control: post-check=0, pre-check=0", false);
//// HTTP/1.0
//header("Pragma: no-cache");
//// send the content type header so the image is displayed properly
//header('Content-type: image/jpeg');
//// send the image to the browser
//imagejpeg($image);
//// destroy the image to free up the memory
//imagedestroy($image);

$permitted_chars = 'ABCDEFGHJKMNPQRSTUVWXYZ2345678abcdefghijkmnprstuvwxyz';
$string_length = 3;
$box_width = 100;
function secure_generate_string($input, $strength = 5, $secure = true)
{
	$input_length = strlen($input);
	$random_string = '';
	for ($i = 0; $i < $strength; $i++) {
		if ($secure) {
			$random_character = $input[random_int(0, $input_length - 1)];
		} else {
			$random_character = $input[mt_rand(0, $input_length - 1)];
		}
		$random_string .= $random_character;
	}
	return $random_string;
}

$image = imagecreatetruecolor($box_width, 50);
imageantialias($image, true);
$colors = [];
$red = rand(125, 175);
$green = rand(125, 175);
$blue = rand(125, 175);
for($i = 0; $i < 5; $i++) {
  $colors[] = imagecolorallocate($image, $red - 20*$i, $green - 20*$i, $blue - 20*$i);
}
imagefill($image, 0, 0, $colors[0]);
for($i = 0; $i < 10; $i++) {
  imagesetthickness($image, rand(2, 10));
  $rect_color = $colors[rand(1, 4)];
  imagerectangle($image, rand(-10, ($box_width-10)), rand(-10, 10), rand(-10, ($box_width-10)), rand(40, 60), $rect_color);
}

$black = imagecolorallocate($image, 0, 0, 0);
$white = imagecolorallocate($image, 255, 255, 255);
$textcolors = [$black, $white];
$fonts = [
    dirname(__FILE__).'/fonts/Acme-Regular.ttf',
    dirname(__FILE__).'/fonts/Ubuntu-Regular.ttf',
    dirname(__FILE__).'/fonts/Merriweather-Regular.ttf',
    dirname(__FILE__).'/fonts/PlayfairDisplay-VariableFont_wght.ttf',
    dirname(__FILE__).'/fonts/PlaypenSans-VariableFont_wght.ttf',
    dirname(__FILE__).'/fonts/Oswald-VariableFont_wght.ttf',
];
//var_dump('$fonts',$fonts);

$captcha_string = secure_generate_string($permitted_chars, $string_length);
$_SESSION[$session_name] = md5(strtolower($captcha_string));
for($i = 0; $i < $string_length; $i++) {
  $letter_space = ($box_width-30)/$string_length;
  $initial = 15;

  imagettftext($image, 20, rand(-15, 15), $initial + $i*$letter_space, rand(20, 40), $textcolors[rand(0, 1)], $fonts[array_rand($fonts)], $captcha_string[$i]);
}
header('Content-type: image/png');
imagepng($image);
imagedestroy($image);





