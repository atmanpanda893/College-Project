
<?php
include 'php/db_connect.php';
session_start();
if (!isset($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'admin') { echo "<h3>Access denied. Admins only.</h3>"; exit; }
?>
<!doctype html><html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Admin Panel</title></head><body style="font-family:Poppins, sans-serif"><h1>Admin Panel</h1><h2>Users</h2><?php $res=$conn->query("SELECT id,name,email,phone,role FROM users ORDER BY id DESC"); echo "<table border='1' cellpadding='6'><tr><th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Role</th><th>Action</th></tr>"; while($row=$res->fetch_assoc()){ echo "<tr><td>{$row['id']}</td><td>{$row['name']}</td><td>{$row['email']}</td><td>{$row['phone']}</td><td>{$row['role']}</td><td><form method='POST' action='php/admin_delete_user.php'><input type='hidden' name='id' value='{$row['id']}'><button type='submit'>Delete</button></form></td></tr>"; } echo "</table>"; ?></body></html>
