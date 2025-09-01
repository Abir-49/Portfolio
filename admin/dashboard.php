<?php
session_start();
include "../db.php";

if(!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}


$projects = $conn->query("SELECT * FROM projects ORDER BY created_at DESC");

$contacts = $conn->query("SELECT * FROM contact ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Dashboard</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="admin-style.css">
</head>
<body>
<nav class="admin-nav">
    <h1>Portfolio Admin</h1>
    <ul>
        <li><a href="add_project.php">Add Project</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</nav>

<main class="dashboard-container">
<h2>Projects</h2>
<div class="dashboard-table">
<table>
<thead>
<tr>
<th>ID</th>
<th>Name</th>
<th>Description</th>
<th>Link</th>
<th>Actions</th>
</tr>
</thead>
<tbody>
<?php while($row = $projects->fetch_assoc()): ?>
<tr>
<td><?= $row['id'] ?></td>
<td><?= $row['name'] ?></td>
<td><?= $row['description'] ?></td>
<td><a href="<?= $row['link'] ?>" id="link" target="_blank"><i class="fas fa-link"></i></a></td>
<td>
<a class="edit-btn" href="edit_project.php?id=<?= $row['id'] ?>">Edit</a>
<a class="delete-btn" href="delete_project.php?id=<?= $row['id'] ?>">Delete</a>
</td>
</tr>
<?php endwhile; ?>
</tbody>
</table>
</div>

<h2>Contact Messages</h2>
<div class="dashboard-table">
<table>
<thead>
<tr>
<th>ID</th>
<th>Name</th>
<th>Email</th>
<th>Message</th>
<th>Actions</th>
</tr>
</thead>
<tbody>
<?php while($row = $contacts->fetch_assoc()): ?>
<tr>
<td><?= $row['id'] ?></td>
<td><?= $row['name'] ?></td>
<td><?= $row['email'] ?></td>
<td><?= $row['message'] ?></td>
<td>
<a class="delete-btn" href="delete_contact.php?id=<?= $row['id'] ?>">Delete</a>
</td>
</tr>
<?php endwhile; ?>
</tbody>
</table>
</div>
</main>
</body>
</html>
