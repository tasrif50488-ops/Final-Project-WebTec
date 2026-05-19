<?php
include("../config/db.php");

$id = $_GET['id'];

$sql = "SELECT * FROM specializations WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$message = "";

if(isset($_POST['update'])){
    $name = $_POST['name'];

    $update_sql = "UPDATE specializations SET name='$name' WHERE id=$id";

    if($conn->query($update_sql)){
        header("Location: list_specialization.php?msg=updated");
        exit();
    } else {
        $message = "Update Failed!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Specialization</title>

<style>
body{
    font-family: Arial;
    background:#f4f6f9;
}

.container{
    width:350px;
    margin:60px auto;
    background:#fff;
    padding:25px;
    border-radius:10px;
    box-shadow:0 4px 15px rgba(0,0,0,0.1);
}

h2{
    text-align:center;
}

input{
    width:100%;
    padding:10px;
    margin-top:10px;
    border:1px solid #ccc;
    border-radius:6px;
}

button{
    padding:10px;
    border:none;
    border-radius:6px;
    cursor:pointer;
}

.btn-primary{
    background:#3498db;
    color:#fff;
    width:100%;
    margin-top:15px;
}

.btn-primary:hover{
    background:#2980b9;
}

.btn-back{
    background:#95a5a6;
    color:white;
    margin-bottom:10px;
}

.message{
    text-align:center;
    color:red;
    margin-top:10px;
}
</style>

</head>
<body>

<div class="container">

<h2>Edit Specialization</h2>

<button onclick="history.back()" class="btn-back">← Back</button>

<?php if($message != ""){ ?>
<p class="message"><?php echo $message; ?></p>
<?php } ?>

<form method="POST">

<input type="text" name="name" value="<?php echo $row['name']; ?>" required>

<button type="submit" name="update" class="btn-primary">Update</button>

</form>

</div>

</body>
</html>