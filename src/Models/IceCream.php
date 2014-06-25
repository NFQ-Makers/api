<?php

namespace Models;

class IceCream extends BaseModel
{
    const TABLE_NAME = 'ice_cream';

    // types
    const TYPE_ICE_CREAM = "IceCream";


    /**
     * @var int
     */
    protected $id;

    /**
     * @var int
     */
    protected $userId;

    /**
     * @var string
     */
    protected $deviceId;

    /**
     * @var int
     */
    protected $amount;

    /**
     * @var int
     */
    protected $timestamp;

    static function getTypes()
    {
        return array(self::TYPE_ICE_CREAM => self::TYPE_ICE_CREAM);
    }

    /**
     * @param int $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getid()
    {
        return $this->id;
    }

    /**
     * @param int $userId
     * @return $this
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param int $deviceId
     * @return $this
     */
    public function setDeviceId($deviceId)
    {
        $this->deviceId = $deviceId;
        return $this;
    }

    /**
     * @return int
     */
    public function getDeviceId()
    {
        return $this->deviceId;
    }

    /**
     * @param int $amount
     * @return $this
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @return int
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @return int
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * Save model data to DB
     */
    public function save()
    {
        parent::save(self::TABLE_NAME);
    }
}
