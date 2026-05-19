<?php
session_start();
include("../config/db.php");

$res = $conn->query("
SELECT a.*, u.name as user_name, d.name as doctor_name 
FROM appointments a
JOIN users u ON a.user_id=u.id
JOIN doctors d ON a.doctor_id=d.id
");
?>

<h2>Appointments</h2>

<table border="1">
<tr>
<th>ID</th>
<th>User</th>
<th>Doctor</th>
<th>Date</th>
<th>Status</th>
<th>Action</th>
</tr>

<?php while($row=$res->fetch_assoc()){ ?>
<tr>
<td><?php echo $row['id']; ?></td>
<td><?php echo $row['user_name']; ?></td>
<td><?php echo $row['doctor_name']; ?></td>
<td><?php echo $row['appointment_date']; ?></td>
<td><?php echo $row['status']; ?></td>
<td>
<a href="approve.php?id=<?php echo $row['id']; ?>">Approve</a>
<a href="cancel.php?id=<?php echo $row['id']; ?>">Cancel</a>
</td>
</tr>
<?php } ?>
</table>