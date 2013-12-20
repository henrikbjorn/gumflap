<?php

namespace Gumflap\DomainEvent;

/**
 * @package Gumflap
 */
class MessagePosted extends \LiteCQRS\DefaultDomainEvent
{
    protected $username;
    protected $message;

    /**
     * @param string $username
     * @param string $message
     */
    public function __construct($username, $message)
    {
        parent::__construct(compact('username', 'message'));
    }
}
