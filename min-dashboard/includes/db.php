<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$conn = new mysqli("localhost", "root", "", "techhome_by_v0");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
