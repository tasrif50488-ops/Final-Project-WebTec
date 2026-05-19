<?php
session_start();
include("../config/db.php");

if(isset($_POST['book'])){

    $user_id = $_SESSION['user_id'];
    $doctor_id = $_POST['doctor_id'];
    $date = $_POST['date'];

    $conn->query("INSERT INTO appointments(user_id,doctor_id,appointment_date,status)
    VALUES('$user_id','$doctor_id','$date','Pending')");

    header("Location: ../views/booking/list.php");
}