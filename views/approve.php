<?php
include("../config/db.php");
$id=$_GET['id'];

$conn->query("UPDATE appointments SET status='Approved' WHERE id='$id'");
header("Location: admin_appointments.php");