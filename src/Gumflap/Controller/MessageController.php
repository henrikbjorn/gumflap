<?php

namespace Gumflap\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @author Henrik Bjornskov <henrik@bjrnskov.dk>
 */
class MessageController extends \Flint\Controller\Controller
{
    /**
     * @param Request $request
     * @return Response
     */
    public function createAction(Request $request)
    {
        $pusher = $this->get('pusher');
        $gateway = $this->get('gumflap.gateway');

        if (false == $message = trim($request->request->get('message'))) {
            return new Response('Mising "message" from POST body.', 409);
        }

        if (false == $username = trim($request->request->get('username'))) {
            return new Response('Missing "username" from POST body.', 409);
        }

        if (false == $pusher->trigger('gumflap', 'message', compact('message', 'username'))) {
            return new Response('Message could not be delivered to Pusher.', 502);
        }

        $gateway->insert($username, $message);

        return new Response('', 204);
    }
}
