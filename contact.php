<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $message = $conn->real_escape_string($_POST['message']);

    $conn->query("INSERT INTO contact (name, email, message) 
                  VALUES ('$name', '$email', '$message')");
    
    echo "Message Sent Successfully!";
}
?>
