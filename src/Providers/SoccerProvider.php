<?php
/**
 * Created by PhpStorm.
 * User: Darius
 * Date: 14.5.17
 * Time: 23.32
 */

namespace Providers;

use Controllers\SoccerController;
use Repositories\UserRepository;
use Services\SoccerService;
use Silex\Application;
use Silex\ServiceProviderInterface;

class SoccerProvider implements ServiceProviderInterface
{
    /**
     * @inherit
     *
     * @param Application $app
     */
    public function register(Application $app)
    {
        $app['page.path.start_page'] = '/';
        $app['page.path.status_json'] = '/api/v1/status';
        $app['page.path.kickertable'] = '/kickertable';

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
        $app['soccer.service'] = $app->share(
            function () use ($app) {
                $service = new SoccerService($app['event.repository'], $app['user.repository']);
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
            $app['config']['path_prefix'] . $app['page.path.start_page'],
            'page.controller:index'
        );

        //status page
        $app->get(
            $app['config']['path_prefix'] . $app['page.path.status_json'],
            'page.controller:status'
        );

        // kickertable quick status
        $app->get(
            $app['config']['path_prefix'] . $app['page.path.kickertable'],
            'page.controller:quickstatus'
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
        $app['page.controller'] = $app->share(
            function () use ($app) {
                return new SoccerController($app['twig'], $app['soccer.service']);
            }
        );
    }
}
