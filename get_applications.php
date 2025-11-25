
<?php
include 'db_connect.php';
session_start();
if (!isset($_SESSION['user_id'])) { echo json_encode([]); exit; }
$uid = intval($_SESSION['user_id']);
$sql = "SELECT a.*, j.title, u.name as employer FROM applications a LEFT JOIN jobs j ON a.job_id = j.id LEFT JOIN users u ON j.employer_id=u.id WHERE a.user_id=? ORDER BY a.applied_date DESC";
$stmt = $conn->prepare($sql); $stmt->bind_param("i",$uid); $stmt->execute(); $res = $stmt->get_result();
$out = []; while($r = $res->fetch_assoc()) $out[] = $r;
header('Content-Type: application/json'); echo json_encode($out);
?>