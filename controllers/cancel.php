<?php
session_start();

$conn = new mysqli("localhost", "root", "", "hospital_system");

if(!isset($_SESSION['user_id'])){
    header("Location: ../views/auth/login.php");
    exit();
}

$id = $_GET['id'];

$conn->query("UPDATE appointments SET status='Cancelled' WHERE id='$id'");

header("Location: ../views/dashboard.php");
exit();