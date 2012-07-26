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
        return new Application();
    }

    public function testDefaultPage()
    {
        $client = $this->createClient();
        $crawler = $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testMessageIsCreated()
    {
        $client = $this->createClient();
        $crawler = $client->request('POST', '/messages', array(
            'message' => 'Do that pusher thing!',
        ));

        $this->assertEquals(201, $client->getResponse()->getStatusCode());
    }

    public function testMessageIsNotCreatedWhenEmpty()
    {
        $client = $this->createClient();
        $crawler = $client->request('POST', '/messages', array(
            'message' => '     ',
        ));

        $this->assertEquals(400, $client->getResponse()->getStatusCode());
    }

    public function testMessageIsNotCreatedWhenMissing()
    {
        $client = $this->createClient();
        $crawler = $client->request('POST', '/messages');

        $this->assertEquals(400, $client->getResponse()->getStatusCode());
    }
}
