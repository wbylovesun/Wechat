<?php
set_include_path('..' . PATH_SEPARATOR . get_include_path());

spl_autoload_register(function($class) {
    $class = str_replace('\\', '/', $class) . '.php';
    $file = stream_resolve_include_path($class);
	if ($file === false) {
		return false;
	}
	require_once $class;
	return true;
});

require 'config.php';