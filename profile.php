<?php
session_start();
include("config.php");

if(!isset($_SESSION['user_id'])){
    header("Location: signin.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT * FROM users WHERE id=?");
$stmt->bind_param("i",$user_id);
$stmt->execute();

$user = $stmt->get_result()->fetch_assoc();
?>
<!DOCTYPE html>
<html>

<head>

<title>My Profile</title>

<style>

body{
    margin:0;
    background:#f4f6f9;
    font-family:Arial;
}

.container{
    width:700px;
    margin:50px auto;
    background:white;
    padding:30px;
    border-radius:10px;
    box-shadow:0 0 15px rgba(0,0,0,.2);
}

h1{
    text-align:center;
    color:#003366;
}

table{
    width:100%;
    margin-top:30px;
    border-collapse:collapse;
}

td{
    padding:15px;
    border-bottom:1px solid #ddd;
}

.title{
    font-weight:bold;
    width:220px;
}

.btn{
    display:inline-block;
    padding:10px 20px;
    background:#003366;
    color:white;
    text-decoration:none;
    border-radius:5px;
    margin-top:25px;
}

.btn:hover{
    background:#0055aa;
}

</style>

</head>

<body>

<div class="container">

<h1>My Profile</h1>

<table>

<tr>
<td class="title">Full Name</td>
<td><?php echo $user['fullname']; ?></td>
</tr>

<tr>
<td class="title">Username</td>
<td><?php echo $user['username']; ?></td>
</tr>

<tr>
<td class="title">Email</td>
<td><?php echo $user['email']; ?></td>
</tr>

<tr>
<td class="title">Phone</td>
<td><?php echo $user['phone']; ?></td>
</tr>

<tr>
<td class="title">Account Number</td>
<td><?php echo $user['account_number']; ?></td>
</tr>

<tr>
<td class="title">Current Balance</td>
<td>Rs. <?php echo number_format($user['balance'],2); ?></td>
</tr>

</table>

<br>

<a href="edit_profile.php" class="btn">Edit Profile</a>

<a href="dashboard.php" class="btn">Dashboard</a>

<a href="logout.php" class="btn">Logout</a>

</div>

</body>
</html>
