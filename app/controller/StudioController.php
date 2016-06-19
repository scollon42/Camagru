<?php

namespace App\Controller;

use \App\Controller\AppController;
use \Core\Session\Session;
use \Core\Flash\Flash;
use \App\App;

class StudioController extends AppController
{

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
        
        // Extensions that the script can handle
        $ext = ['jpg', 'gif', 'png', 'jpeg','bmp'];

        if (!empty($_POST))
        {
            if (!empty($_FILES['image']['name']))
            {
                $image_extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
 
                // we test if the image_extension is handle
                if (in_array(strtolower($image_extension), $ext))
                {
                    $imageinfo = getimagesize($_FILES['image']['tmp_name']);

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
                        $upload_path = implode(DIRECTORY_SEPARATOR, [ ROOT, 'public', 'images', 'upload' ]) . DIRECTORY_SEPARATOR;

                        // if upload file doesn't exist we create one
                        if (!file_exists($upload_path))
                            mkdir($upload_path);

                        if (move_uploaded_file($_FILES['image']['tmp_name'], $upload_path . $newName))
                        {
                            $swag = $_POST['swag'] . '.png';
                            $swag_path = ROOT . str_replace('/', DIRECTORY_SEPARATOR, $_POST['path']);
                            $swag = $swag_path .  $swag;

                            $swag_image = imagecreatefrompng($swag);

                            switch (strtolower($image_extension))
                            {
                                case 'gif':
                                    $photo_image = imagecreatefromgif($upload_path . $newName);
                                    break;
                                case 'png':
                                    $photo_image = imagecreatefrompng($upload_path . $newName);
                                    break;
                                case 'bmp':
                                    $photo_image = imagecreatefromwbmp($upload_path . $newName);
                                    break ;
                                default:
                                    $photo_image = imagecreatefromjpeg($upload_path . $newName);
                                    break ;
                            }
                            $src_w = imagesx($swag_image);
                            $src_h = imagesy($swag_image);
                            $dst_w = imagesx($photo_image);
                            $dst_h = imagesy($photo_image);
                            $dst_x = ($dst_w - $src_w) / 2;
                            $dst_y = ($dst_h - $src_h) / 2;
                        

                            imagecopy($photo_image, $swag_image, $dst_x, $dst_y, 0, 0, $src_w, $src_h);
                        
                            $final_path = implode(DIRECTORY_SEPARATOR, [ ROOT, 'public', 'images', 'camagru' ]) . DIRECTORY_SEPARATOR;

                            // if final dir doesn't exist we create one
                            if (!file_exists($upload_path))
                                mkdir($final_path);
                            
                            // We create the new image
                            switch (strtolower($image_extension))
                            {
                                case 'gif':
                                    imagegif($photo_image, $final_path . $newName);
                                    break ;
                                case 'png':
                                    imagepng($photo_image, $final_path . $newName);
                                    break ;
                                case 'bmp':
                                    imagewbmp($photo_image, $final_path . $newName);
                                    break ;
                                default:
                                    imagejpeg($photo_image, $final_path . $newName);
                                    break ;
                            }

                            // We del the upload tmp image
                            unlink($upload_path . $newName);

                            // Set it in the database
                            $this->table->gallery->addImage('/public/images/camagru/', $newName, $user_id);
                            $id = $this->table->gallery->getBy('name', $newName)['id'];
                            $this->redirect("/gallery/$id", 'Upload succed !');
                        }
                    }

                }
            }
        }
        $this->redirect('/studio', 'Something failed !', 'error');
    }

}

?>