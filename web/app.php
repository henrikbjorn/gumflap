<?php

use Gumflap\Application;

require __DIR__ . '/../vendor/autoload.php';

$configs = json_decode(file_get_contents(__DIR__ . '/../config/gumflap.json'), true);
$app = new Application($configs);
$app->run();
