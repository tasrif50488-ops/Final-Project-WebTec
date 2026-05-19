<!DOCTYPE html>
<html>
<head>
<title>Admin Panel</title>

<style>
body{font-family:Arial;background:#f4f6f9;margin:0;}
.header{background:#28a745;color:white;padding:15px;font-size:20px;}
.container{padding:20px;}
.card{background:white;padding:20px;border-radius:10px;box-shadow:0 2px 10px rgba(0,0,0,0.1);}
table{width:100%;border-collapse:collapse;}
th,td{padding:10px;text-align:center;}
th{background:#28a745;color:white;}
button{padding:6px 10px;border:none;border-radius:5px;cursor:pointer;}
.confirm{background:#007bff;color:white;}
.cancel{background:#dc3545;color:white;}
</style>
</head>

<body>

<div class="header">Admin Appointment Panel</div>

<div class="container">
<div class="card">

<table>
<tr>
<th>Patient</th>
<th>Date</th>
<th>Time</th>
<th>Status</th>
<th>Action</th>
</tr>

<?php foreach($appointments as $a): ?>
<tr>
<td><?= $a['patient_name'] ?></td>
<td><?= $a['appointment_date'] ?></td>
<td><?= $a['appointment_time'] ?></td>

<td id="status-<?= $a['id'] ?>">
<?= $a['status'] ?>
</td>

<td>
<button class="confirm" onclick="updateStatus(<?= $a['id'] ?>,'Confirmed')">Confirm</button>
<button class="cancel" onclick="updateStatus(<?= $a['id'] ?>,'Cancelled')">Cancel</button>
</td>
</tr>
<?php endforeach; ?>

</table>

</div>
</div>

<script>
function updateStatus(id, status){
    fetch('api/update_status.php?id=' + id, {
        method:'PUT',
        headers:{'Content-Type':'application/json'},
        body: JSON.stringify({status:status})
    })
    .then(res => res.json())
    .then(data => {
        document.getElementById('status-'+id).innerText = data.new_status;
    });
}
</script>

</body>
</html>