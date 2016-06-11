<?php

namespace Core\Controller;

class Controller
{
	protected $_viewPath;
	protected $_template;

	protected function render($view, $variables = [])
	{
		ob_start();
		extract($variables);
		require($this->_viewPath . str_replace('.', '\\', $view) . '.php');
		$content = ob_get_clean();
		require($this->_viewPath . 'templates\\' . $this->_template . '.php');
	}

	public function forbidden()
	{
		header('HTTP/1.0 403 Forbidden');
		die('Access denied');
	}

	public function notFound()
	{
		header('HTTP/1.0 404 Not Found');
		die('Page not found');
	}
}

 ?>
