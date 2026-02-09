<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "techhome_by_v0";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>