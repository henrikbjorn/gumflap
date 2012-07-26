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
        $this->app = new Application();
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

    /**
     * @dataProvider providerMissingKeys
     */
    public function testMissingKeyException($parameters)
    {
        $this->setExpectedException('RuntimeException');

        $this->app->register($this->provider, $parameters);

        $this->provider->boot($this->app);
    }

    public function providerMissingKeys()
    {
        return array(
            array(array('key' => 'key', 'secret' => 'secret')),
            array(array('app_id' => 'app_id', 'secret' => 'secret')),
            array(array('app_id' => 'app_id', 'key' => 'key')),
        );
    }
}
