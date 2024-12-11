<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
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
        <h2>Services</h2>
        <a class="ui button" onclick="openCreateServiceModal()">Add new service</a>
        <table class="ui celled table">
            <thead>
            <tr>
                <th>Service ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody id="servicestable">
            </tbody>
        </table>
    </div>
</div>
<div class="ui modal" id="createServiceModal">
    <i class="close icon"></i>
    <div class="header">
        Add new service
    </div>
    <div class="content">
        <form class="ui form" id="createServiceForm">
            <div class="field">
                <label>Name</label>
                <input type="text" name="name" required>
            </div>
            <div class="field">
                <label>Description</label>
                <input type="text" name="description" required>
            </div>
            <div class="field">
                <label>Cost</label>
                <input type="number" name="cost" required>
            </div>
            <button class="ui button" type="submit">Add</button>
        </form>
    </div>
</div>
<div class="ui modal" id="editServiceModal">
    <i class="close icon"></i>
    <div class="header">
        Edit service
    </div>
    <div class="content">
        <form class="ui form" id="editServiceForm">
            <div class="field">
                <label>Name</label>
                <input type="text" name="editname" required>
            </div>
            <div class="field">
                <label>Description</label>
                <input type="text" name="editdescription" required>
            </div>
            <div class="field">
                <label>Cost</label>
                <input type="number" name="editcost" required>
            </div>
            <button class="ui button" type="submit">Save</button>
        </form>
    </div>
</div>
</body>
</html>
<script>
    api_url = 'http://localhost/php/engine.php';

    $(document).ready(function() {
        $.ajax({
            url: api_url,
            type: 'POST',
            data: {
                action: 'getServices'
            },
            success: function(response) {
                let services = JSON.parse(response);
                services.forEach(service => {
                    $('#servicestable').append(`
                        <tr>
                            <td>${service.id}</td>
                            <td>${service.name}</td>
                            <td>${service.cost}</td>
                            <td>
                                <a class="ui button" onclick="openEditServiceModal(${service.id})">Edit</a>
                                <a class="ui button" onclick="deleteService(${service.id})">Delete</a>
                            </td>
                        </tr>
                    `);
                });
            }
        });
    });

    function openCreateServiceModal() {
        $('#createServiceModal').modal('show');
    }

    function openEditServiceModal(id) {
        $.ajax({
            url: api_url,
            type: 'POST',
            data: {
                action: 'getService',
                id: id
            },
            success: function(response) {
                let service = JSON.parse(response);
                $('#editServiceModal input').val(service.name);
                $('#editServiceModal textarea').val(service.description);
                $('#editServiceModal input[type="number"]').val(service.cost);
                $('#editServiceModal input[type="hidden"]').val(service.id);
                $('#editServiceModal').modal('show');
            }
        });
    }

    function deleteService(id) {
        $.ajax({
            url: api_url,
            type: 'POST',
            data: {
                action: 'deleteService',
                id: id
            },
            success: function() {
                location.reload();
            }
        });
    }

    $('#createServiceForm').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: api_url,
            type: 'POST',
            data: {
                action: 'createService',
                name: $('input[name=name]').val(),
                description: $('input[name=description]').val(),
                cost: $('input[name=cost]').val()
            },
            success: function() {
                location.reload();
            }
        });
    });

    $('#editServiceForm').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: api_url,
            type: 'POST',
            data: {
                action: 'editService',
                id: $('input[name=id]').val(),
                name: $('input[name=editname]').val(),
                description: $('input[name=editdescription]').val(),
                cost: $('input[name=editcost]').val()
            },
            success: function() {
                location.reload();
            }
        });
    });
</script>