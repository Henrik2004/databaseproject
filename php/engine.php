<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../php/app_config.php';
require_once __DIR__ . '/../php/mysql_tables.php';
require_once __DIR__ . '/../php/mysql_functions.php';
require_once __DIR__ . '/../php/redis_functions.php';
require_once __DIR__ . '/../php/mongo_functions.php';

createTables();
if (isset($_POST['action'])) {
    $action = $_POST['action'];
    switch ($action) {
        case 'getCars':
            echo json_encode(getCars());
            break;
        case 'getCar':
            echo json_encode(getCar());
            break;
        case 'createCar':
            createCar();
            break;
        case 'updateCar':
            updateCar();
            break;
        case 'deleteCar':
            deleteCar();
            break;
        case 'createCustomer':
            createCustomer();
            break;
        case 'getCustomers':
            echo json_encode(getCustomers());
            break;
        case 'getCustomer':
            echo json_encode(getCustomer());
            break;
        case 'updateCustomer':
            updateCustomer();
            break;
        case 'deleteCustomer':
            deleteCustomer();
            break;
        case 'getInvoices':
            echo json_encode(getInvoices());
            break;
        case 'getInvoice':
            echo json_encode(getInvoice());
            break;
        case 'createInvoice':
            createInvoice();
            break;
        case 'updateInvoice':
            updateInvoice();
            break;
        case 'deleteInvoice':
            deleteInvoice();
            break;
        case 'getSalespersons':
            echo json_encode(getSalespersons());
            break;
        case 'getSalesperson':
            echo json_encode(getSalesperson());
            break;
        case 'createSalesperson':
            createSalesperson();
            break;
        case 'updateSalesperson':
            updateSalesperson();
            break;
        case 'deleteSalesperson':
            deleteSalesperson();
            break;
        case 'getParts':
            echo json_encode(getParts());
            break;
        case 'getPart':
            echo json_encode(getPart());
            break;
        case 'createPart':
            createPart();
            break;
        case 'updatePart':
            updatePart();
            break;
        case 'deletePart':
            deletePart();
            break;
        case 'getServices':
            echo json_encode(getServices());
            break;
        case 'getService':
            echo json_encode(getService());
            break;
        case 'createService':
            createService();
            break;
        case 'updateService':
            updateService();
            break;
        case 'deleteService':
            deleteService();
            break;
        case 'createReport':
            saveSnapshot();
            createReport();
            break;
        case 'createOffer':
            saveSnapshot();
            createOffer();
            break;
        case 'getReports':
            echo json_encode(getReports());
            break;
        case 'getOffers':
            echo json_encode(getOffers());
            break;
        default:
            echo "Invalid action";
            exit();
    }
}

function saveSnapshot()
{
    saveCurrentCars();
    saveCurrentCustomers();
    saveCurrentParts();
    saveCurrentServices();
    saveCurrentInvoices();
    saveCurrentSalespersons();
}

function createReport()
{
    $reportType = $_POST['reportType'];
    switch ($reportType) {
        case 1:
            saveCarsReport();
            break;
        case 2:
            saveCustomersReport();
            break;
        case 3:
            saveSalespersonsReport();
            break;
        case 4:
            saveInvoicesReport();
            break;
        case 5:
            savePartsReport();
            break;
        case 6:
            saveServicesReport();
            break;
        default:
            echo "Invalid report type";
            exit();
    }
}

function createOffer()
{
    $offerType = $_POST['offer-type'];
    $offerCarId = $_POST['offer-car-id'];
    $offerServiceId = $_POST['offer-service-id'];
    $offerPartId = $_POST['offer-part-id'];
    switch ($offerType) {
        case 1:
            saveCarOffer($offerCarId);
            break;
        case 2:
            saveServiceOffer($offerServiceId);
            break;
        case 3:
            savePartOffer($offerPartId);
            break;
        default:
            echo "Invalid offer type";
            exit();
    }
}