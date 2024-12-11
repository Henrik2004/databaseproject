<?php

function saveCarsReport()
{
    global $MONGO_CONNECTION;
    $bulk = new MongoDB\Driver\BulkWrite;
    $bulk->insert(['report' => 'Report data']);
    $MONGO_CONNECTION->executeBulkWrite('project_db.reports', $bulk);
}