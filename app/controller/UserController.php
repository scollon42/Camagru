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
			$user = $this->table->users->getUserByAuth($login, $password);
			if ($user != False)
			{
				App::auth($user['id']);
				$this->flash->addFlash('You are now connected !');
				$this->redirect('/studio');
			}
			else
				$this->flash->addFlash('Something wrong happened', 'error');
		}

		$this->render('signIn');
	}

	public function signUp()
	{
		if (App::isAuth())
			$this->redirect('/studio');
		$errors = False;
		if (!empty($_POST))
		{
			extract($_POST);

			// Here we test value sended by user
			if ($password !== $confirm)
				$this->redirect('/signUp', 'Passwords aren\'t the same', 'error');

			if (!preg_match("/^\w{6,15}$/", $login))
				$this->redirect('/signUp', 'Invalid login ! You must enter between 6 and 15 characters.', 'error');


			if (!preg_match("/^\w{8,15}$/", $password))
				$this->redirect('/signUp', 'Invalid password ! You must entrer between 8 and 15 characters.', 'error');


			if (!preg_match("/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/", $mail))
				$this->redirect('/signUp', 'Invalid mail', 'error');


			if ($this->table->users->getBy('login', $login))
				$this->redirect('/signUp', 'Login already used', 'error');
			if ($this->table->users->getBy('mail', $mail))
				$this->redirect('/signUp', 'Mail adress already used', 'error');

			$token = $this->table->users->addNewUser(compact('login', 'password', 'mail'));
			if ($token != False)
			{
				$this->flash->addFlash('Account created ! You can connect yourself and join us :)');
				$this->redirect('/');
			}
			else
				$this->flash->addFlash('Something wrong happened', 'error');
		}
		$this->render('signUp', compact('errors'));
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

		$userInfo = $this->table->users->getBy('id', $this->session['connected_as']);
		if (!$userInfo)
			$this->redirect('/signin');

		$user = array(
			'login' => ucfirst($userInfo['login']),
			'mail' => $userInfo['mail'],
			'cdate' => $userInfo['creation_date']
		);

		$this->render('studio', compact('user'));
	}

	public function update()
	{
		if (!App::isAuth())
			$this->redirect('/signin');

		if (!empty($_POST))
		{
			extract($_POST);
			$this->table->users->updateUserPassword($this->session['connected_as'], $password);
			$this->flash->addFlash('Password updated');
		}
		$user = $this->table->users->getBy('id', $this->session['connected_as']);
		$this->render('update', compact('user'));
	}


	public function delete()
	{
		if (!App::isAuth() || !isset($_POST['delete']))
			$this->redirect('/');

		$user_id = $this->session['connected_as'];

		$this->table->gallery->delete('user_id', $user_id);
		$this->table->users->delete('id', $user_id);

		$this->flash->addFlash('Account and gallery destroyed');
		$this->redirect('/me/logout');
	}
}

 ?>
