<?php

namespace Gumflap\Pusher;

use Buzz\Browser;

/**
 * @author Henrik Bjornskov <henrik@bjrnskov.dk>
 */
class Pusher
{
    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    public function publish($channel, $event, $message)
    {
        $body = json_encode($message);
        $parameters = array(
            'name'           => $event,
            'body_md5'       => md5($body),
            'auth_key'       => $this->config->getKey(),
            'auth_timestamp' => time(),
            'auth_version'   => '1.0',

        );

    }
}
