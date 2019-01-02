<?php

require_once('util.php');


$files = glob($base_path . "/*.html");

$notes = [];
for ($i = 0; $i < count($files); $i++) {
	$filename = $files[$i];
	$note = substr($filename, strrpos($filename, '/') + 1);
	$note = substr($note, 0, strlen($note) - strlen('.html'));
	$notes[] = $note;
}

set_return_mime("application/json");
echo(json_encode(array("error" => "none", "notes" => $notes), JSON_PRETTY_PRINT));