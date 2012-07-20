<?php

namespace Gumflap;

use Gumflap\Provider\DefaultControllerProvider;
use Gumflap\Provider\MessageControllerProvider;
use Silex\Provider\TwigServiceProvider;

/**
 * @author Henrik Bjornskov <henrik@bjrnskov.dk>
 */
class Application extends \Silex\Application
{
    public function __construct()
    {
        parent::__construct();

        $this->register(new TwigServiceProvider(), array(
            'twig.path' =>  __DIR__ . '/../../templates',
        ));

        $this->mount('', new DefaultControllerProvider());
        $this->mount('', new MessageControllerProvider());
    }
}
