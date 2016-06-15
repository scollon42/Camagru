<?php

namespace App\Controller;

use \App\App;
use \Core\Controller\Controller;
use \App\Models\UsersTable;
use \App\Models\GalleryTable;
use \App\Models\CommentsTable;

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
		$this->userDb = new UsersTable();
		$this->galleryDb = new GalleryTable();
		$this->commentsDb = new CommentsTable();
	}
}


 ?>
