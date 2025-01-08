<?php

function saveCarsReport()
{
    global $MONGO_CONNECTION;
    $bulk = new MongoDB\Driver\BulkWrite;
    $cars = getCurrentCars();
    $bulk->insert(['report' => $cars, 'reportType' => 'CurrentCars']);
    $MONGO_CONNECTION->executeBulkWrite('project_db.reports', $bulk);
}

function saveCustomersReport()
{
    global $MONGO_CONNECTION;
    $bulk = new MongoDB\Driver\BulkWrite;
    $customers = getCurrentCustomers();
    $bulk->insert(['report' => $customers, 'reportType' => 'CurrentCustomers']);
    $MONGO_CONNECTION->executeBulkWrite('project_db.reports', $bulk);
}

function saveSalespersonsReport()
{
    global $MONGO_CONNECTION;
    $bulk = new MongoDB\Driver\BulkWrite;
    $salespersons = getCurrentSalespersons();
    $bulk->insert(['report' => $salespersons, 'reportType' => 'CurrentSalespersons']);
    $MONGO_CONNECTION->executeBulkWrite('project_db.reports', $bulk);
}

function saveInvoicesReport()
{
    global $MONGO_CONNECTION;
    $bulk = new MongoDB\Driver\BulkWrite;
    $invoices = getCurrentInvoices();
    $bulk->insert(['report' => $invoices, 'reportType' => 'CurrentInvoices']);
    $MONGO_CONNECTION->executeBulkWrite('project_db.reports', $bulk);
}

function savePartsReport()
{
    global $MONGO_CONNECTION;
    $bulk = new MongoDB\Driver\BulkWrite;
    $parts = getCurrentParts();
    $bulk->insert(['report' => $parts, 'reportType' => 'CurrentParts']);
    $MONGO_CONNECTION->executeBulkWrite('project_db.reports', $bulk);
}

function saveServicesReport()
{
    global $MONGO_CONNECTION;
    $bulk = new MongoDB\Driver\BulkWrite;
    $services = getCurrentServices();
    $bulk->insert(['report' => $services, 'reportType' => 'CurrentServices']);
    $MONGO_CONNECTION->executeBulkWrite('project_db.reports', $bulk);
}

function saveCarOffer($carId)
{
    global $MONGO_CONNECTION;
    $bulk = new MongoDB\Driver\BulkWrite;
    $bulk->insert(['carId' => $carId, 'offerType' => 'Car']);
    $MONGO_CONNECTION->executeBulkWrite('project_db.offers', $bulk);
}

function saveServiceOffer($serviceId)
{
    global $MONGO_CONNECTION;
    $bulk = new MongoDB\Driver\BulkWrite;
    $bulk->insert(['serviceId' => $serviceId, 'offerType' => 'Service']);
    $MONGO_CONNECTION->executeBulkWrite('project_db.offers', $bulk);
}

function savePartOffer($partId)
{
    global $MONGO_CONNECTION;
    $bulk = new MongoDB\Driver\BulkWrite;
    $bulk->insert(['partId' => $partId, 'offerType' => 'Part']);
    $MONGO_CONNECTION->executeBulkWrite('project_db.offers', $bulk);
}

function getReports()
{
    global $MONGO_CONNECTION;
    $query = new MongoDB\Driver\Query([]);
    $cursor = $MONGO_CONNECTION->executeQuery('project_db.reports', $query);
    return iterator_to_array($cursor);
}

function getOffers()
{
    global $MONGO_CONNECTION;
    $query = new MongoDB\Driver\Query([]);
    $cursor = $MONGO_CONNECTION->executeQuery('project_db.offers', $query);
    return iterator_to_array($cursor);
}