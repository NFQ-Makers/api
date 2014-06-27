<?php
namespace Observers;

use Observers\Observer;

class SoccerObserver extends Observer
{

    /**
     * @var $soccerService \Services\SoccerService
     */
    protected $soccerService;

    public function __construct($soccerService)
    {
        $this->soccerService = $soccerService;
    }

    /**
     * Event catcher for "AutoGoal"
     *
     * @param $subject
     */
    public function subjectActionAutoGoal($subject)
    {
        $this->soccerService->processEventAutoGoal($subject->getEventId());
    }

    /**
     * Event catcher for "CardSwipe"
     *
     * @param $subject
     */
    public function subjectActionCardSwipe($subject)
    {
        $this->soccerService->processEventCardSwipe($subject->getEventId());
    }

    /**
     * Event catcher for "TableShake"
     *
     * @param $subject
     */
    public function subjectActionTableShake($subject)
    {
        $this->soccerService->processEventTableShake($subject->getEventId());
    }
}
