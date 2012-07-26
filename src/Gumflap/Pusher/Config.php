<?php

namespace Gumflap\Pusher;

/**
 * @author Henrik Bjornskov <henrik@bjrnskov.dk>
 */
class Config
{
    public function __construct($applicationId, $key, $secret)
    {
        $this->applicationId = $applicationId;
        $this->key = $key;
        $this->secret = $secret;
    }

    public function getEndpoint($channelName)
    {
        return strtr('http://api.pusherapp.com/apps/{app}/channels/{channel}/events', array(
            'channel' => $channelName,
            'app' => $this->getApplicationId(),
        ));
    }

    public function getApplicationId()
    {
        return $this->applicationId;
    }

    public function getKey()
    {
        return $this->key;
    }

    public function getSecret()
    {
        return $this->getSecret();
    }
}
