<?php
include("../config/db.php");

$id=$_GET['id'];

$res=$conn->query("SELECT user_id FROM doctors WHERE id=$id");
$row=$res->fetch_assoc();
$uid=$row['user_id'];

$conn->query("UPDATE users SET is_active=0 WHERE id=$uid");

header("Location:list_doctor.php");