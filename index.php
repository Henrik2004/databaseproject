<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once 'php/engine.php';
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
</body>
</html>
<script>
    let api_url = 'http://localhost/php/engine.php';
</script>