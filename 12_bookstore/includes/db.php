<?php
$host = 'localhost';
$db = 'bookstore2';
$user = 'root';
$pass = 'root'; // Use your MySQL password

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
