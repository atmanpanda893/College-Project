
<?php
include 'db_connect.php';
session_start();
$identifier = trim($_POST['identifier'] ?? '');
$password = $_POST['password'] ?? '';
if (empty($identifier) || empty($password)) { echo "missing_fields"; exit; }
$stmt = $conn->prepare("SELECT * FROM users WHERE email = ? OR phone = ?");
$stmt->bind_param("ss", $identifier, $identifier);
$stmt->execute();
$res = $stmt->get_result();
if ($res->num_rows === 0) { echo "no_user"; exit; }
$user = $res->fetch_assoc();
if (password_verify($password, $user['password'])) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['role'] = $user['role'];
    echo $user['role'];
} else { echo "wrong_password"; }
?>