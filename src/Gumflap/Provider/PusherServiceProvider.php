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
        $app['pusher.key'] = '';
        $app['pusher.secret'] = '';
        $app['pusher.app_id'] = '';

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

        $app['twig'] = $app->share($app->extend('twig', function (\Twig_Environment $twig, Application $app) {
            $twig->addGlobal('pusher', array(
                'pusher.key'    => $app['pusher.key'],
                'pusher.secret' => $app['pusher.secret'],
                'pusher.app_id' => $app['pusher.app_id'],
            ));

            return $twig;
        }));
    }
}
