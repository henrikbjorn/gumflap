<?php

namespace Gumflap\Controller;

abstract class AbstractController extends \Brick\Controller\AbstractController
{
    public function render($resource, $context = array())
    {
        return $this->get('twig')->render($resource, $context);
    }

    public function get($service)
    {
        return $this->pimple[$service];
    }
}
