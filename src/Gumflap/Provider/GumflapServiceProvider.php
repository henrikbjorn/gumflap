<?php

namespace Gumflap\Provider;

use Silex\Application;
use Gumflap\Gateway;

class GumflapServiceProvider implements \Silex\ServiceProviderInterface
{
    public function register(Application $app)
    {
        $app['gumflap.gateway'] = $app->share(function (Application $app) {
            return new Gateway($app['db']);
        });
    }

    public function boot(Application $app)
    {
    }
}
