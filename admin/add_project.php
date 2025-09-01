<?php
session_start();
include "../db.php";
if(!isset($_SESSION['admin'])) { header("Location: login.php"); exit; }

$message = "";
if($_SERVER['REQUEST_METHOD'] === "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $link = $_POST['link'];

    $stmt = $conn->prepare("INSERT INTO projects (name, description, link) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $description, $link);
    if($stmt->execute()) $message = "Project added successfully!";
    else $message = "Failed to add project!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Project</title>
<link rel="stylesheet" href="admin-style.css">
</head>
<body>
<div class="form-container">
<h2>Add New Project</h2>
<form method="POST">
<label>Project Name</label>
<input type="text" name="name" required>

<label>Description</label>
<textarea name="description" rows="5" required></textarea>

<label>Project Link</label>
<input type="url" name="link" required>

<button type="submit">Add Project</button>
</form>
<?php if($message) echo "<p style='text-align:center; color:green;'>$message</p>"; ?>
</div>
</body>
</html>
