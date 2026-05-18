<?php
header("Content-Type: application/json");

$conn = new mysqli("localhost","root","","hospital_system");

if ($conn->connect_error) {
    echo json_encode([]);
    exit();
}

// =======================
// GET DATA
// =======================
if(!isset($_GET['doctor_id']) || !isset($_GET['date'])){
    echo json_encode([]);
    exit();
}

$doctor_id = $_GET['doctor_id'];
$date      = $_GET['date'];

// =======================
// STEP 1: DOCTOR AVAILABLE DAYS
// =======================
$res2 = $conn->query("SELECT available_days FROM doctors WHERE id='$doctor_id'");

if($res2->num_rows == 0){
    echo json_encode([]);
    exit();
}

$doc = $res2->fetch_assoc();

// convert string → array
$available_days = explode(",", $doc['available_days']);

// 🔥 IMPORTANT FIX
$available_days = array_map('trim', $available_days);

// get selected day name (Monday, Tuesday...)
$day = date('l', strtotime($date));

// ❌ If doctor not available that day
if(!in_array($day, $available_days)){
    echo json_encode([]);
    exit();
}

// =======================
// STEP 2: ALL POSSIBLE SLOTS
// =======================
$all_slots = [
    "09:00","10:00","11:00","12:00",
    "02:00","03:00","04:00"
];

// =======================
// STEP 3: GET BOOKED SLOTS
// =======================
$booked = [];

$res = $conn->query("
SELECT appointment_time 
FROM appointments 
WHERE doctor_id='$doctor_id' 
AND appointment_date='$date'
");

while($r = $res->fetch_assoc()){
    $booked[] = $r['appointment_time'];
}

// =======================
// STEP 4: REMOVE BOOKED
// =======================
$available = array_diff($all_slots, $booked);

// re-index array
$available = array_values($available);

// =======================
// FINAL OUTPUT
// =======================
echo json_encode($available);