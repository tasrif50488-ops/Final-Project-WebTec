<?php
session_start();

if(!isset($_GET['doctor_id'])){
    header("Location: doctors.php");
    exit();
}

$doctor_id = $_GET['doctor_id'];
?>

<!DOCTYPE html>
<html>
<head>
<title>Slots</title>

<style>
body{background:#0f172a;color:white;font-family:Arial;}
.container{padding:30px;}
.slot{
display:inline-block;
padding:10px;
margin:5px;
background:#1e293b;
cursor:pointer;
border-radius:5px;
}
.slot:hover{background:#3b82f6;}
</style>

</head>

<body>

<div class="container">

<h2>Select Date & Time</h2>

<input type="date" id="date" min="<?= date('Y-m-d') ?>">

<br><br>

<div id="slots"></div>

</div>

<script>

function load(){
let date = document.getElementById("date").value;

if(!date){
document.getElementById("slots").innerHTML = "";
return;
}

fetch("../../api/slots.php?doctor_id=<?= $doctor_id ?>&date="+date)
.then(res=>res.json())
.then(data=>{

let html="";

data.forEach(t=>{
html+=`<div class="slot" onclick="go('${t}')">${t}</div>`;
});

document.getElementById("slots").innerHTML = html;

});
}

function go(time){
let date = document.getElementById("date").value;

window.location.href =
"add.php?doctor_id=<?= $doctor_id ?>&date="+date+"&time="+time;
}

document.getElementById("date").addEventListener("change", load);

</script>

</body>
</html>