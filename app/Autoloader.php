<?php

namespace App;

/**
 *
 */
class Autoloader
{
	public static function load()
	{
		spl_autoload_register(array(__CLASS__, 'autoLoad'));
	}

	public static function autoLoad($class)
	{
		if (strpos($class, __NAMESPACE__ . '\\') === 0)
		{
			$class = str_replace(__NAMESPACE__ . ' \\', '', $class);
			require __DIR__ . '/' . $class . '.php';
		}
	}
}


 ?>
