<?php
require_once __DIR__ . '/controllers/AppointmentController.php';

$controller = new AppointmentController();
$controller->adminAppointments();