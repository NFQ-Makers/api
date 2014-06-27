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

    }

    /**
     * Event catcher for "CardSwipe"
     *
     * @param $subject
     */
    public function subjectActionCardSwipe($subject)
    {

    }

    /**
     * Event catcher for "TableShake"
     *
     * @param $subject
     */
    public function subjectActionTableShake($subject)
    {

    }
}
