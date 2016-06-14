<?php

namespace App;

use \Core\Session\Session;
use \Core\Router\Router;

Class App
{
	static private $_loaded;
	static private $_session;
	static private $_router;
	static private $_routes;

	public static function load()
	{
		require implode(DIRECTORY_SEPARATOR, array(ROOT, 'app', 'ressources', 'config', 'routes.php'));

		self::$_session = Session::getInstance();
		self::$_router = new Router($_GET['url']);
		self::$_routes = $routes;
		self::loadRoutes();
		self::$_loaded = True;
	}

	public static function run()
	{
		if (is_null(self::$_loaded))
			throw new Exception('Unload App class');
		else
		{
			if (!self::$_router->run())
				self::notFound();
		}
	}

	public static function isAuth()
	{
		return (self::$_session->exists('connected_as'));
	}


	private static function loadRoutes()
	{
		foreach (self::$_routes['get'] as $route => $action)
		{
			self::$_router->get($route, $action);
		}
		foreach (self::$_routes['post'] as $route => $action)
		{
			self::$_router->post($route, $action);
		}
	}

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
