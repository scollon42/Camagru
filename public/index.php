<?php

use \App\Autoloader;

define('ROOT', dirname(__DIR__));

require implode(DIRECTORY_SEPARATOR, array(ROOT, 'app', 'Autoloader.php'));
Autoloader::register();

$session = \Core\Session\Session::getInstance();

$router = new \Core\Router\Router($_GET['url']);

$router->get('/', 'Index#home');
$router->get('/signIn', 'User#signIn');
$router->get('/signUp', 'User#signUp');
$router->post('/signUp', 'User#signUp');
$router->post('/signIn', 'User#signIn');

$router->get('/me', 'User#show');
$router->get('/me/logout', 'User#logout');
$router->get('/me/update', 'User#update');
$router->post('/me/update', 'User#update');
$router->post('/me/delete', 'User#delete');

$router->run();

?>
