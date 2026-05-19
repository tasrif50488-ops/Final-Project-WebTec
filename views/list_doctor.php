<?php
include("../config/db.php");

$sql="SELECT doctors.id,users.name,users.email,
specializations.name AS specialization,
doctors.consultation_fee,doctors.available_days,doctors.photo_path
FROM doctors
JOIN users ON doctors.user_id=users.id
JOIN specializations ON doctors.specialization_id=specializations.id
WHERE users.is_active=1";

$res=$conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
<title>Doctor List</title>
<link rel="stylesheet" href="../public/style.css">
</head>
<body>

<div class="container">

<div class="top-bar">
<h2>Doctor List</h2>
<a href="add_doctor.php" class="btn btn-add">Add</a>
</div>

<a href="../index.php" class="btn btn-back">← Home</a>

<table>

<tr>
<th>ID</th>
<th>Name</th>
<th>Photo</th>
<th>Email</th>
<th>Specialization</th>
<th>Fee</th>
<th>Days</th>
<th>Action</th>
</tr>

<?php while($r=$res->fetch_assoc()){ ?>

<tr>
<td><?php echo $r['id']?></td>
<td><?php echo $r['name']?></td>

<td>
<?php if($r['photo_path']!=""){ ?>
<img src="../public/uploads/doctors/<?php echo $r['photo_path']?>" width="60">
<?php } else { echo "No Image"; } ?>
</td>

<td><?php echo $r['email']?></td>
<td><?php echo $r['specialization']?></td>
<td><?php echo $r['consultation_fee']?></td>
<td><?php echo $r['available_days']?></td>

<td>
<div class="action-btns">
<a href="edit_doctor.php?id=<?php echo $r['id']?>" class="btn btn-edit">Edit</a>
<a href="delete_doctor.php?id=<?php echo $r['id']?>" class="btn btn-delete" onclick="return confirm('Are you sure?')">Delete</a>
</div>
</td>

</tr>

<?php } ?>

</table>

</div>

</body>
</html>