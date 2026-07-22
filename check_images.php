<?php
$files = glob('c:/Users/Hafeez Hameed/.gemini/antigravity-ide/brain/e6f5dbae-4c68-4b05-b875-86b465d1fc57/media__1784733330*.png');
foreach($files as $f){
    $size = getimagesize($f);
    echo basename($f) . " - " . $size[0] . "x" . $size[1] . "\n";
}
