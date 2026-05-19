<?php
session_start();
if(!isset($_SESSION['user']) || $_SESSION['role'] != 'patient'){
    header("Location: auth/login.php");
}
?>

<h2>User Dashboard</h2>

<a href="booking/doctors.php">Book Appointment</a><br><br>
<a href="booking/my_appointments.php">My Appointments</a>