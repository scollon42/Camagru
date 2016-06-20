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
		$class_name = str_replace('\\', DIRSEP, $class_name);
		$path = explode(DIRSEP, $class_name);
		$name = array_pop($path);
		$path = strtolower(implode(DIRSEP, $path));
		$full = ROOT . DIRSEP . $path . DIRSEP . $name . '.php';
		require $full;
	}
}

 ?>
