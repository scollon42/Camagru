<?php

session_start();

if (!isset($_SESSION['connected_as']))
	$_SESSION['connected_as'] = False;

use \App\Autoloader;

define('ROOT', dirname(__DIR__));

//Will be a class Autoloader
function __autoload($class_name)
{
	$path = explode('\\', $class_name);
	$name = array_pop($path);
	$path = strtolower(implode('\\', $path));
	require ROOT . '\\' . $path . '\\' . $name . '.php';
}


$router = new \Core\Router\Router($_GET['url']);

$router->get('/', 'Index#home');
$router->get('/signIn', 'User#signIn');
$router->get('/signUp', 'User#signUp');
$router->post('/signUp', 'User#signUp');
$router->post('/signIn', 'User#signIn');

$router->get('/me', 'User#show');
$router->get('/logout', 'User#logout');

$router->run();

?>
