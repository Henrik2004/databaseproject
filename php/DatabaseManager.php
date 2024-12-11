<?php

class DatabaseManager
{
    private $mysqlConnection;
    private $redisConnection;
    private $mongoConnection;

    public function __construct($mysqlConfig, $redisConfig, $mongoConfig)
    {
        $this->mysqlConnection = new mysqli(
            $mysqlConfig['host'],
            $mysqlConfig['user'],
            $mysqlConfig['password'],
            $mysqlConfig['database']
        );

        if ($this->mysqlConnection->connect_error) {
            throw new Exception("MySQL connection failed: " . $this->mysqlConnection->connect_error);
        }

        $this->redisConnection = new Redis();
        $this->redisConnection->connect($redisConfig['host'], $redisConfig['port']);

        if (!$this->redisConnection->ping()) {
            throw new Exception("Redis connection failed");
        }

        $this->mongoConnection = new MongoDB\Driver\Manager("mongodb://{$mongoConfig['host']}:{$mongoConfig['port']}/{$mongoConfig['database']}");
    }

    public function getMysqlConnection()
    {
        return $this->mysqlConnection;
    }

    public function getRedisConnection()
    {
        return $this->redisConnection;
    }

    public function getMongoConnection()
    {
        return $this->mongoConnection;
    }

    public function __destruct()
    {
        $this->mysqlConnection->close();
        $this->redisConnection->close();
    }
}
