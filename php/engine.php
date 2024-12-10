<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../php/app_config.php';
require_once __DIR__ . '/../php/mysql_tables.php';

createTables();
if (isset($_POST['action'])) {
    $action = $_POST['action'];
    switch ($action) {
        case 'getCars':
            getCars();
            break;
        case 'getCar':
            getCar();
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
            getCustomers();
            break;
        case 'getCustomer':
            getCustomer();
            break;
        case 'updateCustomer':
            updateCustomer();
            break;
        case 'deleteCustomer':
            deleteCustomer();
            break;
        case 'getInvoices':
            getInvoices();
            break;
        case 'getInvoice':
            getInvoice();
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
            getSalespersons();
            break;
        case 'getSalesperson':
            getSalesperson();
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
            getParts();
            break;
        case 'getPart':
            getPart();
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
            getServices();
            break;
        case 'getService':
            getService();
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
        default:
            echo "Invalid action";
            exit();
    }
}

function getCars()
{
    global $DB_CONNECTION;
    $stmt = $DB_CONNECTION->prepare("SELECT * FROM cars");
    $stmt->execute();
    $result = $stmt->get_result();
    $cars = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($cars);
}

function getCar()
{
    global $DB_CONNECTION;
    $id = $_POST['id'];
    $stmt = $DB_CONNECTION->prepare("SELECT * FROM cars WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $car = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($car);
}

function createCar()
{
    global $DB_CONNECTION;
    $model = $_POST['model'];
    $year = $_POST['year'];
    $color = $_POST['color'];
    $mileage = $_POST['mileage'];
    $price = $_POST['price'];
    $customerId = $_POST['customerId'];
    $stmt = $DB_CONNECTION->prepare("INSERT INTO cars (model, year, color, mileage, price, customerId) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sissdi", $model, $year, $color, $mileage, $price, $customerId);
    $stmt->execute();
}

function updateCar()
{
    global $DB_CONNECTION;
    $id = $_POST['id'];
    $model = $_POST['model'];
    $year = $_POST['year'];
    $color = $_POST['color'];
    $mileage = $_POST['mileage'];
    $price = $_POST['price'];
    $customerId = $_POST['customerId'];
    $stmt = $DB_CONNECTION->prepare("UPDATE cars SET model = ?, year = ?, color = ?, mileage = ?, price = ?, customerId = ? WHERE id = ?");
    $stmt->bind_param("sissdii", $model, $year, $color, $mileage, $price, $customerId, $id);
    $stmt->execute();
}

function deleteCar()
{
    global $DB_CONNECTION;
    $id = $_POST['id'];
    $stmt = $DB_CONNECTION->prepare("DELETE FROM cars WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

function createCustomer()
{
    global $DB_CONNECTION;
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $stmt = $DB_CONNECTION->prepare("INSERT INTO customers (name, address, phone, email) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $address, $phone, $email);
    $stmt->execute();
}

function getCustomers()
{
    global $DB_CONNECTION;
    $stmt = $DB_CONNECTION->prepare("SELECT * FROM customers");
    $stmt->execute();
    $result = $stmt->get_result();
    $customers = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($customers);
}

function getCustomer()
{
    error_log("getCustomer");
    global $DB_CONNECTION;
    $id = $_POST['id'];
    $stmt = $DB_CONNECTION->prepare("SELECT * FROM customers WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $customer = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($customer);
}

function updateCustomer()
{
    global $DB_CONNECTION;
    $id = $_POST['id'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $stmt = $DB_CONNECTION->prepare("UPDATE customers SET name = ?, address = ?, phone = ?, email = ? WHERE id = ?");
    $stmt->bind_param("ssssi", $name, $address, $phone, $email, $id);
    $stmt->execute();
}

function deleteCustomer()
{
    global $DB_CONNECTION;
    $id = $_POST['id'];
    $stmt = $DB_CONNECTION->prepare("DELETE FROM customers WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

function getInvoices()
{
    global $DB_CONNECTION;
    $stmt = $DB_CONNECTION->prepare("SELECT * FROM invoices");
    $stmt->execute();
    $result = $stmt->get_result();
    $invoices = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($invoices);
}

function getInvoice()
{
    global $DB_CONNECTION;
    $id = $_POST['id'];
    $stmt = $DB_CONNECTION->prepare("SELECT * FROM invoices WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $invoice = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($invoice);
}

function createInvoice()
{
    global $DB_CONNECTION;
    $customerId = $_POST['customerId'];
    $salespersonId = $_POST['salespersonId'];
    $date = $_POST['date'];
    $amount = $_POST['amount'];
    $stmt = $DB_CONNECTION->prepare("INSERT INTO invoices (customerId, salespersonId, date, amount) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iisd", $customerId, $salespersonId, $date, $amount);
    $stmt->execute();
}

function updateInvoice()
{
    global $DB_CONNECTION;
    $id = $_POST['id'];
    $customerId = $_POST['customerId'];
    $salespersonId = $_POST['salespersonId'];
    $date = $_POST['date'];
    $amount = $_POST['amount'];
    $stmt = $DB_CONNECTION->prepare("UPDATE invoices SET customerId = ?, salespersonId = ?, date = ?, amount = ? WHERE id = ?");
    $stmt->bind_param("iisdi", $customerId, $salespersonId, $date, $amount, $id);
    $stmt->execute();
}

function deleteInvoice()
{
    global $DB_CONNECTION;
    $id = $_POST['id'];
    $stmt = $DB_CONNECTION->prepare("DELETE FROM invoices WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

function getSalespersons()
{
    global $DB_CONNECTION;
    $stmt = $DB_CONNECTION->prepare("SELECT * FROM salespersons");
    $stmt->execute();
    $result = $stmt->get_result();
    $salespersons = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($salespersons);
}

function getSalesperson()
{
    global $DB_CONNECTION;
    $id = $_POST['id'];
    $stmt = $DB_CONNECTION->prepare("SELECT * FROM salespersons WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $salesperson = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($salesperson);
}

function createSalesperson()
{
    global $DB_CONNECTION;
    $name = $_POST['name'];
    $contactInfo = $_POST['contactInfo'];
    $stmt = $DB_CONNECTION->prepare("INSERT INTO salespersons (name, contactInfo) VALUES (?, ?)");
    $stmt->bind_param("ss", $name, $contactInfo);
    $stmt->execute();
}

function updateSalesperson()
{
    global $DB_CONNECTION;
    $id = $_POST['id'];
    $name = $_POST['name'];
    $contactInfo = $_POST['contactInfo'];
    $stmt = $DB_CONNECTION->prepare("UPDATE salespersons SET name = ?, contact_info = ? WHERE id = ?");
    $stmt->bind_param("ssi", $name, $contactInfo, $id);
    $stmt->execute();
}

function deleteSalesperson()
{
    global $DB_CONNECTION;
    $id = $_POST['id'];
    $stmt = $DB_CONNECTION->prepare("DELETE FROM salespersons WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

function getParts()
{
    global $DB_CONNECTION;
    $stmt = $DB_CONNECTION->prepare("SELECT * FROM parts");
    $stmt->execute();
    $result = $stmt->get_result();
    $parts = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($parts);
}

function getPart()
{
    global $DB_CONNECTION;
    $id = $_POST['id'];
    $stmt = $DB_CONNECTION->prepare("SELECT * FROM parts WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $part = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($part);
}

function createPart()
{
    global $DB_CONNECTION;
    $name = $_POST['name'];
    $description = $_POST['description'];
    $cost = $_POST['cost'];
    $stock = $_POST['stock'];
    $stmt = $DB_CONNECTION->prepare("INSERT INTO parts (name, description, cost, stock) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssdi", $name, $description, $cost, $stock);
    $stmt->execute();
}

function updatePart()
{
    global $DB_CONNECTION;
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $cost = $_POST['cost'];
    $stock = $_POST['stock'];
    $stmt = $DB_CONNECTION->prepare("UPDATE parts SET name = ?, description = ?, cost = ?, stock = ? WHERE id = ?");
    $stmt->bind_param("ssdii", $name, $description, $cost, $stock, $id);
    $stmt->execute();
}

function deletePart()
{
    global $DB_CONNECTION;
    $id = $_POST['id'];
    $stmt = $DB_CONNECTION->prepare("DELETE FROM parts WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

function getServices()
{
    global $DB_CONNECTION;
    $stmt = $DB_CONNECTION->prepare("SELECT * FROM services");
    $stmt->execute();
    $result = $stmt->get_result();
    $services = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($services);
}

function getService()
{
    global $DB_CONNECTION;
    $id = $_POST['id'];
    $stmt = $DB_CONNECTION->prepare("SELECT * FROM services WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $service = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($service);
}

function createService()
{
    global $DB_CONNECTION;
    $name = $_POST['name'];
    $description = $_POST['description'];
    $cost = $_POST['cost'];
    $stmt = $DB_CONNECTION->prepare("INSERT INTO services (name, description, cost) VALUES (?, ?, ?)");
    $stmt->bind_param("ssd", $name, $description, $cost);
    $stmt->execute();
}

function updateService()
{
    global $DB_CONNECTION;
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $cost = $_POST['cost'];
    $stmt = $DB_CONNECTION->prepare("UPDATE services SET name = ?, description = ?, cost = ? WHERE id = ?");
    $stmt->bind_param("ssdi", $name, $description, $cost, $id);
    $stmt->execute();
}

function deleteService()
{
    global $DB_CONNECTION;
    $id = $_POST['id'];
    $stmt = $DB_CONNECTION->prepare("DELETE FROM services WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}