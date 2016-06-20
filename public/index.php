<?php

use \App\App;
use \App\Autoloader;

define('ROOT', dirname(__DIR__));
define('DIRSEP', DIRECTORY_SEPARATOR);

require implode(DIRSEP, array(ROOT, 'app', 'Autoloader.php'));

Autoloader::register();

App::load();
App::run();

?>
