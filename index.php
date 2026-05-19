<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("config/db.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Hospital System</title>
    <link rel="stylesheet" href="public/style.css">
</head>
<body>

<div class="container">
    <h2>Hospital Management System</h2>

    <br>

    <a href="views/add_doctor.php">➕ Add Doctor</a><br><br>
    <a href="views/list_doctor.php">📋 Doctor List</a><br><br>
    <a href="views/add_specialization.php">➕ Add Specialization</a><br><br>
    <a href="views/list_specialization.php">📋 Specialization List</a><br><br>
</div>

</body>
</html>