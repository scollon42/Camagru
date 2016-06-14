<?php

namespace App\Controller;

use \App\Controller\AppController;

class IndexController extends AppController
{
	public function home()
	{
		$gallery = $this->_galleryDb->getImageWhere('creation_date', 3, true);
		$this->render('home', compact('gallery'));
	}
}

 ?>
