<?php

namespace Core\Router;

/**
 *
 */
class Route
{

	private $path;
	private $callable;
	private $matches = [];
	private $params = [];

	public function __construct($path, $callable)
	{
		$this->path = trim($path, '/');
		$this->callable = $callable;
	}

	public function match($url)
	{
		$url = trim($url, '/');
		$path = preg_replace_callback('#:([\w]+)#', [$this, 'paramMatch'], $this->path);
		$regex = "#^$path$#i";

		if (!preg_match($regex, $url, $matches))
		{
			return False;
		}

		array_shift($matches);
		$this->matches = $matches;
		return True;
	}

	public function with($param, $reg)
	{
		$this->params[$params] = str_replace('(', '(?:', $regex);
		return $this;
	}

	public function exec()
	{
		if (is_string($this->callable))
		{
			$params = explode('#', $this->callable);
			$controller = "App\\Controller\\" . $params[0] . "Controller";
			$controller = new $controller();
			$action = $params[1];
			if (empty($this->matches))
				return $controller->$action();
			else
				return $controller->$action($this->matches);
		}
		else
		{
			return call_user_func_array($this->callable, $this->matches);
		}
	}

	public function getUrl(array $params)
	{
		$path = $this->path;

		foreach($params as $key => $value)
		{
			$path = str_replace(":$key", $value, $path);
		}
		return $path;
	}

	private function paramMatch($match)
	{
		if (isset($this->params[$match[1]]))
		{
			return '(' . $this->params[$match[1]] . ')';
		}
		else
		{
			return '([^/]+)';
		}
	}
}


 ?>
