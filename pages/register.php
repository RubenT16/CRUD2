<?php
session_start();
require_once '../config/dbconfig.php';
require_once '../classes/Auth.php';
$auth = new Auth($pdo);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    try {
        $result = $auth->register($first_name, $last_name, $email, $password);
        if ($result === true) {
            header("Location: index.php");
            exit();
        }
    } catch (Exception $e) {
        $error = $e->getMessage();
        $saved_first_name = $first_name;
        $saved_last_name = $last_name;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
</head>
<body>
    <?php include 'partials/header.php'; ?>

    <h1>Register</h1>
    <?php if (isset($error)) { echo '<p style="color:red">' . $error . '</p>'; } ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="first_name">First Name:</label>
        <input type="text" name="first_name" value="<?php if (isset($saved_first_name)) { echo $saved_first_name; } ?>" required>
        <br>
        <label for="last_name">Last Name:</label>
        <input type="text" name="last_name" value="<?php if (isset($saved_last_name)) { echo $saved_last_name; } ?>" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php if (isset($error)) { echo $email; } ?>" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" name="password" required>
        <br>
        <input type="submit" value="Register">
    </form>
</body>
</html>
