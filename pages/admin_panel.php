<?php
session_start();
require_once '../config/dbconfig.php';
require_once '../classes/Auth.php';
$auth = new Auth($pdo);

if (!$auth->isLoggedIn() || !$auth->checkAdmin()) {
  header('Location: index.php');
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Panel</title>
</head>
<body>
  <?php include 'partials/header.php'; ?>

  <h1>Admin Panel</h1>
  <nav>
    <ul>
      <li><a href="index.php">Home</a></li>
      <li><a href="profile.php">Profile</a></li>
      <li><a href="#">Userlist</a></li>
      <li><a href="#">Posts</a></li>
      <li><a href="logout.php">Logout</a></li>
    </ul>
  </nav>

  <p>Welcome to the Admin Panel!</p>
</body>
</html>
