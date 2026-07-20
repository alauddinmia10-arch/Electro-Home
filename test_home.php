<?php
$ch = curl_init('http://127.0.0.1:8000/');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$res = curl_exec($ch);
$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
echo "CODE: $code\n";
if ($code >= 400) {
    echo substr(strip_tags($res), 0, 1000);
}
