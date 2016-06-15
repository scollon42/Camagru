<?php

namespace App\Models;

use \App\Models\Database;

class CommentsTable extends Table
{
	// Public function
	public function addComment($user_id, $img_id, $content)
	{
		$sql = "INSERT INTO {$this->table}
					(`content`, `user_id`, `image_id`)
				VALUES (:content, :user, :image)";

		$exec = [
					'content' => $content,
					'user' => $user_id,
					'image' => $img_id
				];

		$this->updateWith($sql, $exec);
	}


}

?>
