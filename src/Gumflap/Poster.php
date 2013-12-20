<?php

namespace Gumflap;

use Gumflap\DomainCommand\PostMessageCommand;
use Gumflap\DomainEvent\MessagePosted;
use LiteCQRS\Eventing\EventMessageBus;

/**
 * @package Gumflap
 */
class Poster
{
    protected $gateway;
    protected $eventBus;

    /**
     * @param Gateway $gateway
     * @param EventMessageBus $eventBus
     */
    public function __construct(Gateway $gateway, EventMessageBus $eventBus)
    {
        $this->gateway = $gateway;
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
}
