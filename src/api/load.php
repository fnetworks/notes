<?php

require_once('util.php');

if (isset($_GET["name"])) {
	$id = fullNameToID($_GET["name"]);
} else {
	error(400, "missing_argument", "load needs a name");
}

$full_path = getPathForID($id);

if (!file_exists($full_path)) {
	error(404, "not_found", "Could not find note");
}

set_return_mime("text/html");
echo(tryReadFile($full_path));