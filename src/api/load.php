<?php

require_once('util.php');

$name = $_GET["name"];
$name = $result = preg_replace("/[^a-zA-Z0-9]/", "_", $name);

$full_path = $base_path . "/" . $name . ".html";

if (!file_exists($full_path)) {
	error(404, "not_found", "Could not find note");
}

$file = fopen($full_path, 'r') or error(500, "server_error", "Could not open resource");
set_return_mime("text/html");
echo(fread($file, filesize($full_path)));
fclose($file);