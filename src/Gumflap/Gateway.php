<?php

namespace Gumflap;

use Doctrine\DBAL\Driver\Connection;

/**
 * @author Henrik Bjornskov <henrik@bjrnskov.dk>
 */
class Gateway
{
    /**
     * @var Connection
     */
    protected $connection;

    /**
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @param string $username
     * @param string $message
     */
    public function insert($username, $message)
    {
        $this->connection->insert('logs', compact('username', 'message'));
    }

    /**
     * @param integer $limit
     * @return array
     */
    public function logs($limit = 25)
    {
        return $this->connection->fetchAll('SELECT * FROM logs LIMIT ' . (integer) $limit);
    }
}
