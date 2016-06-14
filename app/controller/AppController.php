<?php

namespace App\Controller;

use Core\Controller\Controller;
use \App\Models\UsersDatabase;
use \App\Models\GalleryDatabase;

/**
 *
 */
class AppController extends Controller
{
	protected	$_userDb;
	protected	$_galleryDb;
	protected 	$_template = 'default';

	public function __construct()
	{
		parent::__construct();
		$vpath = str_replace('/', DIRECTORY_SEPARATOR, '/app/views/');
		$this->_viewPath = ROOT . $vpath;
		$this->_userDb = UsersDatabase::getInstance();
		$this->_galleryDb = GalleryDatabase::getInstance();
	}
}


 ?>
