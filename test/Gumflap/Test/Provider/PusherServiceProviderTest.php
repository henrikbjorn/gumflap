<?php

namespace Gumflap\Test\Provider;

use Gumflap\Provider\PusherServiceProvider;
use Silex\Application;

/**
 * @author Henrik Bjornskov <henrik@bjrnskov.dk>
 */
class PusherServiceProviderTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->provider = new PusherServiceProvider();
        $this->app = require __DIR__ . '/../../../../src/app.php';
    }

    public function testPusherIsInitiated()
    {
        $this->app->register($this->provider, array(
            'pusher.app_id' => 'app_id',
            'pusher.secret' => 'secret',
            'pusher.key'    => 'key',
        ));

        $this->assertInstanceOf('Pusher', $this->app['pusher']);
    }

    public function testPusherParametersAreTwigGlobals()
    {
        $this->app->register($this->provider, $keys = array(
            'pusher.app_id' => 'app_id',
            'pusher.secret' => 'secret',
            'pusher.key'    => 'key',
        ));

        $this->provider->boot($this->app);

        $globals = $this->app['twig']->getGlobals();

        $this->assertArrayHasKey('pusher', $globals);
        $this->assertEquals($keys, $globals['pusher']);
    }

}
