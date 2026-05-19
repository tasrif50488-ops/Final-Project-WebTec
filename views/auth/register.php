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
font-size:14px;
}

input::placeholder{
color:#888;
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

button:hover{
background:#2563eb;
}
</style>

</head>

<body>

<div class="box">

<h2>Create Account</h2>

<form method="POST" action="../../controllers/AuthController.php">

<input type="text" name="name" placeholder="Full Name" required>

<input type="email" name="email" placeholder="Enter your email" required>

<input type="password" name="password" placeholder="Create password" required>

<input type="date" name="dob" required>

<input type="text" name="phone" placeholder="Phone number" required>

<select name="blood_group" required>
<option value="">Select Blood Group</option>
<option>A+</option>
<option>B+</option>
<option>O+</option>
<option>AB+</option>
</select>

<button type="submit" name="register">Register</button>

</form>

<a href="login.php">Already have account? Login</a>

</div>

</body>
</html>