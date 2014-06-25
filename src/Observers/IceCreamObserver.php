<?php
namespace Observers;

use Observers\Observer;
use Repositories\IceCreamRepository;

class IceCreamObserver extends Observer
{
    /**
     * @var $eventRepository \Repositories\EventRepository.php
     */
    protected $eventRepository;

    /**
     * @var $iceCreamRepository \Repositories\IceCreamRepository
     */
    protected $iceCreamRepository;

    /**
     * @param null $eventRepository
     * @param $iceCreamRepository
     */
    public function __construct($eventRepository, $iceCreamRepository)
    {
        $this->eventRepository = $eventRepository;
        $this->iceCreamRepository = $iceCreamRepository;
    }

    /**
     * Event "IceCream" catcher
     *
     * @param $subject
     */
    function subjectActionIceCream($subject)
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
}
