<?php
include("../config/db.php");
$id=$_GET['id'];

$conn->query("UPDATE appointments SET status='Cancelled' WHERE id='$id'");
header("Location: admin_appointments.php");