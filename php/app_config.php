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

$mongoConfig = [
    'host' => 'mongodb',
    'port' => 27017,
    'database' => 'project_db'
];

try {
    $dbManager = new DatabaseManager($mysqlConfig, $redisConfig, $mongoConfig);
    $DB_CONNECTION = $dbManager->getMysqlConnection();
    $REDIS_CONNECTION = $dbManager->getRedisConnection();
    $MONGO_CONNECTION = $dbManager->getMongoConnection();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
    exit();
}