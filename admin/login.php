<?php
session_start();
include "../db.php";

$adminUser = "admin";
$adminPass = "1123";

$message = "";

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === $adminUser && $password === $adminPass) {
        $_SESSION['admin'] = $username;
        setcookie("admin_logged_in", "true", time()+86400, "/"); 
        header("Location: dashboard.php");
        exit;
    } else {
        $message = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Login</title>
<link rel="stylesheet" href="admin-style.css">
</head>
<body>
<div class="login-container">
    <h2>Admin Login</h2>
    <form method="POST">
        <label>Username</label>
        <input type="text" name="username" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button type="submit">Login</button>
    </form>
    <?php if($message) echo "<p style='color:red; text-align:center;'>$message</p>"; ?>
</div>
</body>
</html>
