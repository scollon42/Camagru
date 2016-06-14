<?php

namespace App\Controller;

use \App\Controller\AppController;
use \Core\Session\Session;
use \Core\Flash\Flash;

class GalleryController extends AppController
{
	public function gallery()
	{
		$gallery = $this->_galleryDb->getAllGallery();
		$this->render('user.gallery', compact('gallery'));
	}

	public function showImage(Array $matches)
	{
		$id = $matches[0];
		$image = $this->_galleryDb->getImage($id);
		if (!$image)
			$this->redirect('/gallery');

		$user = $this->_userDb->getUserById($image['user_id']);
		if (!$user)
			$this->redirect('/gallery');

		$this->render('user.image', compact('image', 'user'));
	}
}

?>
