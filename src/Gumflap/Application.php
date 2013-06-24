<?php

namespace Gumflap;

use Gumflap\Provider\GumflapServiceProvider;
use Gumflap\Provider\PusherServiceProvider;
use LiteCQRS\Plugin\Silex\Provider\LiteCQRSServiceProvider;
use Silex\Provider\DoctrineServiceProvider;

/**
 * @author Henrik Bjornskov <henrik@bjrnskov.dk>
 */
class Application extends \Flint\Application
{
    /**
     * {@inheritDoc}
     */
    public function __construct($rootDir, $debug = false, array $parameters = array())
    {
        parent::__construct($rootDir, $debug, $parameters);

        $this['twig.path'] = $rootDir . '/views';
        $this['routing.resource'] = $rootDir . '/config/routing.xml';

        $this->register(new LiteCQRSServiceProvider);
        $this->register(new DoctrineServiceProvider);
        $this->register(new PusherServiceProvider);
        $this->register(new GumflapServiceProvider);
    }
}
