<?php
session_start();

require_once 'php/app_config.php';
require_once 'php/mysql_tables.php';

if (isset($_POST['action'])) {
    $action = $_POST['action'];
    switch ($action) {
        case 'createCustomer':
            break;
        default:
            echo "Invalid action";
            exit();
    }
}

function connectDB()
{
    createTables();
}