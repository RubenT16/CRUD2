<header>
    <nav>
    <ul>
  <li><a href="index.php">Home</a></li>
  <?php if ($auth->isLoggedIn()) { ?>
    <li><a href="profile.php">Profile</a></li>
    <?php if ($auth->checkAdmin()) { ?>
      <li><a href="admin_panel.php">Admin Panel</a></li>
    <?php } ?>
    <li><a href="logout.php">Logout</a></li>
  <?php } else { ?>
    <li><a href="register.php">Register</a></li>
    <li><a href="login.php">Login</a></li>
  <?php } ?>
</ul>

    </nav>
</header>
