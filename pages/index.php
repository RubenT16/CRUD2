<?php
session_start();
require_once '../config/dbconfig.php';
require_once '../classes/Auth.php';
$auth = new Auth($pdo);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
</head>
<body>
    <?php include 'partials/header.php'; ?>

    <h1>Welcome to the CRUD System</h1>
</body>
</html>
