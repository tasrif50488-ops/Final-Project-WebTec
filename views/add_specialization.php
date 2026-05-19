<?php
include("../config/db.php");

if(isset($_POST['submit'])){
    $name=$_POST['name'];

    if(!empty($name)){
        $conn->query("INSERT INTO specializations(name) VALUES('$name')");
        header("Location: list_specialization.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Specialization</title>
<link rel="stylesheet" href="../public/style.css">
</head>
<body>

<div class="container">

<h2>Add Specialization</h2>

<a href="list_specialization.php" class="btn btn-back">← Back</a>

<form method="POST">

<label>Name</label>
<input type="text" name="name">

<button type="submit" name="submit">Add</button>

</form>

</div>

</body>
</html>