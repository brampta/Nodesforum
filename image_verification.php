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

define('CAPTCHA_LENGHT',3);
define('CAPTCHA_WIDTH',360);
define('CAPTCHA_HEIGHT',220);
define('CAPTCHA_FONTSIZE_MIN',85);
define('CAPTCHA_FONTSIZE_MAX',125);
// Define a margin (safe zone) in pixels
$margin = 50; // Adjust as needed

$permitted_chars = 'ABCDEFGHJKMNPQRSTUVWXYZ2345678abcdefghijkmnprstuvwxyz';
$string_length = CAPTCHA_LENGHT;
$box_width = CAPTCHA_WIDTH;
$box_height = CAPTCHA_HEIGHT;
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

function apply_wave_distortion($src, $width, $height, $amplitude = 5, $period = 30) {
    $dst = imagecreatetruecolor($width, $height);
    imagealphablending($dst, false);
    imagesavealpha($dst, true);
    $transparent = imagecolorallocatealpha($dst, 0, 0, 0, 127);
    imagefill($dst, 0, 0, $transparent);

    for ($y = 0; $y < $height; $y++) {
        $offset = (int)($amplitude * sin(2 * M_PI * $y / $period));
        for ($x = 0; $x < $width; $x++) {
            $src_x = $x + $offset;
            if ($src_x >= 0 && $src_x < $width) {
                $color = imagecolorat($src, $src_x, $y);
                // preserve alpha
                $rgba = imagecolorsforindex($src, $color);
                $color = imagecolorallocatealpha($dst, $rgba['red'], $rgba['green'], $rgba['blue'], $rgba['alpha']);
                imagesetpixel($dst, $x, $y, $color);
            }
        }
    }
    return $dst;
}

$image = imagecreatetruecolor($box_width, $box_height);
imageantialias($image, true);
$colors = [];
$red = rand(100, 200);
$green = rand(100, 200);
$blue = rand(100, 200);
for($i = 0; $i < 5; $i++) {
  $colors[] = imagecolorallocate($image, $red - 20*$i, $green - 20*$i, $blue - 20*$i);
}
imagefill($image, 0, 0, $colors[0]);
for($i = 0; $i < 10; $i++) {
  imagesetthickness($image, rand(2, 10));
  $rect_color = $colors[rand(1, 4)];
  imagerectangle($image, rand(-10, ($box_width-10)), rand(-10, 10), rand(-10, ($box_width-10)), rand($box_height-10, $box_height+10), $rect_color);
}

$image = apply_wave_distortion($image, $box_width, $box_height, rand(4,48), rand(85,160));

// $black = imagecolorallocate($image, 0, 0, 0);
// $white = imagecolorallocate($image, 255, 255, 255);
// $textcolors = [$black, $white];

$letter_colors = [];
$shadow_colors = [];
for ($i = 0; $i < $string_length; $i++) {
    $letter_colors[] = imagecolorallocate(
        $image,
        rand(0, 200), // Red
        rand(0, 200), // Green
        rand(0, 200)  // Blue
    );
    // Generate a contrasting shadow color (brighter or darker)
    $shadow_colors[] = imagecolorallocate(
        $image,
        rand(150, 255), // Red
        rand(150, 255), // Green
        rand(150, 255)  // Blue
    );
}

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

//for debug, do not leave on!!! it would compromise security
//$_SESSION[$session_name.'_raw'] = $captcha_string;

$_SESSION[$session_name] = md5(strtolower($captcha_string));

// Create a transparent image for the letters
$letters_layer = imagecreatetruecolor($box_width, $box_height);
imagealphablending($letters_layer, false);
imagesavealpha($letters_layer, true);
$transparent = imagecolorallocatealpha($letters_layer, 0, 0, 0, 127);
imagefill($letters_layer, 0, 0, $transparent);

// Calculate available width for letters
$available_width = $box_width - 2 * $margin;
$letter_space = $available_width / $string_length;
$initial = $margin;

for($i = 0; $i < $string_length; $i++) {
  //$letter_space = ($box_width-30)/$string_length;

  $font_size = rand(CAPTCHA_FONTSIZE_MIN,CAPTCHA_FONTSIZE_MAX);
  
  $angle = rand(-35, 35);
  $x = $initial + $i*$letter_space;
  $y = rand(($font_size+10), (CAPTCHA_HEIGHT-10));
  $font = $fonts[array_rand($fonts)];
  
  //imagettftext($image, $font_size, rand(-15, 15), $initial + $i*$letter_space, rand( ($font_size+10), (CAPTCHA_HEIGHT-10)), $textcolors[rand(0, 1)], $fonts[array_rand($fonts)], $captcha_string[$i]);
  // Draw shadow
  imagettftext(
      $image,
      $font_size,
      $angle,
      $x + 2, // Shadow offset X
      $y + 2, // Shadow offset Y
      $shadow_colors[$i],
      $font,
      $captcha_string[$i]
  );
  // Draw main letter
  imagettftext(
      $image,
      $font_size,
      $angle,
      $x,
      $y,
      $letter_colors[$i],
      $font,
      $captcha_string[$i]
  );
}

$image = apply_wave_distortion($image, $box_width, $box_height, rand(9, 11), rand(43, 111));





// Create a transparent layer for the lines
$lines_layer = imagecreatetruecolor($box_width, $box_height);
imagealphablending($lines_layer, false);
imagesavealpha($lines_layer, true);
$transparent = imagecolorallocatealpha($lines_layer, 0, 0, 0, 127);
imagefill($lines_layer, 0, 0, $transparent);

// Draw many colorful lines
for ($i = 0; $i < 18; $i++) {
    $line_color = imagecolorallocate($lines_layer, rand(80,255), rand(80,255), rand(80,255));
    imagesetthickness($lines_layer, rand(1, 4));
    imageline(
        $lines_layer,
        rand(0, $box_width-1), rand(0, $box_height-1),
        rand(0, $box_width-1), rand(0, $box_height-1),
        $line_color
    );
}

// Distort the lines layer
$lines_layer = apply_wave_distortion($lines_layer, $box_width, $box_height, rand(7, 18), rand(30, 80));

// Overlay the distorted lines on top of the main image
imagealphablending($image, true); // Enable alpha blending on the main image
imagecopy($image, $lines_layer, 0, 0, 0, 0, $box_width, $box_height);
imagedestroy($lines_layer);







header('Content-type: image/png');
imagepng($image);
imagedestroy($image);





