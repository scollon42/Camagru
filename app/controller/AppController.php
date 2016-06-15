<?php

namespace App\Controller;

use \App\App;
use \Core\Controller\Controller;
use \App\Models\Users;
use \App\Models\Gallery;

/**
 *
 */
class AppController extends Controller
{
	protected	$userDb;
	protected	$galleryDb;
	protected 	$template = 'default';

	public function __construct()
	{
		parent::__construct();
		$vpath = str_replace('/', DIRECTORY_SEPARATOR, '/app/views/');
		$this->viewPath = ROOT . $vpath;
		$this->userDb = new Users();
		$this->galleryDb = new Gallery();
	}
}


 ?>
