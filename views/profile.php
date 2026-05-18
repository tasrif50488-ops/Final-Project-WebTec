<?php
session_start();
$conn = new mysqli("localhost","root","","hospital_system");

if(!isset($_SESSION['user_id'])){
    header("Location: auth/login.php");
    exit();
}

$id = $_SESSION['user_id'];

$res = $conn->query("SELECT * FROM users WHERE id='$id'");
$user = $res->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
<title>Profile</title>

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

.card{
background:white;
color:black;
padding:25px;
border-radius:12px;
width:400px;
margin:auto;
box-shadow:0 10px 25px rgba(0,0,0,0.3);
}

h2{
text-align:center;
margin-bottom:20px;
color:#1e3a8a;
}

.info{
margin:10px 0;
font-size:15px;
}

.label{
font-weight:bold;
color:#1e40af;
}

.btn{
display:block;
text-align:center;
margin-top:15px;
padding:10px;
background:#3b82f6;
color:white;
text-decoration:none;
border-radius:8px;
}
</style>

</head>

<body>

<div class="container">

<div class="card">

<h2>My Profile</h2>

<div class="info">
<span class="label">Name:</span> <?= $user['name'] ?>
</div>

<div class="info">
<span class="label">Email:</span> <?= $user['email'] ?>
</div>

<div class="info">
<span class="label">Phone:</span> <?= $user['phone'] ?>
</div>

<div class="info">
<span class="label">Blood Group:</span> <?= $user['blood_group'] ?>
</div>

<div class="info">
<span class="label">DOB:</span> <?= $user['dob'] ?>
</div>

<div class="info">
<span class="label">Role:</span> <?= $user['role'] ?>
</div>

<a href="dashboard.php" class="btn">← Back to Dashboard</a>

</div>

</div>

</body>
</html>