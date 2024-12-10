<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

global $api_url;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Car dealership</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <link rel="stylesheet" type="text/css" href="/css/custom.css">
    <link rel="stylesheet" type="text/css" href="/css/fui/semantic.min.css"/>
    <link rel="stylesheet" type="text/css" href="/css/open-props.min.css">
    <script src="/js/script.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="/css/fui/semantic.min.js"></script>
</head>
<body>
<div class="ui segment hexle head-menu dark-glass inverted border-r-none">
    <div class="ui stackable secondary inverted menu border-r-none" id="hexle-head-menu">
        <a class="item menu-item-head" href="/">
            <h1>Car Dealership</h1>
        </a>
        <a class="item mobile-center" href="/cars">
            Cars
        </a>
        <a class="item mobile-center" href="/customers">
            Customers
        </a>
        <a class="item mobile-center" href="/invoices/">
            Invoices
        </a>
        <a class="item mobile-center" href="/parts">
            Parts
        </a>
        <a class="item mobile-center" href="/salespersons">
            Salespersons
        </a>
        <a class="item mobile-center" href="/services">
            Services
        </a>
    </div>
</div>
<div class="ui container">
    <div class="ui segment">
        <h2>Cars</h2>
        <a class="ui button" onclick="openCreateCarModal()">Add new car</a>
        <table class="ui celled table">
            <thead>
            <tr>
                <th>Car ID</th>
                <th>Model</th>
                <th>Year</th>
                <th>Color</th>
                <th>Mileage</th>
                <th>Price</th>
                <th>Customer ID</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody id="carstable">
            </tbody>
        </table>
    </div>
</div>
<div class="ui modal" id="createCarModal">
    <i class="close icon"></i>
    <div class="header">
        Create new car
    </div>
    <div class="content">
        <form class="ui form" id="createCarForm">
            <div class="field">
                <label>Model</label>
                <input type="text" name="model" required>
            </div>
            <div class="field">
                <label>Year</label>
                <input type="number" name="year" required>
            </div>
            <div class="field">
                <label>Color</label>
                <input type="text" name="color" required>
            </div>
            <div class="field">
                <label>Mileage</label>
                <input type="number" name="mileage" required>
            </div>
            <div class="field">
                <label>Price</label>
                <input type="number" name="price" required>
            </div>
            <div class="field">
                <label>Customer ID</label>
                <input type="number" name="customerId" required>
            </div>
            <button class="ui button" type="submit">Create</button>
        </form>
    </div>
</div>
<div class="ui modal" id="editCarModal">
    <i class="close icon"></i>
    <div class="header">
        Edit car
    </div>
    <div class="content">
        <form class="ui form" id="editCarForm">
            <div class="field">
                <label>Model</label>
                <input type="text" name="editmodel" required>
            </div>
            <div class="field">
                <label>Year</label>
                <input type="number" name="edityear" required>
            </div>
            <div class="field">
                <label>Color</label>
                <input type="text" name="editcolor" required>
            </div>
            <div class="field">
                <label>Mileage</label>
                <input type="number" name="editmileage" required>
            </div>
            <div class="field">
                <label>Price</label>
                <input type="number" name="editprice" required>
            </div>
            <div class="field">
                <label>Customer ID</label>
                <input type="number" name="editcustomerId" required>
            </div>
            <button class="ui button" type="submit">Update</button>
        </form>
    </div>
</div>
</body>
</html>
<script>
    api_url = 'http://localhost/php/engine.php';
    let currentCarId = null;

    $(document).ready(function () {
        $.ajax({
            url: api_url,
            type: 'POST',
            data: {
                action: 'getCars'
            },
            success: function (response) {
                let cars = JSON.parse(response);
                cars.forEach(car => {
                    $('#carstable').append(`
                        <tr>
                            <td>${car.id}</td>
                            <td>${car.model}</td>
                            <td>${car.year}</td>
                            <td>${car.color}</td>
                            <td>${car.mileage}</td>
                            <td>${car.price}</td>
                            <td>${car.customerId}</td>
                            <td>
                                <a class="ui button" onclick="openEditCarModal(${car.id})">Edit</a>
                                <a class="ui button" onclick="deleteCar(${car.id})">Delete</a>
                            </td>
                        </tr>
                    `);
                });
            }
        });
    });

    function openCreateCarModal() {
        $('#createCarModal').modal('show');
    }

    function openEditCarModal(id) {
        currentCarId = id;
        $.ajax({
            url: api_url,
            type: 'POST',
            data: {
                action: 'getCar',
                id: id
            },
            success: function (response) {
                let car = JSON.parse(response)[0];
                $('input[name=editmodel]').val(car.model);
                $('input[name=edityear]').val(car.year);
                $('input[name=editcolor]').val(car.color);
                $('input[name=editmileage]').val(car.mileage);
                $('input[name=editprice]').val(car.price);
                $('input[name=editcustomerId]').val(car.customerId);
                $('#editCarModal').modal('show');
            }
        });
    }

    function deleteCar(id) {
        $.ajax({
            url: api_url,
            type: 'POST',
            data: {
                action: 'deleteCar',
                id: id
            },
            success: function () {
                location.reload();
            }
        });
    }

    $('#createCarForm').submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: api_url,
            type: 'POST',
            data: {
                action: 'createCar',
                model: $('input[name=model]').val(),
                year: $('input[name=year]').val(),
                color: $('input[name=color]').val(),
                mileage: $('input[name=mileage]').val(),
                price: $('input[name=price]').val(),
                customerId: $('input[name=customerId]').val()
            },
            success: function () {
                location.reload();
            }
        });
    });

    $('#editCarForm').submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: api_url,
            type: 'POST',
            data: {
                action: 'updateCar',
                id: currentCarId,
                model: $('input[name=editmodel]').val(),
                year: $('input[name=edityear]').val(),
                color: $('input[name=editcolor]').val(),
                mileage: $('input[name=editmileage]').val(),
                price: $('input[name=editprice]').val(),
                customerId: $('input[name=editcustomerId]').val()
            },
            success: function () {
                const row = $(`#carstable tr td:contains(${currentCarId})`);
                row.find('td:nth-child(2)').text($('input[name=editmodel]').val());
                row.find('td:nth-child(3)').text($('input[name=edityear]').val());
                row.find('td:nth-child(4)').text($('input[name=editcolor]').val());
                row.find('td:nth-child(5)').text($('input[name=editmileage]').val());
                row.find('td:nth-child(6)').text($('input[name=editprice]').val());
                row.find('td:nth-child(7)').text($('input[name=editcustomerId]').val());
                $('#editCarModal').modal('hide');
            }
        });
    });
</script>