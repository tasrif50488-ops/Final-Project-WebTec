<?php
include("../config/db.php");

$sql="SELECT doctors.id,users.name,
specializations.name AS specialization,
COUNT(appointments.id) AS total
FROM doctors
JOIN users ON doctors.user_id=users.id
JOIN specializations ON doctors.specialization_id=specializations.id
LEFT JOIN appointments ON doctors.id=appointments.doctor_id
WHERE users.is_active=1
GROUP BY doctors.id";

$res=$conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>
<link rel="stylesheet" href="../public/style.css">
</head>
<body>

<div class="container">

<h2>Doctor Dashboard</h2>

<a href="../index.php" class="btn btn-back">← Home</a>

<table>

<tr>
<th>ID</th>
<th>Name</th>
<th>Specialization</th>
<th>Total Appointments</th>
</tr>

<?php while($r=$res->fetch_assoc()){ ?>

<tr>
<td><?php echo $r['id']?></td>
<td><?php echo $r['name']?></td>
<td><?php echo $r['specialization']?></td>
<td><?php echo $r['total']?></td>
</tr>

<?php } ?>

</table>

</div>

</body>
</html>