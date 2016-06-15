<?php

namespace Core\Controller;

use \Core\Session\Session;
use \App\Controller\Flash\Flash;

class Controller
{
	protected 	$viewPath;
	protected 	$template;
	protected	$session;
	protected	$flash;

	public function __construct()
	{
		$this->session = Session::getInstance();
		$this->flash = new Flash($this->session);
	}

	protected function render($view, $variables = [])
	{
		ob_start();
		$flash = $this->flash->getFlash();
		extract($variables);
		require($this->viewPath . str_replace('.', DIRECTORY_SEPARATOR, $view) . '.php');
		$content = ob_get_clean();
		require($this->viewPath . 'templates' .  DIRECTORY_SEPARATOR . $this->template . '.php');
	}

	protected function redirect($url)
	{
		header('location: ' . $url);
		exit;
	}
}

 ?>
