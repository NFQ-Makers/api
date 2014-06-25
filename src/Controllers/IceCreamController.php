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
     * @param $twigService
     * @param $iceCreamService
     */
    public function __construct($twigService, $iceCreamService)
    {
        $this->twig = $twigService;
        $this->iceCreamService = $iceCreamService;
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
}
