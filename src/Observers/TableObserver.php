<?php
namespace Observers;

use Observers\Observer;

class TableObserver extends Observer
{
    protected $eventRepository;

    public function __construct($eventRepository)
    {
        $this->eventRepository = $eventRepository;
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
