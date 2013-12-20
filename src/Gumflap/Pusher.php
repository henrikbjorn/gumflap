<?php

namespace Gumflap;

use Gumflap\DomainEvent\MessagePosted;

class Pusher
{
    protected $pusher;

    public function __construct(\Pusher $pusher)
    {
        $this->pusher = $pusher;
    }

    /**
     * @param MessagePosted $event
     */
    public function onMessagePosted(MessagePosted $event)
    {
        $this->pusher->trigger('gumflap', 'message', array($event->message, $event->username));
    }
}
