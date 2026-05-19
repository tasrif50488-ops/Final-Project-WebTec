<?php
session_start();
if($_SESSION['role']!='admin'){
    header("Location: dashboard.php");
}
?>

<h2>Admin Dashboard</h2>

<a href="admin_appointments.php">Manage Appointments</a>
<br><br>
<a href="../controllers/logout.php">Logout</a>