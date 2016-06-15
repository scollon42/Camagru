<?php

namespace App;

use \Core\Session\Session;
use \Core\Router\Router;

Class App
{
	static private $loaded;
	static private $session;
	static private $router;
	static private $routes;


// Functions used to start the application
	public static function load()
	{
		require implode(DIRECTORY_SEPARATOR, array(ROOT, 'app', 'ressources', 'config', 'routes.php'));

		self::$session = Session::getInstance();
		self::$router = new Router($_GET['url']);
		self::$routes = $routes;
		self::loadRoutes();
		self::$loaded = True;
	}

	public static function run()
	{
		if (is_null(self::$loaded))
			throw new Exception('Unload App class');
		else
		{
			if (!self::$router->run())
				self::notFound();
		}
	}

	private static function loadRoutes()
	{
		foreach (self::$routes['get'] as $route => $action)
		{
			self::$router->get($route, $action);
		}
		foreach (self::$routes['post'] as $route => $action)
		{
			self::$router->post($route, $action);
		}
	}


// Utils function for App core
	public static function isAuth()
	{
		return (self::$session->exists('connected_as'));
	}

	public static function auth($id)
	{
		self::$session->set('connected_as', $id);
	}

// Those functions will be used in case of errors

	public static function forbidden()
	{
		header('HTTP/1.0 403 Forbidden');
		die('Access denied');
	}

	public static function notFound()
	{
		header('HTTP/1.0 404 Not Found');
		die('Page not found');
	}


}


?>
