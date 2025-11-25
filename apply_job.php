
<?php
include 'db_connect.php';
session_start();
if (!isset($_SESSION['user_id'])) { echo "Please login to apply."; exit; }
$user_id = intval($_SESSION['user_id']);
$job_id = intval($_POST['job_id'] ?? 0);
if ($job_id <= 0) { echo "Invalid job."; exit; }
$check = $conn->prepare("SELECT id FROM applications WHERE user_id=? AND job_id=?");
$check->bind_param("ii",$user_id,$job_id); $check->execute(); $r = $check->get_result();
if ($r->num_rows > 0) { echo "You have already applied for this job."; exit; }
$stmt = $conn->prepare("INSERT INTO applications (user_id, job_id, status, applied_date) VALUES (?, ?, 'Under Review', NOW())");
$stmt->bind_param("ii", $user_id, $job_id);
if ($stmt->execute()) echo "Application submitted successfully."; else echo "Failed to submit application.";
?>