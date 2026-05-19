<?php
<<<<<<< HEAD
$conn = new mysqli("localhost", "root", "", "hospital_system");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
=======
$host = "localhost";
$dbname = "hospital_system";
$username = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("DB Connection Failed: " . $e->getMessage());
}
>>>>>>> origin/file-4
