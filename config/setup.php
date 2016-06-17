<?php
	require "database.php";

	$pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	try
	{
		$pdo->exec("CREATE DATABASE IF NOT EXISTS`db_camagru`");
		$pdo->exec("USE `db_camagru`");
		$pdo->exec("CREATE TABLE IF NOT EXISTS `users`
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
		$pdo->exec("CREATE TABLE IF NOT EXISTS `gallery`
					(
						id INT(4) NOT NULL AUTO_INCREMENT,
						imagepath VARCHAR(255) NOT NULL,
						name VARCHAR(255) NOT NULL,
						user_id INT(4) NOT NULL,
						creation_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
						image_like INT(4) NOT NULL DEFAULT '0',
						PRIMARY KEY (`id`)
					)"
		);

		$pdo->exec("CREATE TABLE IF NOT EXISTS `comments`
					(
						id INT(4) NOT NULL AUTO_INCREMENT,
						`content` TEXT NOT NULL,
						`creation_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
						`user_id` INT(4) NOT NULL,
						`image_id` INT(4) NOT NULL,
						PRIMARY KEY (`id`)
					)"
		);
	}
	catch (Exception $e)
	{
		die ('Error : ' . $e->getMessage());
	}
	exit ;

 ?>
