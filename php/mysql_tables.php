<?php
require_once 'app_config.php';

function createTables() {
    global $DB_CONNECTION;

    $statements = [
        'CREATE TABLE customers (
            id INT PRIMARY KEY,
            name VARCHAR(255),
            address VARCHAR(255),
            phone VARCHAR(20),
            email VARCHAR(255)
        )',
        'CREATE TABLE salespersons (
            id INT PRIMARY KEY,
            name VARCHAR(255),
            contactInfo VARCHAR(255)
        )',
        'CREATE TABLE cars (
            id INT PRIMARY KEY,
            model VARCHAR(255),
            year INT,
            color VARCHAR(255),
            mileage INT,
            price DECIMAL,
            customerId INT,
            FOREIGN KEY (customerId) REFERENCES customers(id)
        )',
        'CREATE TABLE invoices (
            id INT PRIMARY KEY,
            customerId INT,
            salespersonId INT,
            date DATE,
            amount DECIMAL,
            FOREIGN KEY (customerId) REFERENCES customers(id),
            FOREIGN KEY (salespersonId) REFERENCES salespersons(id)
        )',
        'CREATE TABLE services (
            id INT PRIMARY KEY,
            name VARCHAR(255),
            description TEXT,
            cost DECIMAL
        )',
        'CREATE TABLE parts (
            id INT PRIMARY KEY,
            name VARCHAR(255),
            description TEXT,
            cost DECIMAL
        )',
        'CREATE TABLE servicepart (
            serviceId INT,
            partId INT,
            PRIMARY KEY (serviceId, partId),
            FOREIGN KEY (serviceId) REFERENCES services(id),
            FOREIGN KEY (partId) REFERENCES parts(id)
        )',
        'CREATE TABLE carpart (
            carId INT,
            partId INT,
            PRIMARY KEY (carId, partId),
            FOREIGN KEY (carId) REFERENCES cars(id),
            FOREIGN KEY (partId) REFERENCES parts(id)
        )'
    ];

    foreach ($statements as $statement) {
        $stmt = $DB_CONNECTION->prepare($statement);
        $stmt->execute();
    }
}