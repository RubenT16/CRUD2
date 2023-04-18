<header>
  <link rel="stylesheet" type="text/css" href="../css/style.css">
  <nav>
    <ul>
      <li><a href="index.php">Home</a></li>
      <?php if (!$auth->isLoggedIn()): ?>
        <li><a href="login.php">Login</a></li>
        <li><a href="register.php">Register</a></li>
      <?php else: ?>
        <li><a href="profile.php">Profile</a></li>
        <?php if ($auth->checkAdmin()): ?>
          <?php if (basename($_SERVER['PHP_SELF']) == 'admin_panel.php'): ?>
            <li><a href="userlist.php">Userlist</a></li>
            <li><a href="posts.php">Posts</a></li>
          <?php endif; ?>
          <li><a href="admin_panel.php">Admin Panel</a></li>
        <?php endif; ?>
        <li><a href="logout.php">Logout</a></li>
      <?php endif; ?>
    </ul>
  </nav>
</header>
