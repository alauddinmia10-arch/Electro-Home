<?php
$files = glob('c:/Users/Hafeez Hameed/.gemini/antigravity-ide/brain/e6f5dbae-4c68-4b05-b875-86b465d1fc57/media__1784733330*.png');
foreach($files as $f){
    $img = imagecreatefrompng($f);
    $w = imagesx($img);
    $h = imagesy($img);
    $has_color = false;
    $is_dark = false;
    $non_transparent_pixels = 0;
    
    // Sample pixels to determine type
    $dark_pixels = 0;
    $light_pixels = 0;
    $green_pixels = 0;
    
    for($x = 0; $x < $w; $x+=10){
        for($y = 0; $y < $h; $y+=10){
            $rgba = imagecolorat($img, $x, $y);
            $colors = imagecolorsforindex($img, $rgba);
            if ($colors['alpha'] < 127) { // Not fully transparent
                $non_transparent_pixels++;
                $r = $colors['red'];
                $g = $colors['green'];
                $b = $colors['blue'];
                
                $brightness = ($r * 299 + $g * 587 + $b * 114) / 1000;
                
                if (abs($r-$g) > 20 || abs($g-$b) > 20) {
                    $has_color = true;
                    // Check if it's green
                    if ($g > $r + 20 && $g > $b + 20) {
                        $green_pixels++;
                    }
                }
                
                if ($brightness < 50) $dark_pixels++;
                if ($brightness > 200) $light_pixels++;
            }
        }
    }
    
    echo basename($f) . ": Has Color? " . ($has_color ? 'Yes' : 'No') . 
         " | Green Px: $green_pixels | Dark Px: $dark_pixels | Light Px: $light_pixels | Total: $non_transparent_pixels\n";
}
