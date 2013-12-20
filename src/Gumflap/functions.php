<?php

namespace Gumflap;

function create_application() {
    return new Application(__DIR__ . '/../../', is_debug());
}

function is_debug() {
    return getenv('SILEX_ENV') === 'prod';
}
