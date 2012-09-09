<?php

namespace Gumflap\Test;

use Gumflap\Gateway;

class GatewayTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->driver = $this->getMockBuilder('Doctrine\DBAL\Connection')->disableOriginalConstructor()->getMock();
        $this->gateway = new Gateway($this->driver);
    }

    public function testInsert()
    {
        $this->driver->expects($this->once())
            ->method('insert')
            ->with(
                $this->equalTo('logs'),
                $this->equalTo(array(
                'username' => 'username',
                'message' => 'message',
            )))
        ;

        $this->gateway->insert('username', 'message');
    }

    public function testLogs()
    {
        $this->driver->expects($this->once())
            ->method('fetchAll')
            ->will($this->returnValue(array()))
        ;

        $this->assertInternalType('array', $this->gateway->logs());
    }
}
