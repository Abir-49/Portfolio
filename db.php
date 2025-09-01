<?php
$host="localhost";
$user="root";
$password="";
$db="Portfolio";
$conn=new mysqli($host,$user,$password);
$conn->query("CREATE DATABASE IF NOT EXISTS $db");
$conn->select_db($db);
$conn->query("CREATE TABLE IF NOT EXISTS contact (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    message TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");
$conn->query("CREATE TABLE IF NOT EXISTS projects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    link VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");
$checkDummy = $conn->query("SHOW TABLES LIKE 'flag'");

if ($checkDummy->num_rows == 0){
 $conn->query("INSERT INTO projects (name, description, link) VALUES
    ('Portfolio Website', 'Personal portfolio showcasing projects', 'https://github.com/Abir-49/Portfolio.git'),
    ('Java Algorithms', 'Implementation of different algorithms in Java', 'https://github.com/Abir-49/Java.git'),
    ('Hello World', 'A simple Java hello world application using Maven', 'https://github.com/Abir-49/helloworld.git')");
    $conn->query("CREATE TABLE flag (id INT AUTO_INCREMENT PRIMARY KEY)");
}
?>