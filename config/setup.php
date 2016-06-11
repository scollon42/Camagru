<?php
	require "database.php";

	$pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	try
	{
		$pdo->exec("CREATE DATABASE IF NOT EXISTS`db_camagru`");
		$pdo->exec("USE `db_camagru`");
		$pdo->exec("CREATE TABLE `users`
					(
						id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
						login VARCHAR(16) NOT NULL,
						password VARCHAR(255) NOT NULL,
						mail VARCHAR(255) NOT NULL,
						active BOOLEAN DEFAULT FALSE NOT NULL,
						token VARCHAR(255),
						creation_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
					)"
		);
	}
	catch (Exception $e)
	{
		die ('Error : ' . $e->getMessage());
	}
	exit ;

 ?>
