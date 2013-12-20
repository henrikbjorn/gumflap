<?php

namespace Gumflap\Provider;

use Pimple;
use Pusher;

/**
 * @author Henrik Bjornskov <henrik@bjrnskov.dk>
 */
class PusherServiceProvider implements \Silex\Api\ServiceProviderInterface
{
    /**
     * @param Application $app
     */
    public function register(Pimple $app)
    {
        $app['pusher'] = function () use ($app) {
            return new Pusher($app['pusher.key'], $app['pusher.secret'], $app['pusher.app_id']);
        };
    }
}
