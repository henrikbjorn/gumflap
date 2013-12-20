<?php

namespace Gumflap\Controller;

use Gumflap\DomainCommand\PostMessageCommand;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @author Henrik Bjornskov <henrik@bjrnskov.dk>
 */
class MessageController extends AbstractController
{
    /**
     * @param Request $request
     * @return Response
     */
    public function createAction(Request $request)
    {
        if (false == $message = trim($request->request->get('message'))) {
            return new Response('Mising "message" from POST body.', 409);
        }

        if (false == $username = trim($request->request->get('username'))) {
            return new Response('Missing "username" from POST body.', 409);
        }

        $this->get('lite_cqrs.command_bus')->handle(new PostMessageCommand(compact('username', 'message')));

        return new Response('', 202);
    }
}
