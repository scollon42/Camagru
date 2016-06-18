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

        if (!App::isAuth())
            $this->redirect('/');

        $ext = ['jpg', 'gif', 'png', 'jpeg','bmp'];

        // if (!empty($_POST))
        // {
            if (!empty($_FILES['image']['name']))
            {
                $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
 
                if (in_array(strtolower($extension), $ext))
                {
                    $imageinfo = getimagesize($_FILES['image']['tmp_name']);
                    // Here we'll need to check the size W / H
                    if (isset($_FILES['image']['error']) && $_FILES['image']['error'] === UPLOAD_ERR_OK)
                    {
                        $user_id = App::getSession()->connected_as;
                        $user = $this->table->users->getBy('id', $user_id);
                        if (!$user)
                            $this->redirect('/studio', 'Something wrong happened', 'error');
                        
                        $token = $user['token'];
                        unset($user);
                        $newName = $token . md5(uniqid($user_id)) . '.' . $extension;

                        $target = implode(DIRECTORY_SEPARATOR, [ ROOT, 'public', 'images' ]) . DIRECTORY_SEPARATOR;
                        if (move_uploaded_file($_FILES['image']['tmp_name'], $target . $newName))
                        {
                           //Don't forget to add the image to bdd
                            $path = '/public/images/';
                            $this->table->gallery->addImage($path, $newName, $user_id);
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