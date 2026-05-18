<?php
session_start();

$conn = new mysqli("localhost","root","","hospital_system");

if(!isset($_SESSION['user_id'])){
    header("Location: ../views/auth/login.php");
    exit();
}

$patient_id = $_SESSION['user_id'];

$doctor_id = $_POST['doctor_id'];
$date      = $_POST['appointment_date'];
$time      = $_POST['appointment_time'];

// 🔥 CHECK duplicate
$check = $conn->query("
SELECT id FROM appointments
WHERE doctor_id='$doctor_id'
AND appointment_date='$date'
AND appointment_time='$time'
");

if($check->num_rows > 0){
    header("Location: ../views/booking/add.php?doctor_id=$doctor_id&date=$date&time=$time&error=1");
    exit();
}

// INSERT
$conn->query("
INSERT INTO appointments (patient_id, doctor_id, appointment_date, appointment_time, status)
VALUES ('$patient_id','$doctor_id','$date','$time','Pending')
");

// SUCCESS redirect
header("Location: ../views/dashboard.php?success=1");
exit();