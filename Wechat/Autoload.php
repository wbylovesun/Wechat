<?php
if (version_compare(PHP_VERSION, '5.4.0', '<')) {
    trigger_error("Package Wechat need PHP_VERSION>5.4.0 to support JSON_UNESCAPED_UNICODE constants", E_USER_NOTICE);
}

$paths = get_include_path();
if (strpos(PATH_SEPARATOR . $paths . PATH_SEPARATOR, PATH_SEPARATOR . '.' . PATH_SEPRATOR) === false) {
    set_include_path('.' . PATH_SEPARATOR . $paths);
}

spl_autoload_register(function($class) {
    $class = str_replace('\\', '/', $class) . '.php';
    $file = stream_resolve_include_path($class);
	if ($file === false) {
		return false;
	}
	require_once $class;
	return true;
});