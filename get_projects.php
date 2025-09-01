<?php
include "db.php";

$sql = "SELECT * FROM projects ORDER BY created_at DESC";
$result = $conn->query($sql);

$projects = [];
while ($row = $result->fetch_assoc()) {
    $projects[] = $row;
}

header('Content-Type: application/json');
echo json_encode($projects);
?>
