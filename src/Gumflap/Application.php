<?php

namespace Gumflap;

use Gumflap\Provider\DefaultControllerProvider;
use Gumflap\Provider\MessageControllerProvider;
use Gumflap\Provider\PusherServiceProvider;
use Silex\Provider\TwigServiceProvider;

/**
 * @author Henrik Bjornskov <henrik@bjrnskov.dk>
 */
class Application extends \Silex\Application
{
    public function __construct()
    {
        parent::__construct();

        $this->register(new TwigServiceProvider(), array(
            'twig.path' =>  __DIR__ . '/../../templates',
        ));

        $this->register(new PusherServiceProvider(), array(
            'pusher.key' => 'c7a03a82fc0062ed82fa',
            'pusher.secret' => '354e4ba562192131a3e0',
            'pusher.app_id' => 24722,
        ));

        $this->mount('', new DefaultControllerProvider());
        $this->mount('', new MessageControllerProvider());
    }
}
