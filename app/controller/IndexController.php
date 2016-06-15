<?php

namespace App\Controller;

use \App\App;
use \App\Controller\AppController;

class IndexController extends AppController
{
	public function home()
	{
		$gallery = $this->galleryDb->getImageWhere('creation_date', 3, true);
		$this->render('home', compact('gallery'));
	}
}

 ?>
