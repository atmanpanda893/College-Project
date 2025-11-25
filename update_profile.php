
<?php
include 'db_connect.php';
session_start();
if (!isset($_SESSION['user_id'])) { echo "<script>alert('Login required');location.href='../login.html';</script>"; exit; }
$user_id = intval($_SESSION['user_id']);
$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$skills = trim($_POST['skills'] ?? '');
$resume_path = '';
if (!empty($_FILES['resume']['name'])) {
    $upload_dir = __DIR__ . '/../uploads/resumes/';
    if (!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);
    $filename = time() . '_' . basename($_FILES['resume']['name']);
    $target = $upload_dir . $filename;
    if (move_uploaded_file($_FILES['resume']['tmp_name'], $target)) {
        $resume_path = 'uploads/resumes/' . $filename;
    }
}
$stmt = $conn->prepare("UPDATE users SET name=?, email=?, phone=?, skills=?, resume=? WHERE id=?");
$stmt->bind_param("sssssi", $name, $email, $phone, $skills, $resume_path, $user_id);
if ($stmt->execute()) { echo "<script>alert('Profile updated'); window.location.href='../profile_user.html';</script>"; }
else { echo "<script>alert('Error'); window.location.href='../profile_user.html';</script>"; }
?>