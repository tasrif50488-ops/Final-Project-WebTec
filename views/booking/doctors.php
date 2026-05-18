<?php
session_start();
$conn = new mysqli("localhost","root","","hospital_system");

$specializations = $conn->query("SELECT * FROM specializations");
?>

<!DOCTYPE html>
<html>
<head>
<title>Doctors</title>

<style>
body{
font-family:Arial;
background:#0f172a;
color:white;
margin:0;
}
.topbar{
padding:15px;
background:#1e293b;
display:flex;
justify-content:space-between;
}
.container{
padding:20px;
}
select{
padding:10px;
border-radius:5px;
margin-bottom:20px;
}
.grid{
display:grid;
grid-template-columns:repeat(3,1fr);
gap:20px;
}
.card{
background:#1e293b;
padding:15px;
border-radius:10px;
text-align:center;
}
.btn{
display:inline-block;
margin-top:10px;
padding:8px 15px;
background:#3b82f6;
color:white;
text-decoration:none;
border-radius:5px;
}
</style>

</head>

<body>

<div class="topbar">
<h2>Doctors</h2>
<a href="../dashboard.php" style="color:white;">← Back</a>
</div>

<div class="container">

<select id="filter">
<option value="">All</option>
<?php while($s = $specializations->fetch_assoc()){ ?>
<option value="<?= $s['id'] ?>"><?= $s['name'] ?></option>
<?php } ?>
</select>

<div class="grid" id="doctorList"></div>

</div>

<script>

function loadDoctors(id=""){
fetch("../../api/doctors.php?specialization_id="+id)
.then(res=>res.json())
.then(data=>{

let html="";

data.forEach(d=>{
html+=`
<div class="card">
<h3>${d.name}</h3>
<p>${d.specialization}</p>
<a class="btn" href="slots.php?doctor_id=${d.id}">View Slots</a>
</div>
`;
});

document.getElementById("doctorList").innerHTML = html;

});
}

loadDoctors();

document.getElementById("filter").addEventListener("change",function(){
loadDoctors(this.value);
});

</script>

</body>
</html>