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

        $controllers->post('/message', function (Application $app, Request $request) {
            if (false == $message = trim($request->request->get('message', ''))) {
                return new Response('Mising "message" from POST body.', 409);
            }

            if (false == $app['pusher']->trigger('gumflap', 'message', $message)) {
                return new Response('Message could not be delivered to Pusher.', 502);
            }

            return new Response('', 204);
        });

        return $controllers;
    }
}
