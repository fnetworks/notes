<?php

$base_path = "../saved_notes";

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