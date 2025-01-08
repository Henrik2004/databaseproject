<?php

require_once __DIR__ . '/../php/mysql_functions.php';

function saveCurrentCars()
{
    global $REDIS_CONNECTION;
    $cars = getCars();
    $REDIS_CONNECTION->set('cars', json_encode($cars));
}

function getCurrentCars()
{
    global $REDIS_CONNECTION;
    $cars = $REDIS_CONNECTION->get('cars');
    if ($cars) {
        return json_decode($cars, true);
    } else {
        return [];
    }
}

function saveCurrentCustomers()
{
    global $REDIS_CONNECTION;
    $customers = getCustomers();
    $REDIS_CONNECTION->set('customers', json_encode($customers));
}

function getCurrentCustomers()
{
    global $REDIS_CONNECTION;
    $customers = $REDIS_CONNECTION->get('customers');
    if ($customers) {
        return json_decode($customers, true);
    } else {
        return [];
    }
}

function saveCurrentSalespersons()
{
    global $REDIS_CONNECTION;
    $salespersons = getSalespersons();
    $REDIS_CONNECTION->set('salespersons', json_encode($salespersons));
}

function getCurrentSalespersons()
{
    global $REDIS_CONNECTION;
    $salespersons = $REDIS_CONNECTION->get('salespersons');
    if ($salespersons) {
        return json_decode($salespersons, true);
    } else {
        return [];
    }
}

function saveCurrentInvoices()
{
    global $REDIS_CONNECTION;
    $invoices = getInvoices();
    $REDIS_CONNECTION->set('invoices', json_encode($invoices));
}

function getCurrentInvoices()
{
    global $REDIS_CONNECTION;
    $invoices = $REDIS_CONNECTION->get('invoices');
    if ($invoices) {
        return json_decode($invoices, true);
    } else {
        return [];
    }
}

function saveCurrentServices()
{
    global $REDIS_CONNECTION;
    $services = getServices();
    $REDIS_CONNECTION->set('services', json_encode($services));
}

function getCurrentServices()
{
    global $REDIS_CONNECTION;
    $services = $REDIS_CONNECTION->get('services');
    if ($services) {
        return json_decode($services, true);
    } else {
        return [];
    }
}

function saveCurrentParts()
{
    global $REDIS_CONNECTION;
    $parts = getParts();
    $REDIS_CONNECTION->set('parts', json_encode($parts));
}

function getCurrentParts()
{
    global $REDIS_CONNECTION;
    $parts = $REDIS_CONNECTION->get('parts');
    if ($parts) {
        return json_decode($parts, true);
    } else {
        return [];
    }
}