<?php
session_start();
include("../../config/db.php");

$doctors = $conn->query("SELECT * FROM doctors");
?>

<h2>Book Appointment</h2>

<form method="POST" action="../../controllers/BookingController.php">

<select name="doctor_id">
<?php while($d=$doctors->fetch_assoc()){ ?>
<option value="<?php echo $d['id']; ?>">
<?php echo $d['name']; ?>
</option>
<?php } ?>
</select>

<input type="date" name="date">

<button name="book">Book</button>

</form>