<?php

use \App\Autoloader;

define('ROOT', dirname(__DIR__));

require implode(DIRECTORY_SEPARATOR, array(ROOT, 'app', 'Autoloader.php'));
Autoloader::register();

$session = \Core\Session\Session::getInstance();

$router = new \Core\Router\Router($_GET['url']);

$router->get('/', 'Index#home');
$router->get('/signin', 'User#signIn');
$router->get('/signup', 'User#signUp');
$router->post('/signup', 'User#signUp');
$router->post('/signin', 'User#signIn');

$router->get('/studio', 'User#show');
$router->get('/me/logout', 'User#logout');
$router->get('/me', 'User#update');
$router->post('/me', 'User#update');
$router->post('/me/delete', 'User#delete');

$router->get('/gallery', 'Gallery#gallery');
$router->get('/gallery/:id', 'Gallery#showImage');

$router->run();

?>
