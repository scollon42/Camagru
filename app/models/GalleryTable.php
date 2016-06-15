<?php

namespace App\Models;

use \App\Models\Database;

class GalleryTable extends Table
{

	public function getImageWhere($cond, $limit = false, $inv = false)
	{
		// TODO :  PUT A PROTECTION ON $cond !!!
		$sql = "SELECT * FROM `gallery` ORDER BY $cond";
		if ($inv)
			$sql = $sql . ' DESC';
		if ($limit)
		{
			$sql = $sql . ' LIMIT ' . $limit;
			settype($limit, 'integer');
		}

		$img = $this->execute($sql);

		return ($img);
	}

	public function addImage($path, $name, $user_id)
	{
		$sql = "INSERT INTO `gallery` (`path`, `name`, `user_id`)
				VALUES (:pat, :nam, :use)";
		$exec = [
					'pat' => $path,
					'nam' => $name,
					'use' => $user_id
				];

		$this->updatewith($sql, $exec);
		return (True);
	}
}

?>
