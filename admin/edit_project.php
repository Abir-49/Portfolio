<?php
session_start();
include "../db.php";

if(!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

$message = "";
if(isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $result = $conn->query("SELECT * FROM projects WHERE id=$id");
    if($result->num_rows === 0) {
        die("Project not found!");
    }
    $project = $result->fetch_assoc();
} else {
    die("Invalid project ID!");
}
if($_SERVER['REQUEST_METHOD'] === "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $link = $_POST['link'];

    $stmt = $conn->prepare("UPDATE projects SET name=?, description=?, link=? WHERE id=?");
    $stmt->bind_param("sssi", $name, $description, $link, $id);
    if($stmt->execute()) {
        $message = "Project updated successfully!";
        // Refresh project data
        $project['name'] = $name;
        $project['description'] = $description;
        $project['link'] = $link;
    } else {
        $message = "Failed to update project!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Project</title>
<link rel="stylesheet" href="admin-style.css">
</head>
<body>
<div class="form-container">
<h2>Edit Project</h2>

<form method="POST">
    <label>Project Name</label>
    <input type="text" name="name" value="<?= htmlspecialchars($project['name']) ?>" required>

    <label>Description</label>
    <textarea name="description" rows="5" required><?= htmlspecialchars($project['description']) ?></textarea>

    <label>Project Link</label>
    <input type="url" name="link" value="<?= htmlspecialchars($project['link']) ?>" required>

    <button type="submit">Update Project</button>
</form>

<?php if($message) echo "<p style='text-align:center; color:green;'>$message</p>"; ?>

<a href="dashboard.php" id="retdash">Back to Dashboard</a>
</div>
</body>
</html>
