
<?php
include 'db_connect.php';
$sql = "SELECT j.*, u.name AS company_name FROM jobs j LEFT JOIN users u ON j.employer_id = u.id ORDER BY j.id DESC";
$res = $conn->query($sql);
$jobs = [];
while($row = $res->fetch_assoc()) $jobs[] = $row;
header('Content-Type: application/json');
echo json_encode($jobs);
?>