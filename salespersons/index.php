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
<div class="ui container">
    <div class="ui segment">
        <h2>Salespersons</h2>
        <a class="ui button" onclick="openCreateSalespersonModal()">Add new salesperson</a>
        <table class="ui celled table">
            <thead>
            <tr>
                <th>Salesperson ID</th>
                <th>Name</th>
                <th>Contact Info</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody id="salespersonstable">
            </tbody>
        </table>
    </div>
</div>
<div class="ui modal" id="createSalespersonModal">
    <i class="close icon"></i>
    <div class="header">
        Add new salesperson
    </div>
    <div class="content">
        <form class="ui form" id="createSalespersonForm">
            <div class="field">
                <label>Name</label>
                <input type="text" name="name" placeholder="Name">
            </div>
            <div class="field">
                <label>Contact Info</label>
                <input type="text" name="contactinfo" placeholder="Contact Info">
            </div>
            <button class="ui button" type="submit">Add</button>
        </form>
    </div>
</div>
<div class="ui modal" id="editSalespersonModal">
    <i class="close icon"></i>
    <div class="header">
        Edit salesperson
    </div>
    <div class="content">
        <form class="ui form" id="editSalespersonForm">
            <div class="field">
                <label>Name</label>
                <input type="text" name="editname" placeholder="Name">
            </div>
            <div class="field">
                <label>Contact Info</label>
                <input type="text" name="editcontactinfo" placeholder="Contact Info">
            </div>
            <button class="ui button" type="submit">Save</button>
        </form>
    </div>
</div>
</body>
</html>
<script>
    api_url = 'http://localhost/php/engine.php';

    $(document).ready(function () {
        $.ajax({
            url: api_url,
            type: 'POST',
            data: {
                action: 'getSalespersons'
            },
            success: function (response) {
                let salespersons = JSON.parse(response);
                salespersons.forEach(salesperson => {
                    $('#salespersonstable').append(`
                        <tr>
                            <td>${salesperson.id}</td>
                            <td>${salesperson.name}</td>
                            <td>${salesperson.contactInfo}</td>
                            <td>
                                <a class="ui button" onclick="openEditSalespersonModal(${salesperson.id})">Edit</a>
                                <a class="ui button" onclick="deleteSalesperson(${salesperson.id})">Delete</a>
                            </td>
                        </tr>
                    `);
                });
            }
        });
    });

    function openCreateSalespersonModal() {
        $('#createSalespersonModal').modal('show');
    }

    function openEditSalespersonModal(id) {
        currentSalespersonId = id;
        $.ajax({
            url: api_url,
            type: 'POST',
            data: {
                action: 'getSalesperson',
                id: id
            },
            success: function (response) {
                let salesperson = JSON.parse(response);
                $('#editSalespersonForm input[name="editname"]').val(salesperson.name);
                $('#editSalespersonForm input[name="editcontactinfo"]').val(salesperson.contact_info);
                $('#editSalespersonModal').modal('show');
            }
        });
    }

    function deleteSalesperson(id) {
        $.ajax({
            url: api_url,
            type: 'POST',
            data: {
                action: 'deleteSalesperson',
                id: id
            },
            success: function () {
                location.reload();
            }
        });
    }

    $('#createSalespersonForm').submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: api_url,
            type: 'POST',
            data: {
                action: 'createSalesperson',
                name: $('input[name=name]').val(),
                contactInfo: $('input[name=contactinfo]').val()
            },
            success: function () {
                location.reload();
            }
        });
    });

    $('#editSalespersonForm').submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: api_url,
            type: 'POST',
            data: {
                action: 'editSalesperson',
                id: currentSalespersonId,
                name: $('input[name=editname]').val(),
                contactInfo: $('input[name=editcontactinfo]').val()
            },
            success: function () {
                location.reload();
            }
        });
    });
</script>