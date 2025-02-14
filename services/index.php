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
                <th>Duration</th>
                <th>Experience level</th>
                <th>Warranty service</th>
                <th>Tools required</th>
                <th>Service type</th>
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
            <div class="field">
                <label>Duration</label>
                <input type="number" name="duration" required>
            </div>
            <div class="field">
                <label>Experience level</label>
                <input type="text" name="experienceLevel" required>
            </div>
            <div class="field">
                <label>Warranty service</label>
                <input type="checkbox" name="isWarrantyService" required>
            </div>
            <div class="field">
                <label>Tools required</label>
                <input type="text" name="toolsRequired" required>
            </div>
            <div class="field">
                <label>Service type</label>
                <input type="text" name="serviceType" required>
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
            <div class="field">
                <label>Duration</label>
                <input type="number" name="editduration" required>
            </div>
            <div class="field">
                <label>Experience level</label>
                <input type="text" name="editexperienceLevel" required>
            </div>
            <div class="field">
                <label>Warranty service</label>
                <input type="checkbox" name="editisWarrantyService" required>
            </div>
            <div class="field">
                <label>Tools required</label>
                <input type="text" name="edittoolsRequired" required>
            </div>
            <div class="field">
                <label>Service type</label>
                <input type="text" name="editserviceType" required>
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
                            <td>${service.duration}</td>
                            <td>${service.requiredExperienceLevel}</td>
                            <td>${service.isWarrantyService}</td>
                            <td>${service.toolsRequired}</td>
                            <td>${service.serviceType}</td>
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
                let service = response;
                $('input[name=editname]').val(service.name);
                $('input[name=editdescription]').val(service.description);
                $('input[name=editcost]').val(service.cost);
                $('input[name=editduration]').val(service.duration);
                $('input[name=editexperienceLevel]').val(service.requiredExperienceLevel);
                $('input[name=editisWarrantyService]').prop('checked', service.isWarrantyService);
                $('input[name=edittoolsRequired]').val(service.toolsRequired);
                $('input[name=editserviceType]').val(service.serviceType);
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
                cost: $('input[name=cost]').val(),
                duration: $('input[name=duration]').val(),
                requiredExperienceLevel: $('input[name=experienceLevel]').val(),
                isWarrantyService: $('input[name=isWarrantyService]').is(':checked'),
                toolsRequired: $('input[name=toolsRequired]').val(),
                serviceType: $('input[name=serviceType]').val()
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
                cost: $('input[name=editcost]').val(),
                duration: $('input[name=editduration]').val(),
                requiredExperienceLevel: $('input[name=editexperienceLevel]').val(),
                isWarrantyService: $('input[name=editisWarrantyService]').is(':checked'),
                toolsRequired: $('input[name=edittoolsRequired]').val(),
                serviceType: $('input[name=editserviceType]').val()
            },
            success: function() {
                location.reload();
            }
        });
    });
</script>