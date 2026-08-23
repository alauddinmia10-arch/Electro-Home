<?php
$img = imagecreatefromwebp('public/images/logo-header.webp');
$w = imagesx($img);
$h = imagesy($img);
$colors = [];
for($x=0;$x<$w;$x++) {
    for($y=0;$y<$h;$y++) {
        $rgb = imagecolorat($img, $x, $y);
        $r = ($rgb >> 16) & 0xFF;
        $g = ($rgb >> 8) & 0xFF;
        $b = $rgb & 0xFF;
        $hex = sprintf('#%02x%02x%02x', $r, $g, $b);
        if($g > $r + 20 && $g > $b + 20) {
            if(!isset($colors[$hex])) $colors[$hex] = 0;
            $colors[$hex]++;
        }
    }
}
arsort($colors);
$i=0;
foreach($colors as $hex => $count) {
    echo "$hex => $count\n";
    if(++$i > 5) break;
}
