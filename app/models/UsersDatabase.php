<?php

/**
 *	Users class is a DB instance that can be use to
 * 	search, modify or delete user in database
 * __construct need a Database class.
 */

namespace App\Models;

use \App\Models\Database;

class UsersDatabase
{

	private 		$_db;
	private static 	$_instance;

	public function __construct()
	{
		$this->_db = Database::getDb();
	}

	public static function getInstance()
	{
		if (is_null(self::$_instance))
			self::$_instance = new UsersDatabase();
		return self::$_instance;
	}

	/*
	**	Public functions
	*/
	public function getUserById($id)
	{
		if (!$id || !is_numeric($id))
			return (False);

		settype($id, 'integer');
		$sql = "SELECT * FROM `users` WHERE id=$id";

		try
		{
			$query = $this->_db->query($sql);
			$user = $query->fetch();
		}
		catch (Exception $e)
		{
			die ('Error ' . $e->getMessage());
		}

		return ($user);
	}

	public function getUserByLogin($login)
	{
		if (!$login)
			return (False);

		$login = $this->_db->quote($login);
		$sql = "SELECT * FROM `users` WHERE login = $login";

		try
		{
			$query = $this->_db->query($sql);
			$user = $query->fetch();
		}
		catch (Exception $e)
		{
			die ('Error : ' . $e->getMessage());
		}

		return ($user);
	}

	public function getUserByMail($mail)
	{
		if (!$mail)
			return (False);

		$mail = $this->_db->quote($mail);
		$sql = "SELECT * FROM `users` WHERE mail = $mail";

		try
		{
			$query = $this->_db->query($sql);
			$user = $query->fetch();
		}
		catch (Exception $e)
		{
			die ('Error : ' . $e->getMessage());
		}

		return ($user);
	}

	public function getUserByToken($token)
	{
		if (!$token)
			return (False);

		$token = $this->_db->quote($token);
		$sql = "SELECT * FROM `users` WHERE token = $token";

		try
		{
			$query = $this->_db->query($sql);
			$user = $query->fetch();
		}
		catch (Exception $e)
		{
			die ('Error : ' . $e->getMessage());
		}

		return ($user);
	}

	public function getUserByAuth($login, $password)
	{
		if (!$login || !$password)
			return (False);

		$hashPassword = $this->_hashPassword($password);

		$user = $this->getUserByLogin($login);

		if (!$user)
			return (False);
		if ($user['password'] != $hashPassword)
			return (False);
		// if (!$user['active'])
		// 	return (False);

		return ($user);
	}

	public function addNewUser(array $userInfos)
	{
		if (key_exists('login', $userInfos))
			$login = $userInfos['login'];
		if (key_exists('password', $userInfos))
			$password = $userInfos['password'];
		if (key_exists('mail', $userInfos))
			$mail = $userInfos['mail'];

		// On this part we juste virify if user login or mail already exists
		if ($this->getUserByLogin($login))
			return (False);
		if ($this->getUserByMail($mail))
			return (False);

		// if no users are finded we can add the new user
		$hashPassword = $this->_hashPassword($password);
		$userToken = $this->_generateUserToken();

		$sql = "INSERT INTO `users` (`login`, `password`, `mail`, `token`)
				VALUES (:log, :pwd, :ml, :tok)";

		try
		{
			$this->_db->beginTransaction();
			$request = $this->_db->prepare($sql);
			$request->execute(array(
				'log' => $login,
				'pwd' => $hashPassword,
				'ml' => $mail,
				'tok' => $userToken
			));
			$this->_db->commit(); // Important
		}
		catch (Exception $e)
		{
			$this->_db->rollback();
			die ('Error : ' . $e->getMessage());
		}

		// We return user token if everything is OK
		return ($userToken);
	}

	public function updateUserPassword($id, $password)
	{
		$user = $this->getUserById($id);

		if (!$user)
			return (False);

		$hashPassword = $this->_hashPassword($password);

		if ($user['password'] == $hashPassword)
			return (True);

		$sql = "UPDATE `users` SET password = :newpwd WHERE id = " . $user['id'];
		try
		{
			$this->_db->beginTransaction();
			$request = $this->_db->prepare($sql);
			$request->execute(array('newpwd' => $hashPassword));
			$this->_db->commit();
		}
		catch (Exception $e)
		{
			die ('Error : ' . $e->getMessage());
		}

		return (True);
	}

	public function validateUserMail($token)
	{
		$user = $this->getUserByToken($token);
		if (!$user)
			return (False);
		if ($user['active'] === TRUE)
			return (True);

		$sql = "UPDATE `users` SET active = :status WHERE id = " . $user['id'];

		try
		{
			$this->_db->beginTransaction();
			$request = $this->_db->prepare($sql);
			$request->execute(array('status' => TRUE));
			$this->_db->commit();
		}
		catch (Exception $e)
		{
			die ('Error : ' . $e->getMessage());
		}

		return (True);
	}

	public function deleteUserAccount($id)
	{
		$user = $this->getUserById($id);

		if (!$user)
			return (False);

		$sql = "DELETE FROM `users` WHERE id = '$id'";
		try
		{
			$this->_db->beginTransaction();
			$this->_db->exec($sql);
			$this->_db->commit();
		}
		catch (Exception $e)
		{
			die ('Error : ' .  $e->getMessage());
		}

		return (True);

	}

	/*
	**	Private functions
	*/

	private function _hashPassword($password)
	{
		$char = '$^~';
		$hash = hash('sha512', $char.$password);
		$hash = hash("whirlpool", $hash);
		return ($hash);
	}

	private function _generateUserToken()
	{
		$token = md5(rand(0, 100));
		return ($token);
	}
}

 ?>
