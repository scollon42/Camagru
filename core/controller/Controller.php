<?php

namespace Core\Controller;

use \Core\Session\Session;
use \App\Controller\Flash\Flash;

class Controller
{
	protected 	$_viewPath;
	protected 	$_template;
	protected	$_session;
	protected	$_flash;

	public function __construct()
	{
		$this->_session = Session::getInstance();
		$this->_flash = new Flash($this->_session);
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
}

 ?>
