<?php

namespace Core\Router;

use \Core\Router\Route;

/**
 *
 */
class Router
{

	private $url;
	private $routes = [];
	private $nameRoutes = [];

	public function __construct($url = '/')
	{
		$this->url = $url;
	}

	public function get($path, $callable, $name = NULL)
	{
		return $this->add($path, $callable, $name, 'GET');
	}

	public function post($path, $callable, $name = NULL)
	{
		return $this->add($path, $callable, $name, 'POST');
	}

	public function run()
	{
		$find = false;
		if (!isset($this->routes[$_SERVER['REQUEST_METHOD']]))
			throw new RouterException('No ' . $_SERVER['REQUEST_METHOD'] . ' routes find');

		foreach ($this->routes[$_SERVER['REQUEST_METHOD']] as $route)
		{
			if ($route->match($this->url))
			{
				$find = true;
			 	$route->exec();
			}
		}
		return $find;
	}

	public function url($name, $params = [])
	{
		if (!isset($this->nameRoutes[$name]))
		{
			throw new RouterException('No route matches this name');
		}

		return $this->nameRoutes[$name]->getUrl($params);
	}

	private function add($path, $callable, $name, $method)
	{
		$route = new Route($path, $callable);
		$this->routes[$method][] = $route;
		if (is_string($callable) && $name === NULL)
			$name = $callable;

		if ($name)
			$this->nameRoutes[$name] = $route;
		return $route;
	}

}


 ?>
