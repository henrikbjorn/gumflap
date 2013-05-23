<?php

namespace Gumflap\Controller;

/**
 * @author Henrik Bjornskov <henrik@bjrnskov.dk>
 */
class DefaultController extends \Flint\Controller\Controller
{
    /**
     * @return string
     */
    public function indexAction()
    {
        $logs = $this->get('gumflap.gateway')->logs();

        return $this->render('index.html.twig', compact('logs'));
    }
}
