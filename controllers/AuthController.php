<?php
session_start();
include("../config/db.php");

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    if(isset($_POST['login'])){

        $email = $_POST['email'];
        $password = $_POST['password'];

        $result = $conn->query("SELECT * FROM users WHERE email='$email'");

        if($result && $result->num_rows > 0){

            $user = $result->fetch_assoc();

            if(password_verify($password, $user['password_hash'])){

                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role'] = $user['role'];

                if($user['role'] == 'admin'){
                    header("Location: ../views/admin_dashboard.php");
                }else{
                    header("Location: ../views/user_dashboard.php");
                }
                exit();

            }else{
                echo "Wrong Password";
            }

        }else{
            echo "User Not Found";
        }

    }

}