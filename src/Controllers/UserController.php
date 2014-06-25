<?php
namespace Controllers;

use Services\UserService;
use Symfony\Component\HttpFoundation\JsonResponse;

class UserController
{
    /**
     * @var \Twig_Environment
     */
    protected $twig;

    /**
     * @var \Services\UserService
     */
    protected $userService;

    /**
     * @param $twigService
     * @param $userService
     */
    public function __construct($twigService, $userService)
    {
        $this->twig = $twigService;
        $this->userService = $userService;
    }

    /**
     * Return user data by given rfid number
     *
     * @param $rfid
     * @return JsonResponse
     */
    public function getInfo($rfid)
    {
        return new JsonResponse($this->userService->getUserInfoByCardNumber($rfid));
    }
}
