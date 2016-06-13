<?php

namespace Core\Controller;

class Controller
{
	protected 	$_viewPath;
	protected 	$_template;
	protected	$_session;
	protected	$_flash;

	public function __construct()
	{
		$this->_session = \Core\Session\Session::getInstance();
		$this->_flash = new \Core\Flash\Flash($this->_session);
	}

	protected function render($view, $variables = [])
	{
		ob_start();
		$flash = $this->_flash->getFlash();
		extract($variables);
		require($this->_viewPath . str_replace('.', DIRECTORY_SEPARATOR, $view) . '.php');
		$content = ob_get_clean();
		require($this->_viewPath . 'templates' .  DIRECTORY_SEPARATOR . $this->_template . '.php');
	}

	protected function redirect($url)
	{
		header('location: ' . $url);
		exit;
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
