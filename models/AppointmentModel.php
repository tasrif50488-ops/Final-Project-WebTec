<?php
require_once __DIR__ . '/../config/db.php';

class AppointmentModel {

    private $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }

    public function getTodayAppointments($doctor_id){
        $today = date('Y-m-d');
        $stmt = $this->pdo->prepare("
            SELECT a.*, u.name as patient_name
            FROM appointments a
            JOIN users u ON a.patient_id = u.id
            WHERE a.doctor_id=? AND a.appointment_date=?
            ORDER BY a.appointment_time
        ");
        $stmt->execute([$doctor_id, $today]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getWeeklyAppointments($doctor_id){
        $stmt = $this->pdo->prepare("
            SELECT a.*, u.name as patient_name
            FROM appointments a
            JOIN users u ON a.patient_id = u.id
            WHERE a.doctor_id=?
            ORDER BY a.appointment_date, a.appointment_time
        ");
        $stmt->execute([$doctor_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getFilteredAppointments($date, $status){

        $query = "SELECT a.*, u.name as patient_name
                  FROM appointments a
                  JOIN users u ON a.patient_id = u.id
                  WHERE 1";

        $params = [];

        if($date){
            $query .= " AND a.appointment_date = ?";
            $params[] = $date;
        }

        if($status){
            $query .= " AND a.status = ?";
            $params[] = $status;
        }

        $query .= " ORDER BY a.appointment_date DESC";

        $stmt = $this->pdo->prepare($query);
        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllAppointments(){
        $stmt = $this->pdo->query("
            SELECT a.*, u.name as patient_name
            FROM appointments a
            JOIN users u ON a.patient_id = u.id
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateStatus($id, $status){
        $stmt = $this->pdo->prepare("
            UPDATE appointments SET status=? WHERE id=?
        ");
        return $stmt->execute([$status, $id]);
    }
}