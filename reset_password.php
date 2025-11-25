
<?php
include 'db_connect.php';
$identifier = trim($_POST['identifier'] ?? '');
$new = $_POST['new_password'] ?? '';
if (!$identifier || !$new) { echo "Missing fields"; exit; }
$hash = password_hash($new, PASSWORD_DEFAULT);
$stmt = $conn->prepare("UPDATE users SET password=? WHERE email=? OR phone=?");
$stmt->bind_param("sss", $hash, $identifier, $identifier);
$stmt->execute();
echo "Password updated (if account existed).";
?>