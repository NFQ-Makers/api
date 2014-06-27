<?php
namespace Controllers;

use Symfony\Component\HttpFoundation\JsonResponse;

class IceCreamController
{
    /**
     * @var \Twig_Environment
     */
    protected $twig;

    /**
     * @var \Services\IceCreamService
     */
    protected $iceCreamService;

    /**
     * @var \Services\userService
     */
    protected $userService;

    /**
     * @param $twigService
     * @param $iceCreamService
     * @param $userService
     */
    public function __construct($twigService, $iceCreamService, $userService)
    {
        $this->twig = $twigService;
        $this->iceCreamService = $iceCreamService;
        $this->userService = $userService;
    }

    /**
     * Return user iceCream activity by given userId
     *
     * @param $userId
     * @return JsonResponse
     */
    public function userStatus($userId)
    {
        $result = [];
        $data   = $this->iceCreamService->getUserStatusByUserId($userId);
        foreach ($data as $item) {
            $id = $item->getId();
            $result[$id]['id']        = $id;
            $result[$id]['userId']    = $item->getUserId();
            $result[$id]['deviceId']  = $item->getDeviceId();
            $result[$id]['amount']    = $item->getAmount();
            $result[$id]['timestamp'] = $item->getTimestamp();
        }

        return new JsonResponse($result, 200);
    }

    /**
     * Return user iceCream activity by given user rfid
     *
     * @param $rfid
     * @return JsonResponse
     */
    public function userInfoByRfid($rfid)
    {
        $user = $this->userService->getUserInfoByCardNumber($rfid);

        $result = ["user" => $user];
        $data   = $this->iceCreamService->getUserStatusByUserId($user['id']);
        foreach ($data as $item) {
            $id = $item->getId();
            $result["history"][$id]['id']        = $id;
            $result["history"][$id]['userId']    = $item->getUserId();
            $result["history"][$id]['deviceId']  = $item->getDeviceId();
            $result["history"][$id]['amount']    = $item->getAmount();
            $result["history"][$id]['timestamp'] = $item->getTimestamp();
        }

        return new JsonResponse($result, 200);
    }
}
