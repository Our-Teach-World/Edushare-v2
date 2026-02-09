<?php
//include('includes/auth.php');
include('includes/db.php');

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $conn->query("DELETE FROM auth WHERE id = $id");
}

header("Location: dashboard.php");
exit();
?>
