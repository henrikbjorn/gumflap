<?php

namespace Gumflap\DomainCommand;

/**
 * @package Gumflap
 */
class PostMessageCommand extends \LiteCQRS\DefaultCommand
{
    public $username;
    public $message;
}
