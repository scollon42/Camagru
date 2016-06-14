<?php

use \App\App;
use \App\Autoloader;

define('ROOT', dirname(__DIR__));

require implode(DIRECTORY_SEPARATOR, array(ROOT, 'app', 'Autoloader.php'));

Autoloader::register();

App::load();
App::run();

?>
