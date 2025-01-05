<?php

function saveCarsReport()
{
    global $MONGO_CONNECTION;
    $bulk = new MongoDB\Driver\BulkWrite;
    $bulk->insert(['report' => 'Report data']);
    $MONGO_CONNECTION->executeBulkWrite('project_db.reports', $bulk);
}

function saveCarOffer($carId)
{
    global $MONGO_CONNECTION;
    $bulk = new MongoDB\Driver\BulkWrite;
    $bulk->insert(['carId' => $carId]);
    $MONGO_CONNECTION->executeBulkWrite('project_db.offers', $bulk);
}

function saveServiceOffer($serviceId)
{
    global $MONGO_CONNECTION;
    $bulk = new MongoDB\Driver\BulkWrite;
    $bulk->insert(['serviceId' => $serviceId]);
    $MONGO_CONNECTION->executeBulkWrite('project_db.offers', $bulk);
}

function savePartOffer($partId)
{
    global $MONGO_CONNECTION;
    $bulk = new MongoDB\Driver\BulkWrite;
    $bulk->insert(['partId' => $partId]);
    $MONGO_CONNECTION->executeBulkWrite('project_db.offers', $bulk);
}