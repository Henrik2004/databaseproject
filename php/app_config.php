<?php
$db_host = "mysql";
$db_user = "project_user";
$db_pw = "123456";
$db_db = "project_db";
$DB_CONNECTION = mysqli_connect($db_host, $db_user, $db_pw, $db_db);

$api_url = "http://localhost/php/engine.php";

return $DB_CONNECTION;