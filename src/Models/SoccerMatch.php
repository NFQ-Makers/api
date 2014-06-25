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
    protected $team1Result;

    /**
     * @var int
     */
    protected $team2Result;

    /**
     * @var string
     */
    protected $startTime;

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
     * @param $team1Result
     * @return $this
     */
    public function setTeam1Result($team1Result)
    {
        $this->team1Result = $team1Result;
        return $this;
    }

    /**
     * @return int
     */
    public function getTeam1Result()
    {
        return $this->team1Result;
    }

    /**
     * @param $team2Result
     * @return $this
     */
    public function setTeam2Result($team2Result)
    {
        $this->team2Result = $team2Result;
        return $this;
    }

    /**
     * @return int
     */
    public function getTeam2Result()
    {
        return $this->team2Result;
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
     * Save model data to DB
     */
    public function save()
    {
        parent::save(self::TABLE_NAME);
    }

}
