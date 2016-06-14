<?php

namespace App\Models;


class Database
{
	private static $_instance;
	private	static $_db;

	public static function getDb()
	{
		if (is_null(self::$_instance))
		{
			self::$_instance = new Database();
		}
		return self::$_db;
	}

	public function __construct()
	{
		require ROOT . '/config/database.php';
		try
		{
			self::$_db = new \PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			self::$_db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
			self::$_db->exec("USE `db_camagru`");
		}
		catch (Exception $e)
		{
			die('Error : ' .$e->getMessage());
		}
	}
}

?>
