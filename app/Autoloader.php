<?php

namespace App;

/**
 *
 */
class Autoloader
{
 	static function register()
	{
		spl_autoload_register(array(__CLASS__, 'autoload'));
	}

 	static function autoload($class_name)
	{
		$class_name = str_replace('\\', DIRECTORY_SEPARATOR, $class_name);
		$path = explode(DIRECTORY_SEPARATOR, $class_name);
		$name = array_pop($path);
		$path = strtolower(implode(DIRECTORY_SEPARATOR, $path));
		$full = ROOT . DIRECTORY_SEPARATOR . $path . DIRECTORY_SEPARATOR . $name . '.php';
		// var_dump($full);
		require $full;
	}
}

 ?>
