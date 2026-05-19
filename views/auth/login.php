<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<title>Login</title>

<style>
body{
margin:0;
font-family:'Segoe UI',sans-serif;
background: linear-gradient(120deg,#0f172a,#1e3a8a);
display:flex;
justify-content:center;
align-items:center;
height:100vh;
}

.box{
background:white;
padding:35px;
width:360px;
border-radius:15px;
box-shadow:0 15px 30px rgba(0,0,0,0.3);
text-align:center;
}

h2{
margin-bottom:20px;
color:#1e3a8a;
}

input{
width:100%;
padding:12px;
margin:10px 0;
border-radius:8px;
border:1px solid #ccc;
}

button{
width:100%;
padding:12px;
background:#3b82f6;
color:white;
border:none;
border-radius:8px;
cursor:pointer;
}

a{
display:block;
margin-top:15px;
color:#3b82f6;
text-decoration:none;
}

.logo{
font-size:22px;
font-weight:bold;
margin-bottom:10px;
color:#1e40af;
}
</style>

</head>

<body>

<div class="box">

<div class="logo">Hospital System</div>

<h2>Login</h2>

<form method="POST" action="../../controllers/AuthController.php">

<input type="email" name="email" placeholder="Enter your email" required>

<input type="password" name="password" placeholder="Enter your password" required>

<button type="submit" name="login">Login</button>

</form>

<a href="register.php">Create new account</a>

</div>

</body>
</html>