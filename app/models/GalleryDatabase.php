<?php

namespace App\Models;

use \App\Models\Database;
use \App\Models\Exception;

class GalleryDatabase
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
			self::$_instance = new GalleryDatabase();
		return self::$_instance;
	}

	public function getImage($id)
	{
		if (!$id || !is_numeric($id))
			return (False);

		settype($id, 'integer');
		$sql = "SELECT * FROM `gallery` WHERE id=$id";

		try
		{
			$query = $this->_db->query($sql);
			$img = $query->fetch();
		}
		catch (Exception $e)
		{
			die ('Error ' . $e->getMessage());
		}

		return ($img);
	}

	public function getUserGallery($user_id)
	{
		if (!$user_id || !is_numeric($user_id))
			return (False);

		settype($user_id, 'integer');
		$sql = "SELECT * FROM `gallery` WHERE id=$user_id";

		try
		{
			$query = $this->_db->query($sql);
			$gallery = $query->fetch();
		}
		catch (Exception $e)
		{
			die ('Error ' . $e->getMessage());
		}

		return ($gallery);
	}

	public function getAllGallery()
	{
		$sql = "SELECT * FROM `gallery`";

		try
		{
			$query = $this->_db->query($sql);
			$gallery = $query->fetch();
		}
		catch (Exception $e)
		{
			die ('Error ' . $e->getMessage());
		}

		return ($gallery);
	}

	public function addImage($path, $name, $user_id)
	{
		$sql = "INSERT INTO `gallery` (`path`, `name`, `user_id`)
				VALUES (:pat, :nam, :use)";
		try
		{
			$this->_db->beginTransaction();
			$request = $this->_db->prepare($sql);
			$request->execute(array(
				'pat' => $path,
				'nam' => $name,
				'use' => $user_id,
			));
			$this->_db->commit(); // Important
		}
		catch (Exception $e)
		{
			$this->_db->rollback();
			die ('Error : ' . $e->getMessage());
		}
		return (True);
	}

	public function deleteImage($id)
	{

		if (!$id || !is_numeric($id))
			return (False);

		settype($id, 'integer');
		$sql = "DELETE FROM `gallery` WHERE id = '$id'";
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

	public function deleteUserGallery($user_id)
	{
		if (!$user_id || !is_numeric($user_id))
			return (False);

		settype($user_id, 'integer');

		$sql = "DELETE FROM `gallery` WHERE id = '$user_id'";
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
}

?>
