<?php
include("../../config/db.php");

$id = $_GET['doctor_id'];

$d = $conn->query("SELECT * FROM doctors WHERE id=$id")->fetch_assoc();

$days = explode(",", $d['available_days']);
?>

<!DOCTYPE html>
<html>
<head>
<title>Slots</title>
<link rel="stylesheet" href="../../public/style.css">
</head>
<body>

<div class="container">
<h2>Available Days</h2>

<?php foreach($days as $day){ ?>
<a class="btn" href="add.php?doctor_id=<?php echo $id; ?>&day=<?php echo $day; ?>">
<?php echo $day; ?>
</a>
<?php } ?>

</div>

</body>
</html>