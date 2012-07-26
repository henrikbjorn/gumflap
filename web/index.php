<?php

use Gumflap\Application;

require __DIR__ . '/../vendor/autoload.php';

if (false == is_file($file = __DIR__ . '/../config/gumflap.json')) {
    die('Copy "config/gumflap.json.dist" to "config/gumflap.json" and change the settings to match yours.');
}

$app = new Application(json_decode(file_get_contents($file), true));
$app->run();
