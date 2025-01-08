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
        <h2>Create report</h2>
        <form class="ui form" id="report-form">
            <div class="field">
                <label for="report-type">Report type</label>
                <select name="report-type" id="report-type" class="ui selection dropdown">
                    <option value="1">Current cars</option>
                    <option value="2">Current customers</option>
                    <option value="3">Current salespersons</option>
                    <option value="4">Current invoices</option>
                    <option value="5">Current parts</option>
                    <option value="6">Current services</option>
                </select>
            </div>
            <button class="ui button" type="submit">Generate report</button>
        </form>
    </div>
</div>
<br>
<br>
<div class="ui container">
    <div class="ui segment">
        <h2>Create offer</h2>
        <form class="ui form" id="offer-form">
            <div class="field">
                <div class="ui selection dropdown">
                    <input type="hidden" name="offer-type" id="offer-type">
                    <div class="default text">Select offer type</div>
                    <i class="dropdown icon"></i>
                    <div class="menu">
                        <div class="item" data-value="1">Car offer</div>
                        <div class="item" data-value="2">Service offer</div>
                        <div class="item" data-value="3">Part offer</div>
                    </div>
                </div>
            </div>
            <div class="field" id="offer-car-id">
                <label for="offer-car-id">Car ID</label>
                <input type="text" name="offer-car-id" id="offer-car-id" placeholder="Car ID">
            </div>
            <div class="field" id="offer-service-id">
                <label for="offer-service-id">Service ID</label>
                <input type="text" name="offer-service-id" id="offer-service-id" placeholder="Service ID">
            </div>
            <div class="field" id="offer-part-id">
                <label for="offer-part-id">Part ID</label>
                <input type="text" name="offer-part-id" id="offer-part-id" placeholder="Part ID">
            </div>
            <button class="ui button" type="submit">Generate offer</button>
        </form>
    </div>
</div>
<br>
<br>
<div class="ui container">
    <div class="ui segment">
        <h2>Reports</h2>
        <table class="ui celled table" id="reports-table">
            <thead>
            <tr>
                <th>Report Type</th>
                <th>Report</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
<br>
<br>
<div class="ui container">
    <div class="ui segment">
        <h2>Offers</h2>
        <table class="ui celled table" id="offers-table">
            <thead>
            <tr>
                <th>Offer Type</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
<br>
<br>
<br>
<br>
</body>
</html>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        $.ajax({
            url: api_url,
            type: 'POST',
            data: {
                action: 'getReports'
            },
            success: function (response) {
                console.log(response);
                let reports = JSON.parse(response);
                let tbody = $('#reports-table tbody');
                reports.forEach(report => {
                    let tr = $('<tr>');
                    tr.append($('<td>').text(report.reportType));
                    tr.append($('<td>').text(JSON.stringify(report.report)));
                    tbody.append(tr);
                });
            },
            error: function (error) {
                console.log(error);
            }
        });
        $.ajax({
            url: api_url,
            type: 'POST',
            data: {
                action: 'getOffers'
            },
            success: function (response) {
                console.log(response);
                let offers = JSON.parse(response);
                let tbody = $('#offers-table tbody');
                offers.forEach(offer => {
                    let tr = $('<tr>');
                    tr.append($('<td>').text(offer.offerType));
                    tbody.append(tr);
                });
            },
            error: function (error) {
                console.log(error);
            }
        });
    });

    $('.selection.dropdown').dropdown({
        action: 'activate',
        onChange: function (value) {
            if (value === '1') {
                $('#offer-car-id').show();
                $('#offer-service-id').hide();
                $('#offer-part-id').hide();
            } else if (value === '2') {
                $('#offer-car-id').hide();
                $('#offer-service-id').show();
                $('#offer-part-id').hide();
            } else if (value === '3') {
                $('#offer-car-id').hide();
                $('#offer-service-id').hide();
                $('#offer-part-id').show();
            }
        }
    });

    let api_url = 'http://localhost/php/engine.php';
    let offerForm = $('#offer-form');

    $('#report-form').submit(function (e) {
        e.preventDefault();
        let reportType = $('#report-type').val();
        $.ajax({
            url: api_url,
            type: 'POST',
            data: {
                action: 'createReport',
                reportType: reportType
            },
            success: function (response) {
                console.log(response);
            },
            error: function (error) {
                console.log(error);
            }
        });
    });

    offerForm.submit(function (e) {
    e.preventDefault();
    let formData = offerForm.serialize();
    console.log(formData);
    $.ajax({
        url: api_url,
        type: 'POST',
        data: 'action=createOffer&' + formData,
        success: function (response) {
            console.log(response);
        },
        error: function (error) {
            console.log(error);
        }
    });
});

</script>