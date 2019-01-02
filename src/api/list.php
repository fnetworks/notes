<?php

require_once('util.php');

$notes = getIndex();

set_return_mime("application/json");
echo(json_encode(array("error" => "none", "notes" => array_keys($notes)), JSON_PRETTY_PRINT));