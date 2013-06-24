<?php

namespace Gumflap\DomainEvent;

/**
 * @package Gumflap
 */
class MessagePosted extends \LiteCQRS\DomainObjectChanged
{
    protected $username;
    protected $message;

    /**
     * @param string $username
     * @param string $message
     */
    public function __construct($username, $message)
    {
        parent::__construct('MessagePosted', compact('username', 'message'));
    }
}
