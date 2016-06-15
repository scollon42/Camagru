<?php

namespace App\Controller;

use \App\App;
use \App\Controller\AppController;
use \Core\Session\Session;
use \Core\Flash\Flash;

class GalleryController extends AppController
{
	public function gallery()
	{
		// Pagination TMP
		$count = $this->galleryDb->count();
		$nbpage = ceil($count / 6);
		if (isset($_GET['p']) && $_GET['p'] <= $nbpage && $_GET['p'] > 0)
			$cpage = $_GET['p'];
		else
			$cpage = 1;

		$p = ($cpage - 1) * 6;

		$gallery = $this->galleryDb->getImageWhere('creation_date', "$p,6", true);
		$this->render('user.gallery', compact('gallery', 'nbpage', 'cpage'));
	}

	public function showImage(Array $matches)
	{
		$id = $matches[0];
		$image = $this->galleryDb->getBy('id', $id);
		if (!$image)
			$this->redirect('/gallery');
		$user = $this->userDb->getBy('id', $image['user_id']);
		if (!$user)
			$this->redirect('/gallery');

		$this->render('user.image', compact('image', 'user'));
	}

	public function addComment(Array $matches)
	{
		$id = $matches[0];
		$image = $this->galleryDb->getBy('id', $id);
		if (!$image)
			$this->redirect('/gallery');

		$user = $this->userDb->getBy('id', $this->session['connected_as']);
		if (!$user)
			$this->redirect('/gallery');

		$this->redirect('/gallery/' . $id);
	}
}

?>
