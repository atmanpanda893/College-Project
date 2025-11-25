
<?php
include 'db_connect.php';
$name = 'Admin';
$email = 'admin@example.com';
$phone = '+911234567890';
$password = password_hash('admin123', PASSWORD_DEFAULT);
$role = 'admin';
$stmt = $conn->prepare("INSERT INTO users (name,email,phone,password,role) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $name, $email, $phone, $password, $role);
if ($stmt->execute()) { echo "Admin user created. Email: admin@example.com Password: admin123"; } else { echo "Error creating admin: " . $conn->error; }
?>