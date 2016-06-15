<?php

namespace App\Models;


class Database
{
	private static $instance;
	private	static $db;

	public static function getDb()
	{
		if (is_null(self::$instance))
		{
			self::$instance = new Database();
		}
		return self::$db;
	}

	public function __construct()
	{
		require ROOT . '/config/database.php';
		try
		{
			self::$db = new \PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			self::$db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
			self::$db->exec("USE `db_camagru`");
		}
		catch (Exception $e)
		{
			die('Error : ' .$e->getMessage());
		}
	}
}

?>
