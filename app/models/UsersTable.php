<?php

/**
 *	Users class is a DB instance that can be use to
 * 	search, modify or delete user in database
 * __construct need a Database class.
 */

namespace App\Models;

use \App\Models\Database;

class UsersTable extends Table
{

	/*
	**	Public functions
	*/

	public function getUserByAuth($login, $password)
	{
		if (!$login || !$password)
			return (False);

		$hashPassword = App::hash($password);

		$user = $this->getBy('login', $login);

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
		if ($this->getBy('login', $login))
			return (False);
		if ($this->getBy('mail', $mail))
			return (False);

		// if no users are finded we can add the new user
		$hashPassword = App::hash($password);
		$userToken = App::generateToken();

		$sql = "INSERT INTO {$this->table}
					(`login`, `password`, `mail`, `token`)
				VALUES (:log, :pwd, :ml, :tok)";

		$exec = [
					'log' => $login,
					'pwd' => $hashPassword,
					'ml' => $mail,
					'tok' => $userToken
				];

		$this->updateWith($sql, $exec);

		// We return user token if everything is OK
		return ($userToken);
	}

	public function updateUserPassword($id, $password)
	{
		$user = $this->getBy('id', $id);

		if (!$user)
			return (False);

		$hashPassword = App::hash($password);

		if ($user['password'] == $hashPassword)
			return (True);

		$sql = "UPDATE {$this->table}
				SET password = :newpwd
				WHERE id = " . $user['id'];

		$this->updateWith($sql,['newpwd' => $hashPassword]);

		return (True);
	}

	public function validateUserMail($token)
	{
		$user = $this->getBy('token', $token);
		if (!$user)
			return (False);
		if ($user['active'] === TRUE)
			return (True);

		$sql = "UPDATE {$this->table}
				SET active = :status
				WHERE id = {$user['id']}";
		$this->updateWith($sql, ['status' => TRUE]);

		return (True);
	}

}

 ?>
