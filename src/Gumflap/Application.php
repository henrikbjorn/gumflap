<?php

namespace Gumflap;

use Gumflap\Provider\GumflapServiceProvider;
use Gumflap\Provider\PusherServiceProvider;
use Gumflap\Provider\LiteCQRSServiceProvider;
use Silex\Provider\DoctrineServiceProvider;
use Silex\Provider\TwigServiceProvider;

/**
 * @author Henrik Bjornskov <henrik@bjrnskov.dk>
 */
class Application extends \Brick\Application
{
    /**
     * {@inheritDoc}
     */
    public function __construct($rootDir, $debug = false, array $parameters = array())
    {
        parent::__construct(array(
            'debug' => $debug,
            'root_dir' => $rootDir,
            'config.options' => array(
                'cache_dir' => $rootDir . '/cache',
            ),
        ));

        $this->register(new LiteCQRSServiceProvider);
        $this->register(new TwigServiceProvider);
        $this->register(new DoctrineServiceProvider);
        $this->register(new PusherServiceProvider);
        $this->register(new GumflapServiceProvider);
    }

    public function boot()
    {
        $this->configure('config/gumflap.json');

        parent::boot();
    }
}
