<?php

namespace Controllers;

use Services\TableService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Yaml\Yaml;

class SoccerController
{
    /**
     * @var \Twig_Environment
     */
    protected $twig;

    /**
     * @var TableService
     */
    protected $soccerService;

    /**
     * @param $twigService
     * @param $soccerService
     */
    public function __construct($twigService, $soccerService)
    {
        $this->twig = $twigService;
        $this->soccerService = $soccerService;
    }

    /**
     * Main page to say hello and show table status via json api
     *
     * @return string
     */
    public function index()
    {
        return $this->twig->render('index.twig');
    }

    /**
     * Get table status.
     *
     * returns table status:
     * status: ok
     * message: table free|table busy
     *
     * @return JsonResponse
     */
    public function status()
    {
        return $this->soccerService->getTableStatus();
    }

    /**
     * Quick status of remote table
     *
     * @return mixed
     */
    public function quickstatus()
    {
        return $this->twig->render('quickstatus.twig');
    }
}
