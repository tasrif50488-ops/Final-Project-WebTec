<?php
require_once __DIR__ . '/../models/AppointmentModel.php';
require_once __DIR__ . '/../config/db.php';

class AppointmentController {

    private $model;

    public function __construct(){
        global $pdo;
        $this->model = new AppointmentModel($pdo);
    }

    public function doctorDashboard(){
        $doctor_id = 2;

        $appointments = $this->model->getTodayAppointments($doctor_id);
        $weekly = $this->model->getWeeklyAppointments($doctor_id);

        require __DIR__ . '/../views/doctor_dashboard.php';
    }

    public function adminAppointments(){

        $date = $_GET['date'] ?? '';
        $status = $_GET['status'] ?? '';

        $appointments = $this->model->getFilteredAppointments($date, $status);

        require __DIR__ . '/../views/admin_appointments.php';
    }
}