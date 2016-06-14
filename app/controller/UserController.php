<?php

namespace App\Controller;

use \App\Controller\AppController;
use \Core\Session\Session;
use \Core\Flash\Flash;

/**
 *
 */
class UserController extends AppController
{
	public function signIn()
	{
		if ($this->_session->exists('connected_as'))
			$this->redirect('/studio');

		if (!empty($_POST))
		{
			extract($_POST);
			$user = $this->_userDb->getUserByAuth($login, $password);
			if ($user != False)
			{
				$this->_session['connected_as'] = $user['id'];
				$this->_flash->addFlash('You are now connected !');
				$this->redirect('/studio');
			}
			else
				$this->_flash->addFlash('Something wrong happened', 'error');
		}

		$this->render('user.signIn');
	}

	public function signUp()
	{
		$errors = False;
		if (!empty($_POST))
		{
			extract($_POST);
			$token = $this->_userDb->addNewUser(compact('login', 'password', 'mail'));
			if ($token != False)
			{
				$this->_flash->addFlash('Account created ! You can connect yourself and join us :)');
				$this->redirect('/');
			}
			else
				$this->_flash->addFlash('Something wrong happened', 'error');
		}
		$this->render('user.signUp', compact('errors'));
	}

	public function logout()
	{
		$this->_session->delete('connected_as');
		$this->_flash->addFlash('You are now logout !');
		$this->redirect('/');
	}

	public function show()
	{
		if (!$this->_session->exists('connected_as'))
			$this->redirect('/signin');

		$userInfo = $this->_userDb->getUserById($this->_session['connected_as']);
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
		if (!$this->_session->exists('connected_as'))
			$this->redirect('/signin');

		if (!empty($_POST))
		{
			extract($_POST);
			$this->_userDb->updateUserPassword($this->_session['connected_as'], $password);
			$this->_flash->addFlash('Password updated');
		}
		$user = $this->_userDb->getUserById($this->_session['connected_as']);
		$this->render('user.update', compact('user'));
	}


	public function delete()
	{
		if (!$this->_session->exists('connected_as') || !isset($_POST['delete']))
		{
			$this->redirect('/');
		}

		$this->_galleryDb->deleteUserGallery($this->_session['connected_as']);
		$this->_userDb->deleteUserAccount($this->_session['connected_as']);
		$this->_flash->addFlash('Account and gallery destroyed');
		$this->redirect('/me/logout');
	}
}

 ?>
