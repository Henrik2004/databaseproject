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
        <h2>Invoices</h2>
        <a class="ui button" onclick="openCreateInvoiceModal()">Add new invoice</a>
        <table class="ui celled table">
            <thead>
            <tr>
                <th>Invoice ID</th>
                <th>Customer ID</th>
                <th>Car ID</th>
                <th>Price</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody id="invoicestable">
            </tbody>
        </table>
    </div>
</div>
<div class="ui modal" id="createinvoicemodal">
    <i class="close icon"></i>
    <div class="header">
        Add new invoice
    </div>
    <div class="content">
        <form class="ui form" id="createinvoiceform">
            <div class="field">
                <label>Customer ID</label>
                <input type="text" name="customerid" placeholder="Customer ID">
            </div>
            <div class="field">
                <label>Salesperson ID</label>
                <input type="text" name="salespersonid" placeholder="Salesperson ID">
            </div>
            <div class="field">
                <label>Date</label>
                <input type="text" name="date" placeholder="Date">
            </div>
            <div class="field">
                <label>Amount</label>
                <input type="number" name="amount" placeholder="Amount">
            </div>
            <button class="ui button" type="submit">Add invoice</button>
        </form>
    </div>
</div>
<div class="ui modal" id="editinvoicemodal">
    <i class="close icon"></i>
    <div class="header">
        Edit invoice
    </div>
    <div class="content">
        <form class="ui form" id="editinvoiceform">
            <div class="field">
                <label>Customer ID</label>
                <input type="text" name="editcustomerid" required>
            </div>
            <div class="field">
                <label>Salesperson ID</label>
                <input type="text" name="editsalespersonid" required>
            </div>
            <div class="field">
                <label>Date</label>
                <input type="text" name="editdate" required>
            </div>
            <div class="field">
                <label>Amount</label>
                <input type="number" name="editamount" required>
            </div>
            <button class="ui button" type="submit">Update</button>
        </form>
    </div>
</div>
</body>
</html>
<script>
    api_url = 'http://localhost/php/engine.php';
    let currentInvoiceId = null;

    $(document).ready(function () {
        $.ajax({
            url: api_url,
            type: 'POST',
            data: {
                action: 'getInvoices'
            },
            success: function (response) {
                let invoices = JSON.parse(response);
                invoices.forEach(invoice => {
                    $('#invoicestable').append(`
                        <tr>
                            <td>${invoice.id}</td>
                            <td>${invoice.customerId}</td>
                            <td>${invoice.salespersonId}</td>
                            <td>${invoice.date}</td>
                            <td>${invoice.amount}</td>
                            <td>
                                <a class="ui button" onclick="openEditInvoiceModal(${invoice.id})">Edit</a>
                                <a class="ui button" onclick="deleteInvoice(${invoice.id})">Delete</a>
                            </td>
                        </tr>
                    `);
                });
            }
        });
    });

    function openCreateInvoiceModal() {
        $('#createinvoicemodal').modal('show');
    }

    function openEditInvoiceModal(id) {
        currentInvoiceId = id;
        $.ajax({
            url: api_url,
            type: 'POST',
            data: {
                action: 'getInvoice',
                id: id
            },
            success: function (response) {
                const invoice = JSON.parse(response);
                $('input[name=editcustomerid]').val(invoice.customerId);
                $('input[name=editsalespersonid]').val(invoice.salespersonId);
                $('input[name=editdate]').val(invoice.date);
                $('input[name=editamount]').val(invoice.amount);
                $('#editinvoicemodal').modal('show');
            }
        });
    }

    function deleteInvoice(id) {
        $.ajax({
            url: api_url,
            type: 'POST',
            data: {
                action: 'deleteInvoice',
                id: id
            },
            success: function () {
                location.reload();
            }
        });
    }

    $('#createinvoiceform').submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: api_url,
            type: 'POST',
            data: {
                action: 'createInvoice',
                customerId: $('input[name=customerid]').val(),
                salespersonId: $('input[name=salespersonid]').val(),
                date: $('input[name=date]').val(),
                amount: $('input[name=amount]').val()
            },
            success: function () {
                location.reload();
            }
        });
    });

    $('#editinvoiceform').submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: api_url,
            type: 'POST',
            data: {
                action: 'updateInvoice',
                id: currentInvoiceId,
                customerId: $('input[name=editcustomerid]').val(),
                salespersonId: $('input[name=editsalespersonid]').val(),
                date: $('input[name=editdate]').val(),
                amount: $('input[name=editamount]').val()
            },
            success: function () {
                const row = $(`#invoicestable tr:contains(${currentInvoiceId})`);
                row.find('td:nth-child(2)').text($('input[name=editcustomerid]').val());
                row.find('td:nth-child(3)').text($('input[name=editsalespersonid]').val());
                row.find('td:nth-child(4)').text($('input[name=editdate]').val());
                row.find('td:nth-child(5)').text($('input[name=editamount]').val());
                $('#editinvoicemodal').modal('hide');
            }
        });
    });
</script>