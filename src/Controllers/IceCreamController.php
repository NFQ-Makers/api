<?php
namespace Controllers;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

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
    public function userHistoryByUserId($userId)
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
    public function userHistoryByRfid($rfid)
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

    /**
     * Return user iceCream activity by given user rfid
     *
     * @param Request $request
     * @param $rfid
     * @return JsonResponse
     */
    public function userInfoByRfid(Request $request, $rfid)
    {
        $user = $this->userService->getUserInfoByCardNumber($rfid);

        if ($user["img"]) {
            $user["img"] = $request->getUriForPath('/img/players/' . $user["img"]);
        }

        $result = ["user" => $user];
        $data   = $this->iceCreamService->getUserStatusByUserId($user['id']);
        $total  = 0;
        foreach ($data as $item) {
            $total += $item->getAmount();
        }
        $result["info"]["totalAmount"] = $total;
        $result["info"]["text"] = "Kai už lango taip karšta, norisi šaltų ledų porcijos, gal dviejų? :)";

        return new JsonResponse($result, 200);
    }
}
