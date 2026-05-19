<?php
header("Content-Type: application/json");

$conn = new mysqli("localhost","root","","hospital_system");

$filter = "";

if(isset($_GET['specialization_id']) && $_GET['specialization_id'] != ""){
$id = $_GET['specialization_id'];
$filter = "WHERE d.specialization_id = '$id'";
}

$data = [];

$res = $conn->query("
SELECT d.id, u.name, s.name AS specialization, d.consultation_fee, d.photo_path
FROM doctors d
JOIN users u ON d.user_id = u.id
JOIN specializations s ON d.specialization_id = s.id
$filter
");

while($row = $res->fetch_assoc()){
$data[] = [
"id"=>$row['id'],
"name"=>$row['name'],
"specialization"=>$row['specialization'],
"fee"=>$row['consultation_fee'],
"photo_path"=>$row['photo_path']
];
}

echo json_encode($data);