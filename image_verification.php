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


// generate 5 digit random number
$rand = rand(10000, 99999);
// create the hash for the random number and put it in the session
$session_name='img_ver_'.(addslashes($_GET['name']));
$_SESSION[$session_name] = md5($rand);
// create the image
$image = imagecreate(49, 18);
// use white as the background image
$bgColor = imagecolorallocate ($image, $bgcolor[0], $bgcolor[1], $bgcolor[2]);
// the text color is black
$textColor = imagecolorallocate ($image, $color[0], $color[1], $color[2]);
// write the random number
imagestring ($image, 5, 2, 2, $rand, $textColor);
// send several headers to make sure the image is not cached
// taken directly from the PHP Manual
// Date in the past
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
// always modified
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
// HTTP/1.1
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
// HTTP/1.0
header("Pragma: no-cache");
// send the content type header so the image is displayed properly
header('Content-type: image/jpeg');
// send the image to the browser
imagejpeg($image);
// destroy the image to free up the memory
imagedestroy($image);
?>

