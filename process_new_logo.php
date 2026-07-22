<?php
$src = 'c:/Users/Hafeez Hameed/.gemini/antigravity-ide/brain/e6f5dbae-4c68-4b05-b875-86b465d1fc57/media__1784737400890.png';
$dest = 'c:/Users/Hafeez Hameed/.gemini/antigravity-ide/scratch/ElectroHome.BD/public/images/logo-white-text.webp';
$img = imagecreatefrompng($src);
imagepalettetotruecolor($img);
imagealphablending($img, true);
imagesavealpha($img, true);
imagewebp($img, $dest, 80);
imagedestroy($img);

echo "Optimized new footer logo-white-text.webp\n";
