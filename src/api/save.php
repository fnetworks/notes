<?php

require_once('util.php');

if (isset($_GET["overwrite"])) {
	$overwrite = filter_var($_GET["overwrite"], FILTER_VALIDATE_BOOLEAN);
} else {
	$overwrite = false;
}


if (isset($_GET["name"])) {
	$name = $_GET["name"];
} else {
	error(400, "missing_argument", "save needs a name");
}

$id = fullNameToID($name);

$content = file_get_contents('php://input');
$content = strip_tags($content, '<h1><h2><h3><h4><h5><h6><p><b><strong><i><div><br><li><ul><ol><pre><a><figure><tr><td><table><thead><tbody>');
$content = preg_replace("/(?!href|class)+=\".*?\"/", "", $content);

$full_path = getPathForID($id);

$files = getIndex();

if (in_array($id, $files) && !$overwrite) {
	error(409, "already_exists", "The file already exists.");
} else {
	tryWriteFile($full_path, $content);
	$files[$name] = $id;
	writeIndex($files);
}

normal_exit();