<?php
$html = file_get_contents("https://electrohome-app.onrender.com/debug-error");
preg_match("/<pre>(.*?)<\/pre>/s", $html, $matches);
$log = html_entity_decode($matches[1] ?? "");
// We only have the last 100 lines here. The actual error might be earlier.
// Wait! If the user just visited, the error is at the very end of the file.
// Let's just download the raw file? I can't download the raw file because there is no route for it!
