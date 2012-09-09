<?php

namespace Gumflap\Test;

use Gumflap\Application;

/**
 * @author Henrik Bjornskov <henrik@bjrnskov.dk>
 */
class ApplicationTest extends \Silex\WebTestCase
{
    public function createApplication()
    {
        $app = new Application(array(
            'debug' => true,
            'pusher.key' => 'pusher key',
            'pusher.secret' => 'pusher secret',
            'pusher.app_id' => 'pusher app id',
            'db.options' => array(
                'driver' => 'pdo_sqlite',
                'path' => '/var/tmp/gumflap.db',
            )
        ));

        $app['gumflap.gateway'] = $this->getMockBuilder('Gumflap\Gateway')
            ->disableOriginalConstructor()
            ->getMock()
        ;

        return $app;
    }

    public function testDefaultPage()
    {
        $client = $this->createClient();
        $crawler = $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testMessageIsCreated()
    {
        $payload = array(
            'message' => 'Do that pusher thing!',
            'username' => 'Henrik',
        );
        $pusher = $this->createPusherMock();
        $pusher
            ->expects($this->once())
            ->method('trigger')
            ->with($this->equalTo('gumflap'), $this->equalTo('message'), $this->equalTo($payload))
            ->will($this->returnValue(true))
        ;

        $this->app['pusher'] = $pusher;

        $client = $this->createClient();
        $crawler = $client->request('POST', '/message', $payload);

        $this->assertEquals(204, $client->getResponse()->getStatusCode());
    }

    public function testResponseWhenPusherIsFalse()
    {

        $pusher = $this->createPusherMock();
        $pusher
            ->expects($this->once())
            ->method('trigger')
            ->will($this->returnValue(false))
        ;

        $this->app['pusher'] = $pusher;

        $client = $this->createClient();
        $crawler = $client->request('POST', '/message', array(
            'message' => 'Do that pusher thing!',
            'username' => 'Henrik',
        ));

        $this->assertEquals(502, $client->getResponse()->getStatusCode());
    }

    public function testMessageIsNotCreatedWhenUsernameIsMissing()
    {
        $client = $this->createClient();
        $crawler = $client->request('POST', '/message', array(
            'message' => 'This message is not empty',
            'username' => '             ',
        ));

        $this->assertEquals(409, $client->getResponse()->getStatusCode());
    }

    public function testMessageIsNotCreatedWhenEmpty()
    {
        $client = $this->createClient();
        $crawler = $client->request('POST', '/message', array(
            'message' => '     ',
        ));

        $this->assertEquals(409, $client->getResponse()->getStatusCode());
    }

    public function testMessageIsNotCreatedWhenMissing()
    {
        $client = $this->createClient();
        $crawler = $client->request('POST', '/message');

        $this->assertEquals(409, $client->getResponse()->getStatusCode());
    }

    protected function createPusherMock()
    {
        return $this->getMockBuilder('Pusher')
            ->disableOriginalConstructor()
            ->getMock()
        ;
    }
}
