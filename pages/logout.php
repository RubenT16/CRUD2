<?php
session_start();
require_once '../config/dbconfig.php';
require_once '../classes/Auth.php';
$auth = new Auth($pdo);

$auth->logout();
header('Location: index.php');
exit;