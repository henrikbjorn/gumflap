<?php

function create_application($debug = true) {
    return new Gumflap\Application(__DIR__ . '/../../', $debug);
}
