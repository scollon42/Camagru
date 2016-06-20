<?php

namespace App\Controller;

use \App\Controller\AppController;
use \Core\Session\Session;
use \Core\Flash\Flash;
use \App\App;

class StudioController extends AppController
{

	private $extensions = [ 'jpg', 'gif', 'png', 'jpeg' ];
	private $uploadPath = '/public/images/upload/';
	private $finalPath = '/public/images/camagru/';

	// This little function transform $upload and $final path
	// in a absolute path like : C:\\...\..\
	private static function abs($path)
	{
		$abs = str_replace('/', DIRSEP, $path);
		return (ROOT . $abs);
	}

	public function studio()
	{
		if (!App::isAuth())
			$this->redirect('/signin');

		$userInfo = $this->table->users->getBy('id', $this->session['connected_as']);
		if (!$userInfo)
			$this->redirect('/signin');

		$user = array(
			'login' => ucfirst($userInfo['login']),
			'mail' => $userInfo['mail'],
			'cdate' => $userInfo['creation_date']
		);

		$this->render('studio', compact('user'));
	}

	public function upload()
	{

		// If user is not login stop the script
		if (!App::isAuth())
			$this->redirect('/');

		if (!empty($_POST))
		{
			if (!empty($_FILES['image']['name']))
			{
				$image_extension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
				$image_extension = $image_extension === 'jpg' ? 'jpeg' : $image_extension;

				// we test if the image_extension is handle
				if (!in_array($image_extension, $this->extensions))
					$this->redirect('/studio', 'Image must be one of ' . implode(' / ', $this->extensions), 'error');
				// Here we check if the upload has no error
				if (isset($_FILES['image']['error']) && $_FILES['image']['error'] === UPLOAD_ERR_OK)
				{
					// Here we get the user wo have send the image
					$user_id = $_POST['user_id'];
					$user = $this->table->users->getBy('id', $user_id);
					if (!$user)
						$this->redirect('/studio', 'Something wrong happened', 'error');

					// We create the name for future image
					$token = $user['token'];
					unset($user); // useless value destroyed
					$newName = $token . md5(uniqid($user_id)) . '.' . $image_extension;
					// if upload file doesn't exist we create one
					if (!file_exists(self::abs($this->uploadPath)))
						mkdir(self::abs($this->uploadPath));
					// We move the photo the upload directory
					if (move_uploaded_file($_FILES['image']['tmp_name'], self::abs($this->uploadPath) . $newName))
					{
						$swag = $_POST['swag'] . '.png';
						$swag_path = self::abs($_POST['path']);
						$swag = $swag_path .  $swag;
						$swag_image = imagecreatefrompng($swag);
						// Generate the two GD function we need to compute image
						$imageCreateFc = 'imagecreatefrom' . $image_extension;
						$imageFc = 'image' . $image_extension;

						$photo_image = $imageCreateFc(self::abs($this->uploadPath) . $newName);
						$src_w = imagesx($swag_image);
						$src_h = imagesy($swag_image);
						$dst_x = (imagesx($photo_image) - $src_w) / 2;
						$dst_y = (imagesy($photo_image) - $src_h) / 2;

						// Put swag on photo
						imagecopy($photo_image, $swag_image, $dst_x, $dst_y, 0, 0, $src_w, $src_h);

						// if final dir doesn't exist we create one
						if (!file_exists(self::abs($this->finalPath)))
							mkdir(self::abs($finalPath));

							// We create the new image
							$imageFc($photo_image, self::abs($this->finalPath) . $newName);

							// We del the upload tmp image
							unlink(self::abs($this->uploadPath) . $newName);
							imagedestroy($photo_image);
							imagedestroy($swag_image);

							// Set it in the database
							$this->table->gallery->addImage($this->finalPath, $newName, $user_id);
							$id = $this->table->gallery->getBy('name', $newName)['id'];
							$this->redirect("/gallery/$id", 'Upload succed !');
					}
				}
			}
		}
		$this->redirect('/studio', 'Something failed !', 'error');
	}

}

?>
