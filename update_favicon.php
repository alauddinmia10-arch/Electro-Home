<?php
$src = 'c:/Users/Hafeez Hameed/.gemini/antigravity-ide/brain/e6f5dbae-4c68-4b05-b875-86b465d1fc57/media__1784737727280.jpg';
$dest = 'c:/Users/Hafeez Hameed/.gemini/antigravity-ide/scratch/ElectroHome.BD/public/favicon.png';

$img = imagecreatefromjpeg($src);

// Resize it to 64x64 for a standard favicon size if we want, or just 128x128
$w = imagesx($img);
$h = imagesy($img);

$favicon = imagecreatetruecolor(64, 64);
imagecopyresampled($favicon, $img, 0, 0, 0, 0, 64, 64, $w, $h);

imagepng($favicon, $dest, 9);
imagedestroy($favicon);
imagedestroy($img);

echo "Updated favicon.png\n";
