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
        return new Application(array(
            'pusher.key' => 'pusher key',
            'pusher.secret' => 'pusher secret',
            'pusher.app_id' => 'pusher app id',
        ));
    }

    public function testDefaultPage()
    {
        $client = $this->createClient();
        $crawler = $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testMessageIsCreated()
    {
        $pusher = $this->createPusherMock();
        $pusher
            ->expects($this->once())
            ->method('trigger')
            ->with($this->equalTo('gumflap'), $this->equalTo('message'), $this->equalTo('Do that pusher thing!'))
            ->will($this->returnValue(true))
        ;

        $this->app['pusher'] = $pusher;

        $client = $this->createClient();
        $crawler = $client->request('POST', '/message', array(
            'message' => 'Do that pusher thing!',
        ));

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
        ));

        $this->assertEquals(502, $client->getResponse()->getStatusCode());
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
