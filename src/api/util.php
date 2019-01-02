<?php

define('_NOTES_DEBUG', FALSE);

$base_path = "../saved_notes";

$index_file = $base_path . "/files.json";

function set_return_mime($mime) {
	header('Content-Type: ' . $mime);
}

function error($code, $error, $message) {
	set_return_mime("application/json");
	http_response_code($code);
	die(json_encode(array("error" => $error, "message" => $message), JSON_PRETTY_PRINT));
}

function plain_error($code, $error) {
	set_return_mime("text/plain");
	http_response_code($code);
	die($error);
}

function normal_exit() {
	set_return_mime("application/json");
	exit(json_encode(array("error" => "none"), JSON_PRETTY_PRINT));
}

function tryWriteFile($file, $content) {
	if (_NOTES_DEBUG)
		return;
	if (file_put_contents($file, $content) === FALSE)
		error(500, "server_error", "Could not write resource");
}

function tryReadFile($file) {
	$result = file_get_contents($file);
	if ($result === FALSE)
		error(500, "server_error", "Could not read resource");
	return $result;
}

function getIndex() {
	global $index_file;
	if (!file_exists($index_file)) {
		return [];
	} else {
		return json_decode(tryReadFile($index_file), TRUE);
	}
}

function writeIndex($index) {
	global $index_file;
	tryWriteFile($index_file, json_encode($index, JSON_PRETTY_PRINT));
}

function fullNameToID($name) {
	return preg_replace("/[^a-zA-Z0-9]/", "_", $name);
}

function getPathForID($id) {
	global $base_path;
	return $base_path . "/" . $id . ".html";
}