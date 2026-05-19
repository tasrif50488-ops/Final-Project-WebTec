<?php
require_once '../config/db.php';
require_once '../models/AppointmentModel.php';

$model = new AppointmentModel($pdo);

$data = json_decode(file_get_contents("php://input"), true);

$id = $_GET['id'];
$status = $data['status'];

$model->updateStatus($id, $status);

echo json_encode([
    "ok"=>true,
    "new_status"=>$status
]);