<?php

namespace App\Controller;

use \App\Controller\AppController;
use \App\Models\UsersDatabase;

/**
 *
 */
class UserController extends AppController
{
	private	$_userDb;

	public function __construct()
	{
		parent::__construct();
		$this->_userDb = UsersDatabase::getInstance();
	}

	public function signIn()
	{
		$errors = False;

		if (!empty($_POST))
		{
			extract($_POST);
			$user = $this->_userDb->getUserByAuth($login, $password);
			if ($user != False)
			{
				$_SESSION['connected_as'] = $user['id'];
				$this->redirect('/me');
			}
			else
				$errors = True;
		}

		$this->render('user.signIn', compact('errors'));
	}

	public function signUp()
	{
		$errors = False;
		if (!empty($_POST))
		{
			extract($_POST);
			$token = $this->_userDb->addNewUser(compact('login', 'password', 'mail'));
			if ($token != False)
				$this->redirect('/');
			else
				$errors = True;
		}
		$this->render('user.signUp', compact('errors'));
	}

	public function show()
	{
		if (empty($_SESSION) || !$_SESSION['connected_as'])
			$this->redirect('/signIn');

		$userInfo = $this->_userDb->getUserById($_SESSION['connected_as']);
		$user = array(
			'login' => ucfirst($userInfo['login']),
			'mail' => $userInfo['mail'],
			'cdate' => $userInfo['creation_date']
		);
		if (!$user)
			$this->redirect('/signIn');

		$this->render('user.show', compact('user'));
	}

	public function logout()
	{
		if (isset($_SESSION['connected_as']))
			$_SESSION['connected_as'] = False;
		$this->redirect('/');
	}

	public function update()
	{
		$errors = False;
		if (!isset($_SESSION['connected_as']) || !$_SESSION['connected_as'])
			$this->redirect('/signIn');

		if (!empty($_POST))
		{
			extract($_POST);
			$this->_userDb->updateUserPassword($_SESSION['connected_as'], $password);
			$this->redirect('/me');
		}
		$user = $this->_userDb->getUserById($_SESSION['connected_as']);
		$this->render('user.update', compact('user', 'errors'));
	}
}

 ?>
