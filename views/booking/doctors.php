<?php
include("../../config/db.php");

$result = $conn->query("
SELECT d.id, u.name 
FROM doctors d
JOIN users u ON d.user_id = u.id
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Doctors</title>
<link rel="stylesheet" href="../../public/style.css">
</head>
<body>

<div class="container">
<h2>Select Doctor</h2>

<?php while($row=$result->fetch_assoc()){ ?>
<div class="card2">
<h3><?php echo $row['name']; ?></h3>
<a class="btn" href="slots.php?doctor_id=<?php echo $row['id']; ?>">Select</a>
</div>
<?php } ?>

</div>

</body>
</html>