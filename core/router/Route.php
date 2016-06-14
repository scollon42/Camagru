<?php

namespace Core\Router;

/**
 *
 */
class Route
{

	private $_path;
	private $_callable;
	private $_matches = [];
	private $_params = [];

	public function __construct($path, $callable)
	{
		$this->_path = trim($path, '/');
		$this->_callable = $callable;
	}

	public function match($url)
	{
		$url = trim($url, '/');
		$path = preg_replace_callback('#:([\w]+)#', [$this, 'paramMatch'], $this->_path);
		$regex = "#^$path$#i";

		if (!preg_match($regex, $url, $matches))
		{
			return False;
		}

		array_shift($matches);
		$this->_matches = $matches;
		return True;
	}

	public function with($param, $reg)
	{
		$this->_params[$params] = str_replace('(', '(?:', $regex);
		return $this;
	}

	public function exec()
	{
		if (is_string($this->_callable))
		{
			$params = explode('#', $this->_callable);
			$controller = "App\\Controller\\" . $params[0] . "Controller";
			$controller = new $controller();
			$action = $params[1];
			if (empty($this->_matches))
				return $controller->$action();
			else
				return $controller->$action($this->_matches);
		}
		else
		{
			return call_user_func_array($this->_callable, $this->_matches);
		}
	}

	public function getUrl(array $params)
	{
		$path = $this->_path;

		foreach($params as $key => $value)
		{
			$path = str_replace(":$key", $v, $path);
		}
		var_dump($path);
		return $path;
	}

	private function paramMatch($match)
	{
		if (isset($this->_params[$match[1]]))
		{
			return '(' . $this->_params[$match[1]] . ')';
		}
		else
		{
			return '([^/]+)';
		}
	}
}


 ?>
