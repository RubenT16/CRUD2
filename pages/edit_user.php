<?php
session_start();
require_once '../config/dbconfig.php';
require_once '../classes/Auth.php';
require_once '../classes/User.php';

$auth = new Auth($pdo);
$user = new User($pdo);

if (!$auth->isLoggedIn()) {
  header('Location: index.php');
  exit;
}

if (!$auth->checkAdmin()) {
  header('Location: index.php');
  exit;
}

if (!isset($_GET['id'])) {
  header('Location: userlist.php');
  exit;
}

$user_id = $_GET['id'];
$user_data = $user->readUserById($user_id);
if (!$user_data) {
  header('Location: userlist.php');
  exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $email = $_POST['email'];

  $user->updateUser($user_id, $first_name, $last_name, $email);

  header('Location: userlist.php');
  exit;
}

if (isset($_POST['delete'])) {
  $user->deleteUser($user_id);

  header('Location: userlist.php');
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit User</title>
  <script>
    function deleteUser() {
      if (confirm('Are you sure you want to delete this user?')) {
        document.getElementById('delete-form').submit();
      }
    }
  </script>
</head>
<body>
  <?php include 'partials/header.php'; ?>

  <h1>Edit User</h1>

  <form method="POST">
    <label for="first_name">First Name:</label>
    <input type="text" id="
