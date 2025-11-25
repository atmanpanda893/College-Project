
<?php
include 'db_connect.php';
session_start();
if (!isset($_SESSION['user_id'])) { echo "<script>alert('Login required');location.href='../login.html';</script>"; exit; }
$user_id = intval($_SESSION['user_id']);
$current = $_POST['current_password'] ?? '';
$new = $_POST['new_password'] ?? '';
$confirm = $_POST['confirm_password'] ?? '';
if ($new !== $confirm) { echo "<script>alert('New passwords do not match!'); window.history.back();</script>"; exit; }
$result = $conn->query("SELECT password FROM users WHERE id=$user_id");
$user = $result->fetch_assoc();
if (!password_verify($current, $user['password'])) { echo "<script>alert('Current password is incorrect!'); window.history.back();</script>"; exit; }
$new_hashed = password_hash($new, PASSWORD_DEFAULT);
$conn->query("UPDATE users SET password='$new_hashed' WHERE id=$user_id");
echo "<script>alert('Password updated successfully!'); window.location.href='../settings_user.html';</script>";
?>