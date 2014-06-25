<?php

namespace Repositories;

use Doctrine\DBAL\Connection;
use Models\IceCream;

class IceCreamRepository
{
    /**
     * Used DB connection.
     * @var Connection
     */
    protected $connection;

    /**
     * Create new stock service with injected services.
     *
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Get iceCream history by given userId
     *
     * @param $userId
     * @return array
     * @throws \Exception
     */
    public function getDataByUserId($userId)
    {
        $result         = array();
        $iceCreamTable  = IceCream::TABLE_NAME;
        $sql            = "SELECT * FROM {$iceCreamTable} WHERE userId = :userId ORDER BY timestamp";
        $stmt           = $this->connection->prepare($sql);
        $stmt->bindValue("userId", $userId);

        if (!$stmt->execute()) {
            throw new \Exception('IceCreamRepository: Error with executing query 1.');
        }

        $values = $stmt->fetchall(\PDO::FETCH_ASSOC);
        foreach ($values as $item) {
            $iceCream = new IceCream();
            $iceCream->assign($item);
            $result[] = $iceCream;
        }

        return $result;
    }

    public function insert($userId, $deviceId, $amount, $timestamp)
    {
        $modelData = [
            "userId"    => $userId,
            "deviceId"  => $deviceId,
            "amount"    => $amount,
            "timestamp" => $timestamp,
        ];

        $this->connection->insert(IceCream::TABLE_NAME, $modelData);
    }
}
