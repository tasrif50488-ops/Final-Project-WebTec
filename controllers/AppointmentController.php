<?php
include("../config/db.php");

if(isset($_GET['approve'])){
    $id = $_GET['approve'];
    $conn->query("UPDATE appointments SET status='Approved' WHERE id=$id");
    header("Location: ../views/admin_appointments.php");
}

if(isset($_GET['cancel'])){
    $id = $_GET['cancel'];
    $conn->query("UPDATE appointments SET status='Cancelled' WHERE id=$id");
    header("Location: ../views/admin_appointments.php");
}