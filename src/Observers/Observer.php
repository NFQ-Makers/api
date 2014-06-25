<?php
namespace Observers;

use Observers\Subject;

abstract class Observer
{
    /**
     * @param null $subject
     */
    public function __construct($subject = null)
    {
        if (is_object($subject) && $subject instanceof Subject) {
            $subject->attach($this);
        }
    }

    /**
     * On subject update call observer method named "subjectAction" . $subject->getState();
     *
     * @param $subject
     */
    public function update($subject)
    {
        $method = "subjectAction" . $subject->getState();
        if (method_exists($this, $method)) {
            call_user_func_array(array($this, $method), array($subject));
        }
    }
}
