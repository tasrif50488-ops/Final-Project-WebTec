<?php
session_start();

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'user'){
    header("Location: auth/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>User Dashboard</title>
<link rel="stylesheet" href="../public/style.css">
<style>
body{background:linear-gradient(135deg,#4facfe,#00f2fe);font-family:Arial}
.box{width:350px;margin:100px auto;background:#fff;padding:30px;border-radius:10px;text-align:center}
a{display:block;margin:10px;padding:10px;background:#3498db;color:white;text-decoration:none}
</style>
</head>
<body>

<div class="box">
<h2>User Dashboard</h2>

<a href="booking/doctors.php">Book Appointment</a>
<a href="booking/list.php">My Appointments</a>
<a href="../controllers/logout.php">Logout</a>

</div>

</body>
</html>