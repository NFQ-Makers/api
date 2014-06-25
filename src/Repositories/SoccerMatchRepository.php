<?php

namespace Repositories;

class SoccerMatchRepository
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
}
