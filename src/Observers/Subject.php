<?php

namespace Observers;

abstract class Subject
{
    protected $observers = array();
    protected $state = null;

    public function __construct()
    {
        $this->observers = array();
        $this->state = null;
        $this->eventId = null;
    }

    /**
     * Attach observer to subject observers list
     *
     * @param Observer $observer
     */
    public function attach(Observer $observer)
    {
        $i = array_search($observer, $this->observers);
        if (false === $i) {
            $this->observers[] = $observer;
        }
    }

    /**
     * Remove observer from subject observers list
     *
     * @param Observer $observer
     */
    public function detach(Observer $observer)
    {
        if ($this->observers) {
            $i = array_search($observer, $this->observers);
            if (false !== $i) {
                unset($this->observers[$i]);
            }
        }
    }

    /**
     * Return subject's state
     *
     * @return null
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Return subject's event ID
     *
     * @return null
     */
    public function getEventId()
    {
        return $this->eventId;
    }

    /**
     * Set subject's state
     *
     * @param $state
     * @param $eventId
     */
    public function setState($state, $eventId)
    {
        $this->state = $state;
        $this->eventId = $eventId;
        $this->notify();
    }

    /**
     * Notify all observers about event
     */
    public function notify(){
        if ($this->observers) {
            foreach ($this->observers as $observer) {
                $observer->update($this);
            }
        }
    }

    /**
     * Return observers list
     *
     * @return array
     */
    public function getObservers()
    {
        return $this->observers;
    }

}
