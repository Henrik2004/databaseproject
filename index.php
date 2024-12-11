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
                <select name="report-type" id="report-type">
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
</body>
</html>
<script>
    let api_url = 'http://localhost/php/engine.php';

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
</script>