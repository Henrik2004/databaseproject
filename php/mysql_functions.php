<?php

function getCars()
{
    global $DB_CONNECTION;
    $stmt = $DB_CONNECTION->prepare("SELECT * FROM cars");
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

function getCar()
{
    global $DB_CONNECTION;
    $id = $_POST['id'];
    $stmt = $DB_CONNECTION->prepare("SELECT * FROM cars WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
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
    return $result->fetch_all(MYSQLI_ASSOC);
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
    return $result->fetch_all(MYSQLI_ASSOC);
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
    return $result->fetch_all(MYSQLI_ASSOC);
}

function getInvoice()
{
    global $DB_CONNECTION;
    $id = $_POST['id'];
    $stmt = $DB_CONNECTION->prepare("SELECT * FROM invoices WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
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
    return $result->fetch_all(MYSQLI_ASSOC);
}

function getSalesperson()
{
    global $DB_CONNECTION;
    $id = $_POST['id'];
    $stmt = $DB_CONNECTION->prepare("SELECT * FROM salespersons WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
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
    return $result->fetch_all(MYSQLI_ASSOC);
}

function getPart()
{
    global $DB_CONNECTION;
    $id = $_POST['id'];
    $stmt = $DB_CONNECTION->prepare("SELECT * FROM parts WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

function createPart()
{
    global $DB_CONNECTION;
    $name = $_POST['name'];
    $description = $_POST['description'];
    $cost = $_POST['cost'];
    $stock = $_POST['stock'];
    $manufacturer = $_POST['manufacturer'];
    $warrantyPeriod = $_POST['warrantyPeriod'];
    $category = $_POST['category'];
    $weight = $_POST['weight'];
    $dimensions = $_POST['dimensions'];
    $stmt = $DB_CONNECTION->prepare("INSERT INTO parts (name, description, cost, stock, manufacturer, warrantyPeriod, category, weight, dimensions) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdisssdd", $name, $description, $cost, $stock, $manufacturer, $warrantyPeriod, $category, $weight, $dimensions);
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
    $manufacturer = $_POST['manufacturer'];
    $warrantyPeriod = $_POST['warrantyPeriod'];
    $category = $_POST['category'];
    $weight = $_POST['weight'];
    $dimensions = $_POST['dimensions'];
    $stmt = $DB_CONNECTION->prepare("UPDATE parts SET name = ?, description = ?, cost = ?, stock = ?, manufacturer = ?, warrantyPeriod = ?, category = ?, weight = ?, dimensions = ? WHERE id = ?");
    $stmt->bind_param("ssdisssddi", $name, $description, $cost, $stock, $manufacturer, $warrantyPeriod, $category, $weight, $dimensions, $id);
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
    return $result->fetch_all(MYSQLI_ASSOC);
}

function getService()
{
    global $DB_CONNECTION;
    $id = $_POST['id'];
    $stmt = $DB_CONNECTION->prepare("SELECT * FROM services WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

function createService()
{
    global $DB_CONNECTION;
    $name = $_POST['name'];
    $description = $_POST['description'];
    $cost = $_POST['cost'];
    $duration = $_POST['duration'];
    $requiredExperienceLevel = $_POST['requiredExperienceLevel'];
    $isWarrantyService = $_POST['isWarrantyService'];
    error_log($isWarrantyService);
    $isWarrantyService = $isWarrantyService === 'true' ? 1 : 0;
    $toolsRequired = $_POST['toolsRequired'];
    $serviceType = $_POST['serviceType'];
    $stmt = $DB_CONNECTION->prepare("INSERT INTO services (name, description, cost, duration, requiredExperienceLevel, isWarrantyService, toolsRequired, serviceType) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdisiss", $name, $description, $cost, $duration, $requiredExperienceLevel, $isWarrantyService, $toolsRequired, $serviceType);
    $stmt->execute();
}

function updateService()
{
    global $DB_CONNECTION;
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $cost = $_POST['cost'];
    $duration = $_POST['duration'];
    $requiredExperienceLevel = $_POST['requiredExperienceLevel'];
    $isWarrantyService = $_POST['isWarrantyService'];
    $toolsRequired = $_POST['toolsRequired'];
    $serviceType = $_POST['serviceType'];
    $stmt = $DB_CONNECTION->prepare("UPDATE services SET name = ?, description = ?, cost = ?, duration = ?, requiredExperienceLevel = ?, isWarrantyService = ?, toolsRequired = ?, serviceType = ? WHERE id = ?");
    $stmt->bind_param("ssdissssi", $name, $description, $cost, $duration, $requiredExperienceLevel, $isWarrantyService, $toolsRequired, $serviceType, $id);
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
