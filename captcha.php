<?php
session_start();  
$rand_num = rand(1000000,9999999); 
$rand_new = substr($rand_num,0,4); 
$img = imagecreate(50, 15); 
$img_color = imagecolorallocate($img, 255, 255, 255); 
$textcolor = imagecolorallocate($img, 00, 000, 000); 
imagestring($img, 5, 0, 0, $rand_new, $textcolor); 
header("Content-type: image/jpeg"); 
imagejpeg($img);   
$_SESSION['cap_sess'] = $rand_new;   
?>
