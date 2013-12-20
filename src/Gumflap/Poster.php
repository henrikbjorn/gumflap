<?php

namespace Gumflap;

use Gumflap\DomainCommand\PostMessageCommand;
use Gumflap\DomainEvent\MessagePosted;
use LiteCQRS\Eventing\EventMessageBus;
use Pusher;

/**
 * @package Gumflap
 */
class Poster
{
    protected $pusher;
    protected $gateway;
    protected $eventBus;

    /**
     * @param Gateway $gateway
     * @param Pusher $pusher
     */
    public function __construct(Gateway $gateway, Pusher $pusher, EventMessageBus $eventBus)
    {
        $this->gateway = $gateway;
        $this->pusher = $pusher;
        $this->eventBus = $eventBus;
    }

    /**
     * @param PostMessageCommand $command
     */
    public function postMessage(PostMessageCommand $command)
    {
        $this->gateway->insert($command->username, $command->message);

        $this->eventBus->publish(new MessagePosted($command->username, $command->message));
    }

    /**
     * @param MessagePosted $event
     */
    public function onMessagePosted(MessagePosted $event)
    {
        $this->pusher->trigger('gumflap', 'message', array($event->message, $event->username));
    }
}
