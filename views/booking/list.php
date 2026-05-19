<?php
session_start();
include("../../config/db.php");

$user_id=$_SESSION['user_id'];

$res=$conn->query("
SELECT a.*, d.name as doctor_name
FROM appointments a
JOIN doctors d ON a.doctor_id=d.id
WHERE a.user_id='$user_id'
");
?>

<h2>My Appointments</h2>

<table border="1">
<tr>
<th>ID</th>
<th>Doctor</th>
<th>Date</th>
<th>Status</th>
</tr>

<?php while($row=$res->fetch_assoc()){ ?>
<tr>
<td><?php echo $row['id']; ?></td>
<td><?php echo $row['doctor_name']; ?></td>
<td><?php echo $row['appointment_date']; ?></td>
<td><?php echo $row['status']; ?></td>
</tr>
<?php } ?>
</table>