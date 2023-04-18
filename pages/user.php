<?php
session_start();
require_once '../config/dbconfig.php';
require_once '../classes/Auth.php';
require_once '../classes/User.php';

$auth = new Auth($pdo);
$user = new User($pdo);

if (!$auth->checkAdmin()) {
    header("Location: index.php");
    exit();
}
