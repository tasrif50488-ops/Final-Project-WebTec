<?php
include("../config/db.php");

$res=$conn->query("SELECT * FROM specializations");
?>

<!DOCTYPE html>
<html>
<head>
<title>Specialization List</title>
<link rel="stylesheet" href="../public/style.css">
</head>
<body>

<div class="container">

<div class="top-bar">
<h2>Specialization List</h2>
<a href="add_specialization.php" class="btn btn-add">Add</a>
</div>

<a href="../index.php" class="btn btn-back">← Home</a>

<table>

<tr>
<th>ID</th>
<th>Name</th>
<th>Action</th>
</tr>

<?php while($r=$res->fetch_assoc()){ ?>

<tr>
<td><?php echo $r['id']?></td>
<td><?php echo $r['name']?></td>
<td>
<div class="action-btns">
<a href="edit_specialization.php?id=<?php echo $r['id']?>" class="btn btn-edit">Edit</a>
<a href="delete_specialization.php?id=<?php echo $r['id']?>" class="btn btn-delete">Delete</a>
</div>
</td>
</tr>

<?php } ?>

</table>

</div>

</body>
</html>