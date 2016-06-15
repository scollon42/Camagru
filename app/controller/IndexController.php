<?php

namespace App\Controller;

use \App\App;
use \App\Controller\AppController;

class IndexController extends AppController
{
	public function home()
	{
		$gallery = $this->galleryDb->getAllByQuery(['order' => 'creation_date',
													'limit' => 3]);
		$this->render('home', compact('gallery'));
	}
}

 ?>
