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

$users = $user->getAllUsers();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>User List</title>
</head>
<body>
  <?php include 'partials/header.php'; ?>

  <h1>User List</h1>

  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($users as $user): ?>
        <tr>
          <td><?php echo $user->getId(); ?></td>
          <td><?php echo $user->getFirstName(); ?></td>
          <td><?php echo $user->getLastName(); ?></td>
          <td><?php echo $user->getEmail(); ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</body>
</html>
