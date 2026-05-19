<?php
session_start();
if($_SESSION['role']!='user'){
    header("Location: admin_dashboard.php");
}
?>

<h2>User Dashboard</h2>

<a href="booking/add.php">Book Appointment</a>
<br><br>
<a href="booking/list.php">My Appointments</a>
<br><br>
<a href="../controllers/logout.php">Logout</a>