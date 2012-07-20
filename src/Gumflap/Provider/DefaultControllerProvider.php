<?php

namespace Gumflap\Provider;

use Silex\Application;

/**
 * @author Henrik Bjornskov <henrik@bjrnskov.dk>
 */
class DefaultControllerProvider implements \Silex\ControllerProviderInterface
{
    /**
     * @param Application $app
     * @return Silex\ControllerCollection
     */
    public function connect(Application $app)
    {
        $controllers = $app['controllers_factory'];

        $controllers->get('/', function (Application $app) {
            return $app['twig']->render('index.html.twig');
        });

        return $controllers;
    }
}
