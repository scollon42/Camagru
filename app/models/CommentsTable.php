<?php

namespace App\Models;

use \App\Models\Database;

class CommentsTable extends Table
{
	// Public function

	public function getLastCommentFromImageJoinUser($image_id)
	{
		$ret = $this->execute("SELECT * FROM `comments`
								INNER JOIN `users`
								ON `comments`.user_id = `users`.id
								WHERE `comments`.image_id = $image_id
								ORDER BY `comments`.creation_date DESC");
		return $ret;
	}

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
