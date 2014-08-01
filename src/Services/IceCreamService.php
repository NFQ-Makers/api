<?php
namespace Services;

use Repositories\IceCreamRepository;


class IceCreamService
{
    /**
     * @var \Repositories\IceCreamRepository
     */
    protected $iceCreamRepository;

    /**
     * @var \Repositories\EventRepository
     */
    protected $eventRepository;

    public function __construct($iceCreamRepository, $eventRepository)
    {
        $this->iceCreamRepository = $iceCreamRepository;
        $this->eventRepository = $eventRepository;
    }

    public function getUserStatusByUserId($userId)
    {
        $data = $this->iceCreamRepository->getDataByUserId($userId);
        return $data;
    }

    public function getIceCountByUserCardNumber($userId)
    {
        $data = $this->iceCreamRepository->getIceCountByUserCardNumber($userId);
        return $data;
    }

    public function processEvents()
    {
        if ($data = $this->eventRepository->getNotProcessedByType(\Models\IceCream::getTypes()))
        {
            foreach ($data as $item) {
                $itemData = json_decode($item['data']);
                $this->iceCreamRepository->insert($itemData->userId, $item["deviceId"], $itemData->amount, $item["timestamp"]);
                $this->eventRepository->markAsProcessed($item['id']);
            }
        }
    }

    public function processEvent($eventId)
    {
        if ($event = $this->eventRepository->getById($eventId))
        {
            $itemData = json_decode($event['data']);
            $this->iceCreamRepository->insert($itemData->userId, $event["deviceId"], $itemData->amount, $event["timestamp"]);
            $this->eventRepository->markAsProcessed($event['id']);
        }
    }
}
