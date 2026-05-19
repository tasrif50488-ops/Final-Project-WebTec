<?php
include("../config/db.php");

$id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM doctors WHERE specialization_id=?");
$stmt->bind_param("i",$id);
$stmt->execute();
$res = $stmt->get_result();

if($res->num_rows > 0){
header("Location: list_specialization.php?msg=blocked");
exit();
}

$stmt2 = $conn->prepare("DELETE FROM specializations WHERE id=?");
$stmt2->bind_param("i",$id);
$stmt2->execute();

header("Location: list_specialization.php?msg=deleted");
exit();
?>