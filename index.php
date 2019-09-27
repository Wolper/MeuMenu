<?php
session_start();
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/config.php';

$core = new Core;
$core->run();
