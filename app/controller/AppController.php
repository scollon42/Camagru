<?php

namespace App\Controller;

use Core\Controller\Controller;

/**
 *
 */
class AppController extends Controller
{
	protected $_template = 'default';

	public function __construct()
	{
		parent::__construct();
		$vpath = str_replace('/', DIRECTORY_SEPARATOR, '/app/views/');
		$this->_viewPath = ROOT . $vpath;
	}
}


 ?>
