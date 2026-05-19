<?php
session_start();
if(!isset($_SESSION['user']) || $_SESSION['user']['role']!='user'){
header("Location: auth/login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="../public/style.css">
</head>
<body>

<div class="container">
<h2>User Dashboard</h2>

<a href="booking/add.php">Book Appointment</a>
<a href="booking/list.php">My Appointments</a>

</div>

</body>
</html>