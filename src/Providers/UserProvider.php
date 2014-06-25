<?php

namespace Providers;

use Controllers\UserController;
use Repositories\UserRepository;
use Services\UserService;
use Silex\Application;
use Silex\ServiceProviderInterface;

class UserProvider implements ServiceProviderInterface
{
    /**
     * @inherit
     *
     * @param Application $app
     */
    public function register(Application $app)
    {
        $app['user.path.rfid_data_json'] = '/api/v1/user/rfid/{rfid}';

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
     * Register used services.
     *
     * @param Application $app An Application instance
     * @return void
     */
    protected function registerServices(Application $app)
    {
        $app['user.service'] = $app->share(
            function () use ($app) {
                $service = new UserService($app['user.repository']);
                return $service;
            }
        );
    }

    /**
     * Register used repositories.
     *
     * @param Application $app An Application instance
     * @return void
     */
    protected function registerRepositories(Application $app)
    {
        $app['user.repository'] = $app->share(
            function () use ($app) {
                $repository = new UserRepository($app['db']);
                return $repository;
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
        //index page
        $app->get(
            $app['config']['path_prefix'] . $app['user.path.rfid_data_json'],
            'user.controller:getInfo'
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
        $app['user.controller'] = $app->share(
            function () use ($app) {
                return new UserController($app['twig'], $app['user.service']);
            }
        );
    }
}
