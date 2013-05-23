<?php

require __DIR__ . '/../vendor/autoload.php';

$configs = json_decode(file_get_contents(__DIR__ . '/../config/gumflap.json'), true);

$app = require __DIR__ . '/../src/app.php';
$app->inject($configs);
$app->run();
