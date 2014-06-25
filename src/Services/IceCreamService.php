<?php
namespace Services;

use Repositories\IceCreamRepository;


class IceCreamService
{
    /**
     * @param IceCreamRepository $iceCreamRepository
     */
    public function __construct($iceCreamRepository)
    {
        $this->iceCreamRepository = $iceCreamRepository;
    }

    public function getUserStatusByUserId($userId)
    {
        $data = $this->iceCreamRepository->getDataByUserId($userId);
        return $data;
    }
}
