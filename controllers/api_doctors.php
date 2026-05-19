<?php
include("../config/db.php");

header("Content-Type: application/json");

$sql = "SELECT doctors.id, users.name, 
specializations.name AS specialization,
COUNT(appointments.id) AS total_appointments
FROM doctors
JOIN users ON doctors.user_id = users.id
JOIN specializations ON doctors.specialization_id = specializations.id
LEFT JOIN appointments ON doctors.id = appointments.doctor_id
WHERE users.is_active = 1
GROUP BY doctors.id";

$result = $conn->query($sql);

$data = [];

while($row = $result->fetch_assoc()){
$data[] = $row;
}

echo json_encode($data);