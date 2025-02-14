<?php
require_once 'app_config.php';

function createTables() {
    global $DB_CONNECTION;

    $statements = [
        'CREATE TABLE customers (
            id INT PRIMARY KEY AUTO_INCREMENT,
            name VARCHAR(255) NOT NULL,
            address VARCHAR(255) NOT NULL,
            phone VARCHAR(20) NOT NULL,
            email VARCHAR(255) NOT NULL
        )',
        'CREATE TABLE salespersons (
            id INT PRIMARY KEY AUTO_INCREMENT,
            name VARCHAR(255) NOT NULL,
            contactInfo VARCHAR(255) NOT NULL
        )',
        'CREATE TABLE cars (
            id INT PRIMARY KEY AUTO_INCREMENT,
            model VARCHAR(255) NOT NULL,
            year INT NOT NULL,
            color VARCHAR(255) NOT NULL,
            mileage INT NOT NULL,
            price DECIMAL NOT NULL,
            customerId INT NOT NULL,
            FOREIGN KEY (customerId) REFERENCES customers(id)
        )',
        'CREATE TABLE invoices (
            id INT PRIMARY KEY AUTO_INCREMENT,
            customerId INT NOT NULL,
            salespersonId INT NOT NULL,
            date VARCHAR(10) NOT NULL,
            amount DECIMAL NOT NULL,
            FOREIGN KEY (customerId) REFERENCES customers(id),
            FOREIGN KEY (salespersonId) REFERENCES salespersons(id)
        )',
        'CREATE TABLE services (
            id INT PRIMARY KEY AUTO_INCREMENT,
            name VARCHAR(255) NOT NULL,
            description TEXT NOT NULL,
            cost DECIMAL NOT NULL,
            duration INT NOT NULL,
            requiredExperienceLevel VARCHAR(50) NOT NULL,
            isWarrantyService BOOLEAN NOT NULL,
            toolsRequired TEXT NOT NULL,
            serviceType VARCHAR(50) NOT NULL
        )',
        'CREATE TABLE parts (
            id INT PRIMARY KEY AUTO_INCREMENT,
            name VARCHAR(255) NOT NULL,
            description TEXT NOT NULL,
            cost DECIMAL NOT NULL,
            stock INT NOT NULL,
            manufacturer VARCHAR(255) NOT NULL,
            warrantyPeriod INT NOT NULL,
            category VARCHAR(255) NOT NULL,
            weight DECIMAL NOT NULL,
            dimensions VARCHAR(255) NOT NULL
        )',
        'CREATE TABLE servicepart (
            serviceId INT NOT NULL,
            partId INT NOT NULL,
            PRIMARY KEY (serviceId, partId),
            FOREIGN KEY (serviceId) REFERENCES services(id),
            FOREIGN KEY (partId) REFERENCES parts(id)
        )',
        'CREATE TABLE carpart (
            carId INT NOT NULL,
            partId INT NOT NULL,
            PRIMARY KEY (carId, partId),
            FOREIGN KEY (carId) REFERENCES cars(id),
            FOREIGN KEY (partId) REFERENCES parts(id)
        )'
    ];

    foreach ($statements as $statement) {
        $stmt = $DB_CONNECTION->prepare($statement);
        if ($stmt === false) {
            // Handle error
            die('Prepare failed: ' . $DB_CONNECTION->error);
        }
        $stmt->execute();
    }
}