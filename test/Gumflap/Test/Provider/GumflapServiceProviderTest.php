<?php

namespace Gumflap\Test\Provider;

use Gumflap\Provider\GumflapServiceProvider;
use Silex\Application;

/**
 * @author Henrik Bjornskov <henrik@bjrnskov.dk>
 */
class GumflapServiceProviderTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->app = new Application();
    }

    public function testGumflapServiceExists()
    {
        $this->app->register(new GumflapServiceProvider());
        $this->app['db'] = $this->getMock('Doctrine\DBAl\Driver\Connection');

        $this->assertInstanceOf('Gumflap\Gateway', $this->app['gumflap.gateway']);
    }
}
