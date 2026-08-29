<?php
$html = file_get_contents("https://electrohome-app.onrender.com/debug-error");
preg_match("/<pre>(.*?)<\/pre>/s", $html, $matches);
file_put_contents("parsed.log", html_entity_decode($matches[1] ?? "No match"));
echo "Saved.";
