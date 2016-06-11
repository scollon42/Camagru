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
		$this->_viewPath = ROOT . '\app\views\\';
	}
}


 ?>
