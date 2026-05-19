<!DOCTYPE html>
<html>
<head>
<title>Doctor Dashboard</title>
<style>
body{
    font-family: Arial;
    background:#f5f7fb;
    margin:0;
}
.header{
    background:#4e73df;
    color:white;
    padding:15px;
    font-size:20px;
}
.container{
    padding:20px;
}
.card{
    background:white;
    padding:15px;
    margin-bottom:20px;
    border-radius:10px;
    box-shadow:0 2px 10px rgba(0,0,0,0.1);
}
table{
    width:100%;
    border-collapse:collapse;
}
th,td{
    padding:10px;
    text-align:left;
}
th{
    background:#4e73df;
    color:white;
}
tr:nth-child(even){
    background:#f2f2f2;
}
.badge{
    padding:5px 10px;
    border-radius:5px;
    color:white;
}
.pending{background:orange;}
.completed{background:green;}
.noshow{background:red;}
button{
    padding:6px 10px;
    border:none;
    border-radius:5px;
    cursor:pointer;
}
.btn-success{background:green;color:white;}
.btn-danger{background:red;color:white;}
</style>
</head>

<body>

<div class="header">Doctor Dashboard</div>

<div class="container">

<div class="card">
<h3>Today's Appointments</h3>

<table>
<tr>
<th>Time</th>
<th>Patient</th>
<th>Reason</th>
<th>Status</th>
<th>Action</th>
</tr>

<?php foreach($appointments as $a): ?>
<tr>
<td><?= $a['appointment_time'] ?></td>
<td><?= $a['patient_name'] ?></td>
<td><?= $a['reason'] ?></td>
<td id="status-<?= $a['id'] ?>">
<span class="badge <?= strtolower(str_replace('-','',$a['status'])) ?>">
<?= $a['status'] ?>
</span>
</td>
<td>
<button class="btn-success" onclick="updateStatus(<?= $a['id'] ?>,'Completed')">Complete</button>
<button class="btn-danger" onclick="updateStatus(<?= $a['id'] ?>,'No-Show')">No-Show</button>
</td>
</tr>
<?php endforeach; ?>
</table>
</div>

<div class="card">
<h3>Weekly Schedule</h3>

<table>
<tr>
<th>Day</th>
<th>Time</th>
<th>Patient</th>
</tr>

<?php foreach($weekly as $w): ?>
<tr>
<td><?= date('l', strtotime($w['appointment_date'])) ?></td>
<td><?= $w['appointment_time'] ?></td>
<td><?= $w['patient_name'] ?></td>
</tr>
<?php endforeach; ?>
</table>
</div>

</div>

<script>
function updateStatus(id, status){
    fetch('../api/update_status.php?id='+id, {
        method:'PUT',
        headers:{'Content-Type':'application/json'},
        body: JSON.stringify({status:status})
    })
    .then(res=>res.json())
    .then(data=>{
        document.getElementById('status-'+id).innerHTML =
        '<span class="badge">'+data.new_status+'</span>';
    });
}
</script>

</body>
</html>