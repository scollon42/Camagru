<?php

session_start();

if (!isset($_SESSION['connected_as']))
	$_SESSION['connected_as'] = False;

use \App\Autoloader;

define('ROOT', dirname(__DIR__));

require implode(DIRECTORY_SEPARATOR, array(ROOT, 'app', 'Autoloader.php'));
Autoloader::register();

$router = new \Core\Router\Router($_GET['url']);

$router->get('/', 'Index#home');
$router->get('/signIn', 'User#signIn');
$router->get('/signUp', 'User#signUp');
$router->post('/signUp', 'User#signUp');
$router->post('/signIn', 'User#signIn');

$router->get('/me', 'User#show');
$router->get('/logout', 'User#logout');
$router->get('/me/update', 'User#update');
$router->post('/me/update', 'User#update');

$router->run();

?>
