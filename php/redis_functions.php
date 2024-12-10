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