<?php

require __DIR__ . '/../vendor/autoload.php';

$configs = json_decode(file_get_contents(__DIR__ . '/../config/gumflap.json'), true);

$app = new Gumflap\Application(__DIR__ . '/../', true);
$app->inject($configs);
$app->run();
