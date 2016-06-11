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
				header('Location: /me');
				exit ;
			}
			else
				$errors = True;
		}

		$this->render('signIn', compact('errors'));
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
				header('Location: /');
				exit ;
			}
			else
			{
				$errors = True;
			}
		}
		$this->render('signUp', compact('errors'));
	}

	public function show()
	{
		if (empty($_SESSION) || !$_SESSION['connected_as'])
		{
			header('location: /signIn');
			exit ;
		}

		$userInfo = $this->_userDb->getUserById($_SESSION['connected_as']);
		$user = array(
			'login' => ucfirst($userInfo['login']),
			'mail' => $userInfo['mail'],
			'cdate' => $userInfo['creation_date']
		);
		if (!$user)
		{
			header('location: /signIn');
			exit ;
		}

		$this->render('show', compact('user'));
	}

	public function logout()
	{
		if (isset($_SESSION['connected_as']))
			$_SESSION['connected_as'] = False;
		header('Location: /');
		exit ;
	}
}

 ?>
