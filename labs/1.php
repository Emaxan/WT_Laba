<?php
//var_dump($GLOBALS);
$config = file_get_contents("config.conf");
preg_match("/a=(.*)/", $config, $var);	
var_dump($var);