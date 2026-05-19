<?php
session_start();
include("../config/db.php");

if($_SESSION['role'] != 'admin'){
    header("Location: auth/login.php");
}

$result = $conn->query("
SELECT 
    du.name AS doctor_name,
    a.appointment_date,
    a.appointment_time,
    a.status
FROM appointments a
JOIN doctors d ON a.doctor_id = d.id
JOIN users du ON d.user_id = du.id
ORDER BY a.appointment_date DESC
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Doctor Schedule</title>
<link rel="stylesheet" href="../public/style.css">
</head>
<body>

<div class="container">
<h2>Doctor Schedule (Booked Slots)</h2>

<table>
<tr>
<th>Doctor</th>
<th>Date</th>
<th>Time</th>
<th>Status</th>
</tr>

<?php while($row = $result->fetch_assoc()){ ?>
<tr>
<td><?php echo $row['doctor_name']; ?></td>
<td><?php echo $row['appointment_date']; ?></td>
<td><?php echo $row['appointment_time']; ?></td>
<td>
<?php 
if($row['status'] == 'Approved'){
    echo "<span style='color:green;'>Booked</span>";
}else if($row['status'] == 'Pending'){
    echo "<span style='color:orange;'>Pending</span>";
}else{
    echo "<span style='color:red;'>Cancelled</span>";
}
?>
</td>
</tr>
<?php } ?>

</table>

<br>
<a href="admin_dashboard.php">Back</a>
</div>

</body>
</html>