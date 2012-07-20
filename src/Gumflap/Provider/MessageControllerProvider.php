<?php

namespace Gumflap\Provider;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @author Henrik Bjornskov <henrik@bjrnskov.dk>
 */
class MessageControllerProvider implements \Silex\ControllerProviderInterface
{
    /**
     * @param Application $app
     * @return Silex\ControllerCollectionInterface
     */
    public function connect(Application $app)
    {
        $controllers = $app['controllers_factory'];

        $controllers->post('/messages', function (Application $app, Request $request) {
            return new Response('', 201);
        });

        return $controllers;
    }
}
