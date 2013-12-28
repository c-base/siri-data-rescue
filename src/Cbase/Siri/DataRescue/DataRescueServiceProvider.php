<?php
/**
 * Dazz Copyright 2013
 * 
 */

namespace Cbase\Siri\DataRescue;

use Silex\Application;

class DataRescueServiceProvider implements \Silex\ServiceProviderInterface
{
    /**
     * Registers services on the given app.
     *
     * This method should only be used to configure services and parameters.
     * It should not get services.
     *
     * @param Application $app An Application instance
     */
    public function register(Application $app)
    {
        $app['finder'] = function() { return \Symfony\Component\Finder\Finder::create(); };

        $app['siri'] = $app->share(function () {
            return new \Cbase\Siri\Siri;
        });

        $app['siri.storage.path'] = '/dump';
        $app['siri.storage.webpath'] = '/data/dump';

        $app['siri.storage.id'] = $app->share(
            function () use ($app) {
                return $app['siri.storage']->getCurrentId(
                    $app['siri.storage.path']
                );
            }
        );

        $app['siri.storage'] = $app->share(
            function () use ($app) {

                $rescueService = new Storage(
                    $app->raw('finder'),
                    $app['siri.storage.path']
                );

                return $rescueService;
            }
        );

    }

    /**
     * Bootstraps the application.
     *
     * This method is called after all services are registered
     * and should be used for "dynamic" configuration (whenever
     * a service must be requested).
     */
    public function boot(Application $app)
    {
        // TODO: Implement boot() method.
    }
}
 