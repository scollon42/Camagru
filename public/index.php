<?php

session_start();

if (!isset($_SESSION['connected_as']))
	$_SESSION['connected_as'] = False;

use \App\Autoloader;

define('ROOT', dirname(__DIR__));

// require ROOT . '/app/Autoloader.php';
// Autoloader::load();


// TMP --> Will be autoloaded
require ROOT . '\app\models\Database.php';
require ROOT . '\app\models\UsersDatabase.php';

require ROOT . '\core\controller\Controller.php';
require ROOT . '\app\controller\AppController.php';
require ROOT . '\app\controller\IndexController.php';
require ROOT . '\app\controller\UserController.php';

require ROOT . '\core\router\RouterException.php';
require ROOT . '\core\router\Route.php';
require ROOT . '\core\router\Router.php';
// TMP END


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
