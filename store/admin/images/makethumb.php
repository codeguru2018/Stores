<?php
$filename = "celery.png";
$image = file_get_contents($filename);
$source = imagecreatefromstring($image);

$width = imagesx($source);
$height = imagesy($source);

$newwidth = $width/$height*60;
echo "<b>Original Image Dimensions:</b> <br>";
echo 'Pixel width from imagesx function = '. "$width<br>";
echo 'Pixel height from imagesy function= '. "$height<br>";
echo "<p>New width proportional to the old image resized to a height of 60 pixels = ".  "$newwidth</p>";

$thumb = imagecreatetruecolor($newwidth, 60);
imagecopyresampled($thumb, $source, 0, 0, 0, 0, $newwidth, 60, $width, $height);
#bool imagecopyresampled ( resource $dst_image , resource $src_image , int $dst_x , int $dst_y , int $src_x , int $src_y , int $dst_w , int $dst_h , int $src_w , int $src_h )

$ext = substr(strrchr($filename, '.'), 1);

if ($ext = "jpg")
{
imagejpeg($thumb, "newthumb.jpg");	
}
elseif ($ext = "png")
{
imagepng($thumb, "newthumb.png");
}
elseif ($ext = "gif")
{
imagegif($thumb, "newthumb.gif");
}
else
{
imagebmp($thumb, "newthumb.bmp");
}
echo "image created <br>";

?>
