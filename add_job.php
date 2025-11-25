
<?php
include 'db_connect.php';
session_start();
if (!isset($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'employer') {
    echo "<script>alert('Unauthorized'); window.location.href='../login.html';</script>"; exit;
}
$employer_id = intval($_SESSION['user_id']);
$title = trim($_POST['title'] ?? '');
$description = trim($_POST['description'] ?? '');
$skills = trim($_POST['skills'] ?? '');
$location = trim($_POST['location'] ?? '');
$salary = trim($_POST['salary'] ?? '');
$type = trim($_POST['type'] ?? '');
$stmt = $conn->prepare("INSERT INTO jobs (title, description, required_skills, location, salary, type, employer_id, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())");
$stmt->bind_param("ssssssi", $title, $description, $skills, $location, $salary, $type, $employer_id);
if ($stmt->execute()) echo "<script>alert('Job posted'); window.location.href='../dashboard_employer.html';</script>"; else echo "<script>alert('Error'); window.location.href='../dashboard_employer.html';</script>";
?>