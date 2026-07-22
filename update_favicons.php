<?php
$src1 = 'c:/Users/Hafeez Hameed/.gemini/antigravity-ide/brain/e6f5dbae-4c68-4b05-b875-86b465d1fc57/media__1784738130018.png';
$src2 = 'c:/Users/Hafeez Hameed/.gemini/antigravity-ide/brain/e6f5dbae-4c68-4b05-b875-86b465d1fc57/media__1784738149510.png';

$dest1 = 'c:/Users/Hafeez Hameed/.gemini/antigravity-ide/scratch/ElectroHome.BD/public/favicon-light.png';
$dest2 = 'c:/Users/Hafeez Hameed/.gemini/antigravity-ide/scratch/ElectroHome.BD/public/favicon-dark.png';

function resizeAndSave($src, $dest) {
    $img = imagecreatefrompng($src);
    imagepalettetotruecolor($img);
    imagealphablending($img, true);
    imagesavealpha($img, true);
    
    $w = imagesx($img);
    $h = imagesy($img);
    
    $favicon = imagecreatetruecolor(64, 64);
    imagealphablending($favicon, false);
    imagesavealpha($favicon, true);
    
    $transparent = imagecolorallocatealpha($favicon, 255, 255, 255, 127);
    imagefilledrectangle($favicon, 0, 0, 64, 64, $transparent);
    
    imagecopyresampled($favicon, $img, 0, 0, 0, 0, 64, 64, $w, $h);
    
    imagepng($favicon, $dest, 9);
    imagedestroy($favicon);
    imagedestroy($img);
}

resizeAndSave($src1, $dest1);
resizeAndSave($src2, $dest2);

echo "Updated both favicons\n";
