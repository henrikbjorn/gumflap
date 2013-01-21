<?php

namespace Gumflap;

use Gumflap\Provider\DefaultControllerProvider;
use Gumflap\Provider\MessageControllerProvider;
use Gumflap\Provider\PusherServiceProvider;
use Gumflap\Provider\GumflapServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\DoctrineServiceProvider;

/**
 * @author Henrik Bjornskov <henrik@bjrnskov.dk>
 */
class Application extends \Flint\Application
{
    /**
     * @param array $configs
     */
    public function __construct($rootDir, $debug = false)
    {
        parent::__construct($rootDir, $debug);

        $this->inject(array(
            'twig.path' => $this['root_dir'] . '/views',
        ));

        $this->register(new GumflapServiceProvider);
        $this->register(new DoctrineServiceProvider);
        $this->register(new PusherServiceProvider);
    }

    /**
     * @param array $parameters
     */
    public function inject(array $parameters)
    {
        foreach ($parameters as $k => $v) {
            $this[$k] = $v;
        }
    }
}
