<?php
include("../config/db.php");

$spec_result = $conn->query("SELECT * FROM specializations");

if(isset($_POST['submit'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $spec_id = $_POST['specialization'];
    $bio = $_POST['bio'];
    $fee = $_POST['fee'];
    $days = isset($_POST['days']) ? implode(",", $_POST['days']) : "";

    $photo_name = "";

    if(isset($_FILES['photo']) && $_FILES['photo']['name'] != ""){
        $photo = $_FILES['photo']['name'];
        $tmp = $_FILES['photo']['tmp_name'];

        $photo_name = time() . "_" . $photo;
        $path = "../public/uploads/doctors/" . $photo_name;

        move_uploaded_file($tmp, $path);
    }

    $check = $conn->query("SELECT * FROM users WHERE email='$email'");

    if($check->num_rows == 0){

        $sql1 = "INSERT INTO users (name,email,password_hash,role,is_active)
                 VALUES ('$name','$email','$password','doctor',1)";

        if($conn->query($sql1)){

            $user_id = $conn->insert_id;

            $sql2 = "INSERT INTO doctors 
            (user_id,specialization_id,bio,consultation_fee,photo_path,available_days)
            VALUES
            ('$user_id','$spec_id','$bio','$fee','$photo_name','$days')";

            if($conn->query($sql2)){
                header("Location: list_doctor.php");
                exit();
            } else {
                echo "Doctor Insert Error!";
            }

        } else {
            echo "User Insert Error!";
        }

    } else {
        echo "Email already exists!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Doctor</title>
<link rel="stylesheet" href="../public/style.css">
</head>
<body>

<div class="container">

<h2>Add Doctor</h2>

<a href="list_doctor.php" class="btn btn-back">← Back</a>

<form method="POST" enctype="multipart/form-data">

<label>Name</label>
<input type="text" name="name" placeholder="Enter name" required>

<label>Email</label>
<input type="email" name="email" placeholder="Enter email" required>

<label>Password</label>
<input type="password" name="password" placeholder="Enter password" required>

<label>Specialization</label>
<select name="specialization" required>
<?php while($row = $spec_result->fetch_assoc()){ ?>
<option value="<?php echo $row['id']; ?>">
<?php echo $row['name']; ?>
</option>
<?php } ?>
</select>

<label>Doctor Bio</label>
<textarea name="bio" placeholder="Write doctor bio..."></textarea>

<label>Consultation Fee</label>
<input type="number" name="fee" placeholder="Enter fee" required>

<label>Upload Photo</label>
<input type="file" name="photo">

<label>Available Days</label><br>

<input type="checkbox" name="days[]" value="Monday"> Monday
<input type="checkbox" name="days[]" value="Tuesday"> Tuesday
<input type="checkbox" name="days[]" value="Wednesday"> Wednesday
<input type="checkbox" name="days[]" value="Thursday"> Thursday
<input type="checkbox" name="days[]" value="Friday"> Friday

<br><br>

<button type="submit" name="submit">Add Doctor</button>

</form>

</div>

</body>
</html>