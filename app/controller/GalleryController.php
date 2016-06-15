<?php

namespace App\Controller;

use \App\App;
use \App\Controller\AppController;
use \App\Controller\Pager\Pager;
use \Core\Session\Session;
use \Core\Flash\Flash;

class GalleryController extends AppController
{
	public function gallery()
	{
		$pager = new Pager($this->galleryDb->count(), 6);
		$p = $pager->prepare();
		$gallery = $this->galleryDb->getAllByQuery(['order' => 'creation_date',
													'limit' => "$p,6"]);
		$this->render('user.gallery', compact('gallery', 'pager'));
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
// Ugly but TMP
		$comment = $this->commentDb->execute("	SELECT * FROM `comments`
												INNER JOIN `users`
													ON `comments`.user_id = `users`.id
												WHERE `comments`.image_id = $id
												ORDER BY `comments`.creation_date DESC");
		$this->render('user.image', compact('image', 'user', 'comment'));
	}

	public function addComment(Array $matches)
	{
		if (!App::isAuth())
			$this->redirect('/');

		if (!empty($_POST))
		{
			extract($_POST);
			$id = $matches[0];
			$image = $this->galleryDb->getBy('id', $id);
			if (!$image)
				$this->redirect('/gallery');

			$user = $this->userDb->getBy('id', $this->session['connected_as']);
			if (!$user)
				$this->redirect('/gallery');

			$this->commentDb->addComment($user['id'], $image['id'], $content);
			$this->flash->addFlash('Comment added !');
			$this->redirect('/gallery/' . $id);
		}
		else
			$this->redirect('/gallery');
	}

	public function delComment(Array $matches)
	{
		if (!App::isAuth())
			$this->redirect('/');

		$id = $matches[0];
		$comment = $this->commentDb->getBy('id', $id);
		if (!$comment || $comment['user_id'] != $this->session['connected_as'])
			$this->redirect('/');

		$this->commentDb->delete('id', $id);
		$this->flash->addFlash('Comment deleted');
		$this->redirect('/gallery');
	}
}

?>
