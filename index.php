<?php
session_start();
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/config.php';


spl_autoload_register(function($class) {
    if (file_exists('controllers/' . $class . '.php')):
        require 'controllers/' . $class . '.php';
    elseif (file_exists('models/' . $class . '.php')):
        require 'models/' . $class . '.php';
    elseif (file_exists('core/' . $class . '.php')):
        require 'core/' . $class . '.php';
	elseif (file_exists('core/Conn/' . $class . '.php')):
        require 'core/Conn/' . $class . '.php';
    endif;

});

$core = new Core;
$core->run();