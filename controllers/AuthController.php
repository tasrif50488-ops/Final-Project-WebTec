<?php
session_start();

$conn = new mysqli("localhost", "root", "", "hospital_system");

if ($conn->connect_error) {
    die("Database Connection Failed");
}

# =========================
# REGISTER
# =========================
if(isset($_POST['register'])){

    $name  = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // ✅ FIX: DOB instead of age
    $dob   = $_POST['dob'];

    $phone = $_POST['phone'];
    $blood = $_POST['blood_group'];

    // Check email exists
    $check = $conn->query("SELECT id FROM users WHERE email='$email'");

    if($check->num_rows > 0){
        header("Location: ../views/auth/register.php?error=email_exists");
        exit();
    }

    // Insert user
    $conn->query("
    INSERT INTO users (name,email,password_hash,role,dob,blood_group,phone,is_active)
    VALUES ('$name','$email','$password','patient','$dob','$blood','$phone',1)
    ");

    header("Location: ../views/auth/login.php?success=1");
    exit();
}

# =========================
# LOGIN
# =========================
if(isset($_POST['login'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    $res = $conn->query("SELECT * FROM users WHERE email='$email'");

    if($res->num_rows == 0){
        header("Location: ../views/auth/login.php?error=user_not_found");
        exit();
    }

    $user = $res->fetch_assoc();

    // Check active
    if($user['is_active'] == 0){
        header("Location: ../views/auth/login.php?error=deactivated");
        exit();
    }

    // Verify password
    if(password_verify($password, $user['password_hash'])){

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['name']    = $user['name'];
        $_SESSION['role']    = $user['role'];

        // Role based redirect
        if($user['role'] == 'patient'){
            header("Location: ../views/dashboard.php");
        }
        elseif($user['role'] == 'doctor'){
            header("Location: ../views/doctor.php");
        }
        else{
            header("Location: ../views/admin.php");
        }

        exit();

    } else {
        header("Location: ../views/auth/login.php?error=wrong_password");
        exit();
    }
}
?>