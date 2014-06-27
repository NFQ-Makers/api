<?php

namespace Providers;

use Controllers\IceCreamController;
use Repositories\IceCreamRepository;
use Services\IceCreamService;
use Silex\Application;
use Silex\ServiceProviderInterface;

class IceCreamProvider implements ServiceProviderInterface
{
    /**
     * @inherit
     *
     * @param Application $app
     */
    public function register(Application $app)
    {
        $app['iceCream.path.userInfoByRfid'] = '/api/v1/iceCream/userInfoByRfid/{rfid}';
        $app['iceCream.path.userHistoryByRfid'] = '/api/v1/iceCream/userHistoryByRfid/{rfid}';
        $app['iceCream.path.userHistoryByUserId'] = '/api/v1/iceCream/userHistoryByUserId/{userId}';
        $this->registerRepositories($app);
        $this->registerServices($app);
        $this->registerControllers($app);
        $this->registerRoutes($app);
    }

    /**
     * @inherit
     */
    public function boot(Application $app)
    {
    }

    /**
     * Register used repositories.
     *
     * @param Application $app An Application instance
     * @return void
     */
    protected function registerRepositories(Application $app)
    {
        $app['iceCream.repository'] = $app->share(
            function () use ($app) {
                $repository = new IceCreamRepository($app['db']);
                return $repository;
            }
        );
    }

    /**
     * Register used services.
     *
     * @param Application $app An Application instance
     * @return void
     */
    protected function registerServices(Application $app)
    {
        $app['iceCream.service'] = $app->share(
            function () use ($app) {
                $service = new IceCreamService($app['iceCream.repository'], $app['event.repository']);
                return $service;
            }
        );
    }

    /**
     * Register used controllers.
     *
     * @param Application $app An Application instance
     * @return void
     */
    protected function registerControllers(Application $app)
    {
        $app['iceCream.controller'] = $app->share(
            function () use ($app) {
                return new IceCreamController($app['twig'], $app['iceCream.service'], $app['user.service']);
            }
        );
    }

    /**
     * Register used routes.
     *
     * @param Application $app An Application instance
     * @return void
     */
    protected function registerRoutes(Application $app)
    {
        $app->get(
            $app['config']['path_prefix'] . $app['iceCream.path.userHistoryByUserId'],
            'iceCream.controller:userHistoryByUserId'
        );

        $app->get(
            $app['config']['path_prefix'] . $app['iceCream.path.userInfoByRfid'],
            'iceCream.controller:userInfoByRfid'
        );

        $app->get(
            $app['config']['path_prefix'] . $app['iceCream.path.userHistoryByRfid'],
            'iceCream.controller:userHistoryByRfid'
        );
    }
}
