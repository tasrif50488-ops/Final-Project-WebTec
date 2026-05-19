<?php
include("../config/db.php");

$doctor_id = $_GET['id'];

$sql = "SELECT doctors.*, users.name, users.email, specializations.id AS spec_id
        FROM doctors
        JOIN users ON doctors.user_id = users.id
        JOIN specializations ON doctors.specialization_id = specializations.id
        WHERE doctors.id='$doctor_id'";

$res = $conn->query($sql);
$data = $res->fetch_assoc();

$specs = $conn->query("SELECT * FROM specializations");

if(isset($_POST['update'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $spec_id = $_POST['specialization'];
    $bio = $_POST['bio'];
    $fee = $_POST['fee'];
    $days = isset($_POST['days']) ? implode(",", $_POST['days']) : "";

    $conn->query("UPDATE users SET name='$name', email='$email' 
                  WHERE id=".$data['user_id']);

    $conn->query("UPDATE doctors SET 
                    specialization_id='$spec_id',
                    bio='$bio',
                    consultation_fee='$fee',
                    available_days='$days'
                  WHERE id='$doctor_id'");

    header("Location: list_doctor.php?msg=updated");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Doctor</title>

<style>
body{
    font-family: Arial;
    background:#f4f6f9;
}

.container{
    width:400px;
    margin:50px auto;
    background:#fff;
    padding:25px;
    border-radius:10px;
    box-shadow:0 4px 15px rgba(0,0,0,0.1);
}

h2{
    text-align:center;
}

input, select, textarea{
    width:100%;
    padding:10px;
    margin-top:8px;
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
</style>

</head>
<body>

<div class="container">

<h2>Edit Doctor</h2>

<button onclick="history.back()" class="btn-back">← Back</button>

<form method="POST">

<input type="text" name="name" value="<?php echo $data['name']; ?>" required>

<input type="email" name="email" value="<?php echo $data['email']; ?>" required>

<select name="specialization" required>
<?php while($s = $specs->fetch_assoc()){ ?>
<option value="<?php echo $s['id']; ?>"
<?php if($s['id'] == $data['spec_id']) echo "selected"; ?>>
<?php echo $s['name']; ?>
</option>
<?php } ?>
</select>

<textarea name="bio"><?php echo $data['bio']; ?></textarea>

<input type="number" name="fee" value="<?php echo $data['consultation_fee']; ?>" required>

<label>Available Days:</label><br>

<?php
$selected_days = explode(",", $data['available_days']);
$days_list = ["Monday","Tuesday","Wednesday","Thursday","Friday"];

foreach($days_list as $d){
    $checked = in_array($d, $selected_days) ? "checked" : "";
    echo "<input type='checkbox' name='days[]' value='$d' $checked> $d ";
}
?>

<button type="submit" name="update" class="btn-primary">Update Doctor</button>

</form>

</div>

</body>
</html>