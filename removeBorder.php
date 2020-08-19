<?php
/*////////////////////////////////////////////////////////////////////////////////////////////////////
// Define an 'acceptable' level of blackness to remove from the border.
//
// As the black border approaches the image, it stops being rgb(0,0,0) and will start to randomly
// become close-to-black levels e.g rgb(0,8,2), invisible to the eye but annoying.
//
// Modify the 'tolerance' variable, any number in the rgb index lower than the one specified will be
// removed. Be careful though, set it too high and you may remove legitimate parts of the image.
////////////////////////////////////////////////////////////////////////////////////////////////////*/

$image_path = $argv[1];
$tolerance = 25;

/*////////////////////////////////////////////////////////////////////////////////////////////////////
// Begin removing black border from top and bottom
//
// The script loops through the first pixel on each line of the image, it then checks if the pixel
// rgb index value is lower than the tolerance value set above.
////////////////////////////////////////////////////////////////////////////////////////////////////*/

$jpg = imagecreatefromjpeg($image_path); // Generate temporary jpg

$removeTop = 0;
for ($y = 0; $y < imagesy($jpg); $y++) {
  $rgbIndex = imagecolorsforindex($jpg, imagecolorat($jpg, 0, $y));
  if ($rgbIndex['red'] <= $tolerance && $rgbIndex['blue'] <= $tolerance && $rgbIndex['green'] <= $tolerance){ $removeTop += 1; } else { break; }
}

$removeBottom = 0;
for ($y = imagesy($jpg)-1; $y > 0; $y--) {
  $rgbIndex = imagecolorsforindex($jpg, imagecolorat($jpg, 0, $y));
  if ($rgbIndex['red'] <= $tolerance && $rgbIndex['blue'] <= $tolerance && $rgbIndex['green'] <= $tolerance){ $removeBottom += 1; } else { break; }
}

/*////////////////////////////////////////////////////////////////////////////////////////////////////
// Generate and overwrite the original image (the server must have php*-*-gd installed)
////////////////////////////////////////////////////////////////////////////////////////////////////*/

$cropped = imagecreatetruecolor(imagesx($jpg), imagesy($jpg) - ($removeTop + $removeBottom));
imagecopy($cropped, $jpg, 0, 0, 0, $removeTop, imagesx($cropped), imagesy($cropped));

header("Content-type: image/jpeg");
// imagejpeg($cropped); // Use this if you're calling the script on the front-end to display the new image
imagejpeg($cropped, $image_path); // Use this if you're calling the script on the back-end to overwrite the image on your server
imagedestroy($cropped);
imagedestroy($jpg);
?>

