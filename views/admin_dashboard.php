<?php
session_start();
if($_SESSION['role'] != 'admin'){
    header("Location: auth/login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Dashboard</title>
<link rel="stylesheet" href="../public/style.css">
</head>
<body>

<div class="card">
<h2>Admin Dashboard</h2>

<a class="btn" href="admin_appointments.php">Manage Appointments</a>
<a class="btn" href="list_doctor.php">Manage Doctors</a>
<a class="btn" href="list_specialization.php">Manage Specialization</a>
<a class="btn" href="admin_doctor_schedule.php">Doctor Schedule</a>
<a class="btn logout" href="../controllers/logout.php">Logout</a>

</div>

</body>
</html>