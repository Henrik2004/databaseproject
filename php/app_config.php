<?php
require_once __DIR__ . '/DatabaseManager.php';

$mysqlConfig = [
    'host' => 'mysql',
    'user' => 'project_user',
    'password' => '123456',
    'database' => 'project_db'
];

$redisConfig = [
    'host' => 'redis',
    'port' => 6379
];

try {
    $dbManager = new DatabaseManager($mysqlConfig, $redisConfig);
    $DB_CONNECTION = $dbManager->getMysqlConnection();
    $REDIS_CONNECTION = $dbManager->getRedisConnection();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
    exit();
}