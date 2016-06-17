<?php

namespace App\Controller;

use \App\App;
use \Core\Controller\Controller;
use \App\Models\ModelTable;

/**
 *
 */
class AppController extends Controller
{
	protected 	$table;
	protected 	$template = 'global';

	public function __construct()
	{
		parent::__construct();
		$vpath = str_replace('/', DIRECTORY_SEPARATOR, '/app/views/');
		$this->viewPath = ROOT . $vpath;
		$this->table = new ModelTable();
	}

	// Flash::AddFlash alias
	protected function addFlash($content, $type = 'notice')
	{
		$this->flash->addFlash($content, $type);
	}
}


 ?>
