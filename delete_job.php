
<?php
include 'db_connect.php';
session_start();
if (!isset($_SESSION['user_id'])) { echo "Unauthorized"; exit; }
$emp = intval($_SESSION['user_id']);
$job_id = intval($_POST['job_id'] ?? 0);
if ($job_id <= 0) { echo "Invalid"; exit; }
$check = $conn->prepare("SELECT employer_id FROM jobs WHERE id=?");
$check->bind_param("i",$job_id); $check->execute();
$r = $check->get_result()->fetch_assoc();
if (!$r || intval($r['employer_id']) !== $emp) { echo "Not allowed"; exit; }
$del = $conn->prepare("DELETE FROM jobs WHERE id=?"); $del->bind_param("i",$job_id);
echo $del->execute() ? "deleted" : "error";
?>