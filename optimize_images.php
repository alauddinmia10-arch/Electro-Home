<?php
$src_dir = 'c:/Users/Hafeez Hameed/.gemini/antigravity-ide/brain/e6f5dbae-4c68-4b05-b875-86b465d1fc57/';
$dest_dir = 'c:/Users/Hafeez Hameed/.gemini/antigravity-ide/scratch/ElectroHome.BD/public/images/';

$mapping = [
    'media__1784733330756.png' => 'icon.webp',
    'media__1784733330736.png' => 'logo.webp',
    'media__1784733330808.png' => 'logo-dark.webp',
    'media__1784733330826.png' => 'monochrome.webp'
];

foreach ($mapping as $src => $dest) {
    $src_path = $src_dir . $src;
    $dest_path = $dest_dir . $dest;
    
    // Convert to webp with 80% quality (lossy) or keep alpha
    $img = imagecreatefrompng($src_path);
    imagepalettetotruecolor($img);
    imagealphablending($img, true);
    imagesavealpha($img, true);
    imagewebp($img, $dest_path, 80);
    imagedestroy($img);
    
    echo "Converted $src to $dest\n";
}

// Generate favicon from icon
$icon_src = $src_dir . 'media__1784733330756.png';
$favicon_dest = 'c:/Users/Hafeez Hameed/.gemini/antigravity-ide/scratch/ElectroHome.BD/public/favicon.png';
$img = imagecreatefrompng($icon_src);
$favicon = imagecreatetruecolor(64, 64);
imagealphablending($favicon, false);
imagesavealpha($favicon, true);
$transparent = imagecolorallocatealpha($favicon, 255, 255, 255, 127);
imagefilledrectangle($favicon, 0, 0, 64, 64, $transparent);
imagecopyresampled($favicon, $img, 0, 0, 0, 0, 64, 64, imagesx($img), imagesy($img));
imagepng($favicon, $favicon_dest, 9);
imagedestroy($favicon);
imagedestroy($img);

echo "Generated favicon.png\n";
