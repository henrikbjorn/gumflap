<?php

namespace Gumflap;

use Gumflap\Provider\DefaultControllerProvider;
use Gumflap\Provider\MessageControllerProvider;
use Gumflap\Provider\PusherServiceProvider;
use Silex\Provider\TwigServiceProvider;

/**
 * @author Henrik Bjornskov <henrik@bjrnskov.dk>
 */
class Application extends \Silex\Application
{
    /**
     * @param array $configs
     */
    public function __construct(array $configs = array())
    {
        parent::__construct();

        $this->register(new PusherServiceProvider(), $configs);
        $this->register(new TwigServiceProvider(), array(
            'twig.path' =>  __DIR__ . '/../../templates',
        ));

        $this['twig']->addGlobal('pusher', $configs);

        $this->mount('', new DefaultControllerProvider());
        $this->mount('', new MessageControllerProvider());
    }
}
