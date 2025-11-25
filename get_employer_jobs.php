
<?php
include 'db_connect.php';
session_start();
if (!isset($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'employer') { http_response_code(403); echo json_encode([]); exit; }
$emp = intval($_SESSION['user_id']);
$stmt = $conn->prepare("SELECT * FROM jobs WHERE employer_id=? ORDER BY id DESC");
$stmt->bind_param("i",$emp);
$stmt->execute();
$res = $stmt->get_result();
$rows = [];
while($r = $res->fetch_assoc()) $rows[] = $r;
header('Content-Type: application/json');
echo json_encode($rows);
?>