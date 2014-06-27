<?php
/**
 * Created by PhpStorm.
 * User: Darius
 * Date: 14.5.18
 * Time: 11.08
 */
namespace Repositories;

use \Doctrine\DBAL\Connection;

class EventRepository
{
//    const TYPE_TABLE_RESET = 'TableReset';
//    const TYPE_TABLE_SHAKE = 'TableShake';
//    const TYPE_GOAL_AUTO = 'AutoGoal';
//    const TYPE_CARD_SWIPE = 'CardSwipe';
//
//    //seconds
//    const TIME_IDLE_FRAME = 50;

    /**
     * @var string
     */
    protected $tableName = 'events_log';
    /**
     * Used DB connection.
     *
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

    public function insert($deviceTime, $type, $data, $deviceId)
    {
        $modelData = [
            "deviceTime" => $deviceTime,
            "type" => $type,
            "data" => $data,
            "deviceId" => $deviceId,
        ];

        $this->connection->insert($this->tableName, $modelData);
        return $this->connection->lastInsertId();
    }

    public function getNotProcessedByType($types)
    {
        $data = array();
        if (is_array($types)) {
            $types = "'" . implode($types, "','") ."'";
            $sql = "SELECT *
                FROM {$this->tableName}
                WHERE processed = 0 and type in ($types)
                ORDER BY timestamp";

            $data = $this->connection->fetchAll($sql);
        }
        return $data;
    }

    public function getById($eventId)
    {
        $stmt = $this->connection->prepare("SELECT * FROM {$this->tableName} WHERE id = :eventId");
        $stmt->bindValue("eventId", $eventId);
        if (!$stmt->execute()) {
            throw new \Exception('EventRepository: Error with executing query 2.');
        }
        $values = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $values;
    }

    public function markAsProcessed($id)
    {
        $stmt = $this->connection->prepare("update {$this->tableName} set processed=1 where id = :id");
        $stmt->bindValue("id", $id);
        if (!$stmt->execute()) {
            throw new \Exception('EventRepository: Error with executing query 1.');
        }
    }

//    public function getActiveEventCount()
//    {
//        $sql = "SELECT count(*) as `count`
//            FROM {$this->tableName}
//            WHERE timeSec > (UNIX_TIMESTAMP() - " . self::TIME_IDLE_FRAME . ")
//            AND timeSec < UNIX_TIMESTAMP()";
//        $count = $this->connection->fetchColumn($sql);
//
//        return $count;
//    }
//
//    public function getActiveEvent()
//    {
//        $sql = "SELECT timeSec, type, data
//            FROM {$this->tableName}
//            WHERE timeSec > (SELECT MAX(timeSec) FROM {$this->tableName} WHERE type = '" . self::TYPE_TABLE_RESET . "')
//            ORDER BY timeSec";
//
//        $data = $this->connection->fetchAll($sql);
//
//        return $data;
//    }

}
