<?php

namespace Gumflap\Provider;

use Gumflap\Gateway;
use Gumflap\Poster;
use LiteCQRS\Bus\EventMessageHandlerFactory;
use LiteCQRS\Bus\IdentityMap\EventProviderQueue;
use Silex\Application;

class GumflapServiceProvider implements \Silex\ServiceProviderInterface
{
    public function register(Application $app)
    {
        $app['gumflap.gateway'] = $app->share(function (Application $app) {
            return new Gateway($app['db']);
        });

        $app['gumflap.poster'] = $app->share(function (Application $app) {
            return new Poster($app['gumflap.gateway'], $app['pusher'], $app['lite_cqrs.event_message_bus']);
        });

        $app['lite_cqrs.event_queue'] = $app->share(function ($app) {
            return new EventProviderQueue($app['lite_cqrs.identity_map']);
        });

        $app['lite_cqrs.event_message_handler'] = $app->share(function ($app) {
            return new EventMessageHandlerFactory($app['lite_cqrs.event_message_bus'], $app['lite_cqrs.event_queue']);
        });

        $app['lite_cqrs.commands'] = array(
            "Gumflap\\DomainCommand\\PostMessageCommand" => "gumflap.poster",
        );

        $app['lite_cqrs.event_handlers'] = array(
            "MessagePosted" => "gumflap.poster",
        );
    }

    public function boot(Application $app)
    {
    }
}
