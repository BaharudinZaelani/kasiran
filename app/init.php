<?php 
require './vendor/autoload.php';
include 'config.php';

spl_autoload_register(function($class){
	$file = __DIR__ . '\\core\\' . $class . '.php';
	if (file_exists($file)) {
		require 'core/' . $class . '.php';
	}
});