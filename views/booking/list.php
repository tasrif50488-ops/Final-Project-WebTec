<?php
session_start();
$conn = new mysqli("localhost","root","","hospital_system");

$user_id=$_SESSION['user']['id'];
$res=$conn->query("SELECT * FROM appointments WHERE user_id='$user_id'");
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="../../public/style.css">
</head>
<body>

<div class="container">
<h2>My Appointments</h2>

<table>
<tr>
<th>ID</th>
<th>Date</th>
<th>Status</th>
</tr>

<?php while($row=$res->fetch_assoc()){ ?>
<tr>
<td><?php echo $row['id']; ?></td>
<td><?php echo $row['date']; ?></td>
<td><?php echo $row['status']; ?></td>
</tr>
<?php } ?>

</table>

<a href="../dashboard.php">Back</a>

</div>

</body>
</html>