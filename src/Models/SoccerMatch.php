<?php

namespace Models;

class SoccerMatch extends BaseModel
{
    const TABLE_NAME = 'soccer_match';

    /**
     * @var int
     */
    protected $id;

    /**
     * @var int
     */
    protected $teamId1;

    /**
     * @var int
     */
    protected $teamId2;

    /**
     * @var int
     */
    protected $teamResult1;

    /**
     * @var int
     */
    protected $teamResult2;

    /**
     * @var int
     */
    protected $startTime;

    /**
     * @var int
     */
    protected $lastShake;

    /**
     * @var int
     */
    protected $deviceId;

    /**
     * @var string
     */
    protected $status;

    /**
     * @param $teamId1
     * @return $this
     */
    public function setTeamId1($teamId1)
    {
        $this->teamId1 = $teamId1;
        return $this;
    }

    /**
     * @return int
     */
    public function getTeamId1()
    {
        return $this->teamId1;
    }


    /**
     * @param $teamId2
     * @return $this
     */
    public function setTeamId2($teamId2)
    {
        $this->teamId2 = $teamId2;
        return $this;
    }

    /**
     * @return int
     */
    public function getTeamId2()
    {
        return $this->teamId2;
    }

    /**
     * @param $teamResult1
     * @return $this
     */
    public function setTeamResult1($teamResult1)
    {
        $this->teamResult1 = $teamResult1;
        return $this;
    }

    /**
     * @return int
     */
    public function getTeamResult1()
    {
        return $this->teamResult1;
    }

    /**
     * @param $teamResult2
     * @return $this
     */
    public function setTeamResult2($teamResult2)
    {
        $this->teamResult2 = $teamResult2;
        return $this;
    }

    /**
     * @return int
     */
    public function getTeamResult2()
    {
        return $this->teamResult2;
    }

    /**
     * @param $startTime
     * @return $this
     */
    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;
        return $this;
    }

    /**
     * @return string
     */
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * @param $lastShake
     * @return $this
     */
    public function setLastShake($lastShake)
    {
        $this->lastShake = $lastShake;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastShake()
    {
        return $this->lastShake;
    }

    /**
     * @param $deviceId
     * @return $this
     */
    public function setDeviceId($deviceId)
    {
        $this->deviceId = $deviceId;
        return $this;
    }

    /**
     * @return string
     */
    public function getDeviceId()
    {
        return $this->deviceId;
    }

    /**
     * @param $status
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Save model data to DB
     */
    public function save()
    {
        parent::save(self::TABLE_NAME);
    }

}
