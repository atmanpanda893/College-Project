
<?php
include 'db_connect.php';
$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$password = $_POST['password'] ?? '';
$role = trim($_POST['role'] ?? 'user');
if (!$name || !$email || !$phone || !$password) { echo "missing_fields"; exit; }
$check = $conn->prepare("SELECT id FROM users WHERE email = ? OR phone = ?");
$check->bind_param("ss", $email, $phone);
$check->execute();
if ($check->get_result()->num_rows > 0) { echo "already_exists"; exit; }
$hash = password_hash($password, PASSWORD_DEFAULT);
$stmt = $conn->prepare("INSERT INTO users (name,email,phone,password,role) VALUES (?,?,?,?,?)");
$stmt->bind_param("sssss", $name, $email, $phone, $hash, $role);
if ($stmt->execute()) echo "success"; else echo "error";
?>