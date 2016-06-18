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
				// if ($user['active'] == False)
				// 	$this->redirect('/signIn', 'Account not active yet : Check your mail :)', 'error');
				App::auth($user['id']);
				$this->redirect('/studio', 'You are now connected !');
			}
			else
				$this->flash->addFlash('Invalid login or password', 'error');
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

		$this->redirect('/', 'You are now logout !');
	}

	public function update()
	{
		if (!App::isAuth())
			$this->redirect('/signin');

		if (!empty($_POST))
		{
			extract($_POST);

			$user = $this->table->users->getBy('id', $this->session['connected_as']);
			if (!$user)
				$this->redirect('/', 'Something wrong happened !', 'error');


			if ($type === 'mail')
			{
				if ($mail !== $confirm)
					$this->redirect('/me', 'Mail are not the same !', 'error');

				if (!preg_match("/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/", $mail))
					$this->redirect('/me', 'Invalid mail', 'error'); 

				$this->redirect('/me', 'Email updated !');
			}

			if ($type === 'password')
			{
				if (App::hash($oldpassword) !== $user['password'])
					$this->redirect('/me', 'Bad old password !', 'error');

				if ($newpassword !== $confirm)
					$this->redirect('/me', 'New password and confirm are not he same !', 'error');

				if (!preg_match("/^\w{8,15}$/", $newpassword))
					$this->redirect('/me', 'Invalid new password ! You must entrer between 8 and 15 characters.', 'error');
				$this->table->users->updateUserPassword($user['id'], $newpassword);
				$this->flash->addFlash('Password updated');
			}
		}
		$key = uniqid('8e');
		$user = $this->table->users->getBy('id', $this->session['connected_as']);
		$this->render('update', compact('user', 'key'));
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
