<?php

namespace Gumflap\Provider;

use Gumflap\Gateway;
use Gumflap\Poster;
//use LiteCQRS\Bus\EventMessageHandlerFactory;
//use LiteCQRS\Bus\IdentityMap\EventProviderQueue;
use Pimple;

class GumflapServiceProvider implements \Silex\Api\ServiceProviderInterface
{
    public function register(Pimple $app)
    {
        $app['gumflap.gateway'] = function ($app) {
            return new Gateway($app['db']);
        };

        $app['gumflap.poster'] = function ($app) {
            return new Poster($app['gumflap.gateway'], $app['pusher'], $app['lite_cqrs.event_bus']);
        };

        $app->extend('lite_cqrs.command_handler_locator', function ($locator, $app) {
            $locator->register('Gumflap\DomainCommand\PostMessageCommand', $app['gumflap.poster']);

            return $locator;
        });

        $app->extend('lite_cqrs.event_handler_locator', function ($locator, $app) {
            $locator->register($app['gumflap.poster']);

            return $locator;
        });
    }
}
