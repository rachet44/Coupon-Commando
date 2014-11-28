<?php

function watermark($imgname) {

$dest = imagecreatefromjpeg($imgname);
$src = imagecreatefromjpeg('http://www.google.com/intl/en_ALL/images/logo.gif');


imagecopymerge($dest, $src, 1, 10, 0, 0, 700, 247, 75);

// Output and free from memory

header('Content-Type: image/jpeg');

$name = md5(uniqid());

imagejpeg($dest,"temp/$name.jpeg");

imagedestroy($dest);
imagedestroy($src);

return "temp/$name.jpeg";
}

 ?>
