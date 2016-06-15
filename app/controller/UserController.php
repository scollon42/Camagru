<?php

namespace App\Controller;

use \App\Controller\AppController;
use \Core\Session\Session;
use \Core\Flash\Flash;
use \App\App;

/**
 *
 */
class UserController extends AppController
{
	public function signIn()
	{
		if (App::isAuth())
			$this->redirect('/studio');

		if (!empty($_POST))
		{
			extract($_POST);
			$user = $this->userDb->getUserByAuth($login, $password);
			if ($user != False)
			{
				App::auth($user['id']);
				$this->flash->addFlash('You are now connected !');
				$this->redirect('/studio');
			}
			else
				$this->flash->addFlash('Something wrong happened', 'error');
		}

		$this->render('user.signIn');
	}

	public function signUp()
	{
		if (App::isAuth())
			$this->redirect('/studio');
		$errors = False;
		if (!empty($_POST))
		{
			extract($_POST);
			$token = $this->userDb->addNewUser(compact('login', 'password', 'mail'));
			if ($token != False)
			{
				$this->flash->addFlash('Account created ! You can connect yourself and join us :)');
				$this->redirect('/');
			}
			else
				$this->flash->addFlash('Something wrong happened', 'error');
		}
		$this->render('user.signUp', compact('errors'));
	}

	public function logout()
	{
		$this->session->delete('connected_as');
		$this->flash->addFlash('You are now logout !');
		$this->redirect('/');
	}

	public function show()
	{
		if (!App::isAuth())
			$this->redirect('/signin');

		$userInfo = $this->userDb->getBy('id', $this->session['connected_as']);
		if (!$userInfo)
			$this->redirect('/signin');

		$user = array(
			'login' => ucfirst($userInfo['login']),
			'mail' => $userInfo['mail'],
			'cdate' => $userInfo['creation_date']
		);

		$this->render('user.studio', compact('user'));
	}

	public function update()
	{
		if (!App::isAuth())
			$this->redirect('/signin');

		if (!empty($_POST))
		{
			extract($_POST);
			$this->userDb->updateUserPassword($this->session['connected_as'], $password);
			$this->flash->addFlash('Password updated');
		}
		$user = $this->userDb->getBy('id', $this->session['connected_as']);
		$this->render('user.update', compact('user'));
	}


	public function delete()
	{
		if (!App::isAuth() || !isset($_POST['delete']))
			$this->redirect('/');

		$user_id = $this->session['connected_as'];

		$this->galleryDb->delete('user_id', $user_id);
		$this->userDb->delete('id', $user_id);

		$this->flash->addFlash('Account and gallery destroyed');
		$this->redirect('/me/logout');
	}
}

 ?>
