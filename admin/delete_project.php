<?php
session_start();
include "../db.php";
if(!isset($_SESSION['admin'])) { header("Location: login.php"); exit; }

if(isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $conn->query("DELETE FROM projects WHERE id=$id");
}
header("Location: dashboard.php");
exit;
