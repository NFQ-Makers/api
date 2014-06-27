<?php
namespace Observers;

use Observers\Observer;
use Repositories\IceCreamRepository;

class IceCreamObserver extends Observer
{
    /**
     * @var $iceCreamService \Services\IceCreamService
     */
    protected $iceCreamService;


    /**
     * @param null $iceCreamService
     */
    public function __construct($iceCreamService)
    {
        $this->iceCreamService = $iceCreamService;
    }

    /**
     * Event "IceCream" catcher
     *
     * @param $subject
     */
    function subjectActionIceCream($subject)
    {
        $this->iceCreamService->processEvent($subject->getEventId());
    }
}
