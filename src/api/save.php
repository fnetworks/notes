<?php

require_once('util.php');

$content = file_get_contents('php://input');
$overwrite = $_GET["overwrite"];
$name = $_GET["name"];

// Input conversion/validation
$name = $result = preg_replace("/[^a-zA-Z0-9]/", "_", $name);
$overwrite = filter_var($overwrite, FILTER_VALIDATE_BOOLEAN);
$content = strip_tags($content, '<h1><h2><h3><h4><h5><h6><p><b><strong><i><div><br><li><ul><ol><pre><a><figure><tr><td><table><thead><tbody>');
$content = preg_replace("/(?!href|class)+=\".*?\"/", "", $content);

$full_path = $base_path . "/" . $name . ".html";

if (file_exists($full_path) && !$overwrite) {
	error(409, "already_exists", "The file already exists. Use \"overwrite=true\" to overwrite.");
}

$file = fopen($full_path, 'w') or error(500, "server_error", "Could not open resource");
fwrite($file, $content);
fclose($file);

normal_exit();