<?php

namespace Gumflap\Provider;

use Silex\Application;
use Pusher;

/**
 * @author Henrik Bjornskov <henrik@bjrnskov.dk>
 */
class PusherServiceProvider implements \Silex\ServiceProviderInterface
{
    /**
     * @param Application $app
     */
    public function register(Application $app)
    {
        $app['pusher'] = $app->share(function () use ($app) {
            return new Pusher($app['pusher.key'], $app['pusher.secret'], $app['pusher.app_id']);
        });
    }

    /**
     * @param  Application      $app
     * @throws RuntimeException
     */
    public function boot(Application $app)
    {
        foreach (array('key', 'secret', 'app_id') as $key) {
            $key = 'pusher.' . $key;

            if (false == isset($app[$key])) {
                throw new \RuntimeException(sprintf(
                    'You have not provided a value for "%s" which is required',
                    $key
                ));
            }
        }
    }
}
