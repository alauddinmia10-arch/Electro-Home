<?php
$log = file_get_contents("https://electrohome-app.onrender.com/debug-error");
file_put_contents("full_laravel.log", $log);
echo "Log saved. Size: " . strlen($log) . " bytes\n";
