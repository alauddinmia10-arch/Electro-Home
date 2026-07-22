<?php
$src = 'c:/Users/Hafeez Hameed/.gemini/antigravity-ide/brain/e6f5dbae-4c68-4b05-b875-86b465d1fc57/media__1784734739036.png';
$dest = 'c:/Users/Hafeez Hameed/.gemini/antigravity-ide/scratch/ElectroHome.BD/public/images/logo.webp';
$img = imagecreatefrompng($src);
imagepalettetotruecolor($img);
imagealphablending($img, true);
imagesavealpha($img, true);
imagewebp($img, $dest, 75);
imagedestroy($img);

echo "Optimized new logo.webp\n";
