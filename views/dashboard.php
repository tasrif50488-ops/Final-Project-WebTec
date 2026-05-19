<?php
session_start();
$conn = new mysqli("localhost", "root", "", "hospital_system");

if(!isset($_SESSION['user_id'])){
    header("Location: auth/login.php");
    exit();
}

$patient_id = $_SESSION['user_id'];

$data = $conn->query("
SELECT 
a.id,
u.name as doctor_name,
s.name as specialization,
a.appointment_date,
a.appointment_time,
a.status
FROM appointments a
JOIN doctors d ON a.doctor_id = d.id
JOIN users u ON d.user_id = u.id
JOIN specializations s ON d.specialization_id = s.id
WHERE a.patient_id = '$patient_id'
ORDER BY a.id DESC
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>

<style>
body{
margin:0;
font-family:'Segoe UI';
background: linear-gradient(120deg,#0f172a,#1e3a8a);
color:white;
}

.container{
width:90%;
margin:auto;
padding-top:30px;
}

.topbar{
display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:20px;
}

.btn{
padding:10px 18px;
border-radius:8px;
text-decoration:none;
color:white;
}

.book{ background:#3b82f6; }
.logout{ background:#ef4444; }

.card{
background:white;
color:black;
padding:20px;
border-radius:12px;
width:250px;
margin-bottom:20px;
box-shadow:0 10px 25px rgba(0,0,0,0.2);
}

.table{
width:100%;
background:white;
color:black;
border-collapse:collapse;
border-radius:12px;
overflow:hidden;
}

.table th{
background:#1e40af;
color:white;
padding:12px;
}

.table td{
padding:12px;
text-align:center;
}

.table tr:nth-child(even){
background:#f1f5f9;
}

/* status color */
.status{
padding:5px 10px;
border-radius:6px;
color:white;
}

.pending{ background:#f59e0b; }
.cancelled{ background:#ef4444; }

/* success box */
.success{
background:#dcfce7;
color:#16a34a;
padding:10px;
border-radius:8px;
margin-bottom:15px;
}
</style>

</head>

<body>

<div class="container">

<!-- ✅ SUCCESS MESSAGE -->
<?php if(isset($_GET['success'])){ ?>
<div class="success">
✅ Booking successful!
</div>
<?php } ?>

<div class="topbar">
<h2>Dashboard</h2>

<div>
<a href="booking/doctors.php" class="btn book">+ Book</a>
<a href="profile.php" class="btn" style="background:#22c55e;">Profile</a>
<a href="../controllers/logout.php" class="btn logout">Logout</a>
</div>
</div>

<div class="card">
<h3>Welcome 👋</h3>
<p>User ID: <?= $patient_id ?></p>
</div>

<table class="table">

<tr>
<th>ID</th>
<th>Doctor</th>
<th>Specialization</th>
<th>Date</th>
<th>Time</th>
<th>Status</th>
<th>Action</th>
</tr>

<?php while($row = $data->fetch_assoc()){ ?>

<tr>
<td><?= $row['id'] ?></td>
<td><?= $row['doctor_name'] ?></td>
<td><?= $row['specialization'] ?></td>
<td><?= $row['appointment_date'] ?></td>
<td><?= $row['appointment_time'] ?></td>

<td>
<span class="status <?= strtolower($row['status']) ?>">
<?= $row['status'] ?>
</span>
</td>

<td>
<?php if($row['status'] != 'Cancelled'){ ?>
<a style="background:#ef4444;color:white;padding:6px 10px;border-radius:6px;text-decoration:none;"
href="../controllers/cancel.php?id=<?= $row['id'] ?>">
Cancel
</a>
<?php } ?>
</td>

</tr>

<?php } ?>

</table>

</div>

</body>
</html>