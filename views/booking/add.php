<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: ../auth/login.php");
    exit();
}

if(!isset($_GET['doctor_id']) || !isset($_GET['date']) || !isset($_GET['time'])){
    echo "<h3 style='text-align:center;color:red;'>Invalid access!</h3>";
    exit();
}

$doctor_id = htmlspecialchars($_GET['doctor_id']);
$date      = htmlspecialchars($_GET['date']);
$time      = htmlspecialchars($_GET['time']);
?>

<!DOCTYPE html>
<html>
<head>
<title>Confirm Booking</title>

<style>
body{
margin:0;
font-family:'Segoe UI';
background: linear-gradient(120deg,#0f172a,#1e3a8a);
display:flex;
justify-content:center;
align-items:center;
height:100vh;
color:white;
}
.box{
background:white;
color:black;
padding:30px;
border-radius:15px;
width:360px;
}
.error{
background:#fee2e2;
color:#dc2626;
padding:10px;
border-radius:8px;
margin-bottom:10px;
text-align:center;
}
button{
width:100%;
padding:12px;
background:#3b82f6;
color:white;
border:none;
border-radius:8px;
margin-top:10px;
}
</style>

</head>
<body>

<div class="box">

<h2>Confirm Booking</h2>

<?php if(isset($_GET['error'])){ ?>
<div class="error">
❌ Slot already booked! Try another time.
</div>
<?php } ?>

<p><b>Doctor ID:</b> <?= $doctor_id ?></p>
<p><b>Date:</b> <?= $date ?></p>
<p><b>Time:</b> <?= $time ?></p>

<form method="POST" action="../../controllers/BookingController.php">
<input type="hidden" name="doctor_id" value="<?= $doctor_id ?>">
<input type="hidden" name="appointment_date" value="<?= $date ?>">
<input type="hidden" name="appointment_time" value="<?= $time ?>">

<button type="submit">Confirm Booking</button>
</form>

</div>

</body>
</html>