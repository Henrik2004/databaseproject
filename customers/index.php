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
<br>
<br>
<div class="ui container">
    <div class="ui segment">
        <h2>Customers</h2>
        <a class="ui button" onclick="openCreateCustomerModal()">Add new customer</a>
        <table class="ui celled table">
            <thead>
            <tr>
                <th>Customer ID</th>
                <th>Name</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody id="customerstable">
            </tbody>
        </table>
    </div>
</div>
<div class="ui modal" id="createCustomerModal">
    <i class="close icon"></i>
    <div class="header">
        Create new customer
    </div>
    <div class="content">
        <form class="ui form" id="createCustomerForm">
            <div class="field">
                <label>Name</label>
                <input type="text" name="name" required>
            </div>
            <div class="field">
                <label>Address</label>
                <input type="text" name="address" required>
            </div>
            <div class="field">
                <label>Phone</label>
                <input type="text" name="phone" required>
            </div>
            <div class="field">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>
            <button class="ui button" type="submit">Create</button>
        </form>
    </div>
</div>
<div class="ui modal" id="editCustomerModal">
    <i class="close icon"></i>
    <div class="header">
        Edit customer
    </div>
    <div class="content">
        <form class="ui form" id="editCustomerForm">
            <div class="field">
                <label>Name</label>
                <input type="text" name="editname" required>
            </div>
            <div class="field">
                <label>Address</label>
                <input type="text" name="editaddress" required>
            </div>
            <div class="field">
                <label>Phone</label>
                <input type="text" name="editphone" required>
            </div>
            <div class="field">
                <label>Email</label>
                <input type="email" name="editemail" required>
            </div>
            <button class="ui button" type="submit">Save</button>
        </form>
    </div>
</div>

</body>
</html>
<script>
    api_url = 'http://localhost/php/engine.php';
    let currentCustomerId = null;

    $(document).ready(function () {
        $.ajax({
            url: api_url,
            type: 'POST',
            data: {
                action: 'getCustomers'
            },
            success: function (response) {
                const customers = JSON.parse(response);
                customers.forEach(customer => {
                    $('#customerstable').append(`
                        <tr>
                            <td>${customer.id}</td>
                            <td>${customer.name}</td>
                            <td>${customer.address}</td>
                            <td>${customer.phone}</td>
                            <td>${customer.email}</td>
                            <td>
                                <button class="ui button" onclick="openEditCustomerModal(${customer.id})">Edit</button>
                                <button class="ui button" onclick="deleteCustomer(${customer.id})">Delete</button>
                            </td>
                        </tr>
                    `);
                });
            }
        });
    });

    function openCreateCustomerModal() {
        $('#createCustomerModal').modal('show');
    }

    function openEditCustomerModal(id) {
        currentCustomerId = id;
        $.ajax({
            url: api_url,
            type: 'POST',
            data: {
                action: 'getCustomer',
                id: id
            },
            success: function (response) {
                const customer = JSON.parse(response)[0];
                $('#editCustomerForm input[name=editname]').val(customer.name);
                $('#editCustomerForm input[name=editaddress]').val(customer.address);
                $('#editCustomerForm input[name=editphone]').val(customer.phone);
                $('#editCustomerForm input[name=editemail]').val(customer.email);
                $('#editCustomerModal').modal('show');
            }
        });
    }

    function deleteCustomer(id) {
        $.ajax({
            url: api_url,
            type: 'POST',
            data: {
                action: 'deleteCustomer',
                id: id
            },
            success: function () {
                location.reload();
            }
        });
    }

    $('#createCustomerForm').submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: api_url,
            type: 'POST',
            data: {
                action: 'createCustomer',
                name: $('input[name=name]').val(),
                address: $('input[name=address]').val(),
                phone: $('input[name=phone]').val(),
                email: $('input[name=email]').val()
            },
            success: function () {
                location.reload();
            }
        });
    });

    $('#editCustomerForm').submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: api_url,
            type: 'POST',
            data: {
                action: 'updateCustomer',
                id: currentCustomerId,
                name: $('input[name=editname]').val(),
                address: $('input[name=editaddress]').val(),
                phone: $('input[name=editphone]').val(),
                email: $('input[name=editemail]').val()
            },
            success: function () {
                const row = $(`#customerstable tr:contains(${currentCustomerId})`);
                row.find('td:nth-child(2)').text($('input[name=editname]').val());
                row.find('td:nth-child(3)').text($('input[name=editaddress]').val());
                row.find('td:nth-child(4)').text($('input[name=editphone]').val());
                row.find('td:nth-child(5)').text($('input[name=editemail]').val());
                $('#editCustomerModal').modal('hide');
            }
        });
    });
</script>
