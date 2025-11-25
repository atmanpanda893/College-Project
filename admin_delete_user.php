
<?php
include 'db_connect.php';
session_start();
if (!isset($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'admin') { echo "Denied"; exit; }
$id = intval($_POST['id'] ?? 0);
if ($id <= 0) { header('Location: ../admin_panel.php'); exit; }
$stmt = $conn->prepare("DELETE FROM users WHERE id=?"); $stmt->bind_param("i",$id); $stmt->execute();
header("Location: ../admin_panel.php");
?>