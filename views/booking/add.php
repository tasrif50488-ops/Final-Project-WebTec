<?php
session_start();
include("../../config/db.php");

if(isset($_POST['book'])){
    $pid = $_SESSION['user_id'];
    $did = $_POST['doctor_id'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $reason = $_POST['reason'];

    $conn->query("
    INSERT INTO appointments 
    (patient_id, doctor_id, appointment_date, appointment_time, reason, status)
    VALUES ('$pid','$did','$date','$time','$reason','Pending')
    ");

    header("Location: list.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Book</title>
<link rel="stylesheet" href="../../public/style.css">
</head>
<body>

<div class="card">
<h2>Book Appointment</h2>

<form method="POST">
<input type="hidden" name="doctor_id" value="<?php echo $_GET['doctor_id']; ?>">

<input type="date" name="date" required>
<input type="time" name="time" required>
<input type="text" name="reason" placeholder="Reason">

<button class="btn" name="book">Book</button>
</form>

</div>

</body>
</html>