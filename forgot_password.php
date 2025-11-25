
<?php
include 'db_connect.php';
$identifier = trim($_POST['identifier'] ?? '');
if (!$identifier) { echo "Provide email or phone"; exit; }
$stmt = $conn->prepare("SELECT id,email,phone FROM users WHERE email=? OR phone=?");
$stmt->bind_param("ss", $identifier, $identifier);
$stmt->execute();
$res = $stmt->get_result();
if ($res->num_rows === 0) { echo "No user found"; exit; }
$user = $res->fetch_assoc();
// For simplicity, we'll not send real email. Return a simulated reset link with identifier.
// In production, generate a token and email it.
echo "If this account exists, a reset link was (pretend) sent. Use reset_password.html to reset.";
?>