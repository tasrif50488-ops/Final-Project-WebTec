<!DOCTYPE html>
<html>
<head>
<title>Register</title>

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
width:380px;
border-radius:15px;
box-shadow:0 15px 30px rgba(0,0,0,0.3);
}

h2{
text-align:center;
margin-bottom:20px;
color:#1e3a8a;
}

input, select{
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

.error{
background:#ffe0e0;
color:red;
padding:10px;
border-radius:6px;
margin-bottom:10px;
text-align:center;
}

.link{
text-align:center;
margin-top:15px;
}
</style>

</head>

<body>

<div class="box">

<h2>Create Account</h2>

<?php if(isset($_GET['error']) && $_GET['error']=="email_exists"){ ?>
<div class="error">Email already exists</div>
<?php } ?>

<form method="POST" action="../../controllers/AuthController.php">

<input type="text" name="name" placeholder="Full Name" required>

<input type="email" name="email" placeholder="Email" required>

<input type="password" name="password" placeholder="Password" required>

<!-- ✅ FIX: age না, DOB -->
<input type="date" name="dob" required>

<input type="text" name="phone" placeholder="Phone" required>

<select name="blood_group" required>
<option value="">Blood Group</option>
<option>A+</option>
<option>B+</option>
<option>O+</option>
<option>AB+</option>
</select>

<button type="submit" name="register">Register</button>

</form>

<div class="link">
<a href="login.php">Already have account? Login</a>
</div>

</div>

</body>
</html>