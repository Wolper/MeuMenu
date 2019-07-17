<?php
require './environment.php';

// CONFIGRAÇÕES DO BANCO ####################

if (ENVIRONMENT == "development"):
    define("BASE_URL", "http://localhost/MeuMenu/");
    define('DBSA', 'meumenu');
    define('HOST', 'localhost');
    define('USER', 'root');
    define('PASS', '');

else:
    define("BASE_URL", "http://www.projetomeumenu.com/");
    define('DBSA', 'meumenu');
    define('HOST', 'localhost');
    define('USER', 'root');
    define('PASS', '');
endif;