<?php

namespace Gumflap\Provider;

use LiteCQRS\Commanding\MemoryCommandHandlerLocator;
use LiteCQRS\Commanding\SequentialCommandBus;
use LiteCQRS\Eventing\MemoryEventHandlerLocator;
use LiteCQRS\Eventing\SynchronousInProcessEventBus;
use Pimple;

class LiteCQRSServiceProvider implements \Silex\Api\ServiceProviderInterface
{
    public function register(Pimple $app)
    {
        $app['lite_cqrs.command_bus'] = function ($app) {
            return new SequentialCommandBus($app['lite_cqrs.command_handler_locator']);
        };

        $app['lite_cqrs.event_bus'] = function ($app) {
            return new SynchronousInProcessEventBus($app['lite_cqrs.event_handler_locator']);
        };

        $app['lite_cqrs.command_handler_locator'] = function ($app) {
            return new MemoryCommandHandlerLocator;
        };

        $app['lite_cqrs.event_handler_locator'] = function ($app) {
            return new MemoryEventHandlerLocator();
        };
    }
}
