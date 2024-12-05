<?php
session_start();
require_once 'php/engine.php';

connectDB();
?>
<!DOCTYPE html>
<html lang="en">
<?php echo file_get_contents('html/head.html'); ?>
<body>
<?php echo file_get_contents('html/header.html'); ?>
</body>
</html>
