<?php
session_start();
include("../config/db.php");

if(isset($_POST['login'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    $res = $conn->query("SELECT * FROM users WHERE email='$email'");

    if($res->num_rows > 0){

        $user = $res->fetch_assoc();

        if(password_verify($password, $user['password_hash'])){

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];

            if($user['role'] == 'admin'){
                header("Location: ../views/admin_dashboard.php");
            }else{
                header("Location: ../views/dashboard.php");
            }

        }else{
            echo "Wrong Password";
        }

    }else{
        echo "User not found";
    }
}