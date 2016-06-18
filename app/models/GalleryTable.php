<?php

namespace App\Models;

use \App\Models\Database;

class GalleryTable extends Table
{

	public function addImage($path, $name, $user_id)
	{
		$sql = "INSERT INTO `gallery` (`imagepath`, `name`, `user_id`)
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
