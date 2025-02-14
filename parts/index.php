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
        <h2>Parts</h2>
        <a class="ui button" onclick="openCreatePartModal()">Add new part</a>
        <table class="ui celled table">
            <thead>
            <tr>
                <th>Part ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Manufacturer</th>
                <th>Warranty period</th>
                <th>Category</th>
                <th>Weight</th>
                <th>Dimensions</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody id="partstable">
            </tbody>
        </table>
    </div>
</div>
<div class="ui modal" id="createPartModal">
    <i class="close icon"></i>
    <div class="header">
        Add new part
    </div>
    <div class="content">
        <form class="ui form" id="createPartForm">
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
            <div class="field">
                <label>Stock</label>
                <input type="number" name="stock" required>
            </div>
            <div class="field">
                <label>Manufacturer</label>
                <input type="text" name="manufacturer" required>
            </div>
            <div class="field">
                <label>Warranty period</label>
                <input type="number" name="warrantyPeriod" required>
            </div>
            <div class="field">
                <label>Category</label>
                <input type="text" name="category" required>
            </div>
            <div class="field">
                <label>Weight</label>
                <input type="number" name="weight" required>
            </div>
            <div class="field">
                <label>Dimensions</label>
                <input type="text" name="dimensions" required>
            </div>
            <button class="ui button" type="submit">Add part</button>
        </form>
    </div>
</div>
<div class="ui modal" id="editPartModal">
    <i class="close icon"></i>
    <div class="header">
        Edit part
    </div>
    <div class="content">
        <form class="ui form" id="editPartForm">
            <input type="hidden" name="id">
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
            <div class="field">
                <label>Stock</label>
                <input type="number" name="editstock" required>
            </div>
            <div class="field">
                <label>Manufacturer</label>
                <input type="text" name="editmanufacturer" required>
            </div>
            <div class="field">
                <label>Warranty period</label>
                <input type="number" name="editwarrantyPeriod" required>
            </div>
            <div class="field">
                <label>Category</label>
                <input type="text" name="editcategory" required>
            </div>
            <div class="field">
                <label>Weight</label>
                <input type="number" name="editweight" required>
            </div>
            <div class="field">
                <label>Dimensions</label>
                <input type="text" name="editdimensions" required>
            </div>
            <button class="ui button" type="submit">Edit part</button>
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
                action: 'getParts'
            },
            success: function (response) {
                let parts = JSON.parse(response);
                parts.forEach(part => {
                    $('#partstable').append(`
                        <tr>
                            <td>${part.id}</td>
                            <td>${part.name}</td>
                            <td>${part.cost}</td>
                            <td>${part.stock}</td>
                            <td>${part.manufacturer}</td>
                            <td>${part.warrantyPeriod}</td>
                            <td>${part.category}</td>
                            <td>${part.weight}</td>
                            <td>${part.dimensions}</td>
                            <td>
                                <a class="ui button" onclick="openEditPartModal(${part.id})">Edit</a>
                                <a class="ui button" onclick="deletePart(${part.id})">Delete</a>
                            </td>
                        </tr>
                    `);
                });
            }
        });
    });

    function openCreatePartModal() {
        $('#createPartModal').modal('show');
    }

    function openEditPartModal(id) {
        $.ajax({
            url: api_url,
            type: 'POST',
            data: {
                action: 'getPart',
                id: id
            },
            success: function (response) {
                let part = JSON.parse(response);
                $('#editPartModal input[name="id"]').val(part.id);
                $('#editPartModal input[name="editname"]').val(part.name);
                $('#editPartModal input[name="editdescription"]').val(part.description);
                $('#editPartModal input[name="editcost"]').val(part.cost);
                $('#editPartModal input[name="editstock"]').val(part.stock);
                $('#editPartModal input[name="editmanufacturer"]').val(part.manufacturer);
                $('#editPartModal input[name="editwarrantyPeriod"]').val(part.warrantyPeriod);
                $('#editPartModal input[name="editcategory"]').val(part.category);
                $('#editPartModal input[name="editweight"]').val(part.weight);
                $('#editPartModal input[name="editdimensions"]').val(part.dimensions);
                $('#editPartModal').modal('show');
            }
        });
    }

    $('#createPartForm').submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: api_url,
            type: 'POST',
            data: {
                action: 'createPart',
                name: $('input[name=name]').val(),
                description: $('input[name=description]').val(),
                cost: $('input[name=cost]').val(),
                stock: $('input[name=stock]').val(),
                manufacturer: $('input[name=manufacturer]').val(),
                warrantyPeriod: $('input[name=warrantyPeriod]').val(),
                category: $('input[name=category]').val(),
                weight: $('input[name=weight]').val(),
                dimensions: $('input[name=dimensions]').val()
            },
            success: function () {
                location.reload();
            }
        });
    });

    $('#editPartForm').submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: api_url,
            type: 'POST',
            data: {
                action: 'editPart',
                id: $('input[name=id]').val(),
                name: $('input[name=editname]').val(),
                description: $('input[name=editdescription]').val(),
                cost: $('input[name=editcost]').val(),
                stock: $('input[name=editstock]').val(),
                manufacturer: $('input[name=editmanufacturer]').val(),
                warrantyPeriod: $('input[name=editwarrantyPeriod]').val(),
                category: $('input[name=editcategory]').val(),
                weight: $('input[name=editweight]').val(),
                dimensions: $('input[name=editdimensions]').val()
            },
            success: function () {
                location.reload();
            }
        });
    });
</script>