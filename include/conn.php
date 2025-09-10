<?php
$conn = new mysqli('localhost', 'root', '', 'mostra2025');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>