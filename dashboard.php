<?php
session_start();
include "config.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: signin.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$message = "";

// Deposit
if(isset($_POST['deposit'])){

    $amount = floatval($_POST['amount']);

    if($amount > 0){

        $stmt = $conn->prepare("UPDATE users SET balance = balance + ? WHERE id=?");
        $stmt->bind_param("di",$amount,$user_id);

        if($stmt->execute()){

            $stmt2 = $conn->prepare("INSERT INTO transactions(user_id,type,amount,description)
            VALUES(?, 'Deposit', ?, 'Cash Deposit')");

            $stmt2->bind_param("id",$user_id,$amount);
            $stmt2->execute();

            $message="Deposit Successful!";
        }
    }
}

// Load latest balance
$stmt = $conn->prepare("SELECT * FROM users WHERE id=?");
$stmt->bind_param("i",$user_id);
$stmt->execute();
$user=$stmt->get_result()->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>

<title>Dashboard</title>

<style>

body{
font-family:Arial;
background:#f4f4f4;
}

.container{
width:700px;
margin:40px auto;
background:white;
padding:30px;
border-radius:10px;
box-shadow:0 0 10px rgba(0,0,0,.2);
}

input{
width:100%;
padding:12px;
margin:10px 0;
}

button{
padding:12px 20px;
background:#003366;
color:white;
border:none;
cursor:pointer;
}

.success{
background:#d4edda;
padding:10px;
margin-bottom:15px;
color:#155724;
}

table{
width:100%;
border-collapse:collapse;
margin-top:20px;
}

table th,table td{
border:1px solid #ddd;
padding:10px;
}

.logout{
display:inline-block;
margin-top:20px;
background:red;
color:white;
padding:10px 20px;
text-decoration:none;
}

</style>

</head>

<body>

<div class="container">

<h1>Welcome, <?php echo $user['fullname']; ?> 👋</h1>

<h3>Username: <?php echo $user['username']; ?></h3>

<h3>Balance: Rs. <?php echo number_format($user['balance'],2); ?></h3>

<?php
if($message!=""){
echo "<div class='success'>$message</div>";
}
?>

<h2>Deposit Money</h2>

<form method="POST">

<input
type="number"
name="amount"
step="0.01"
placeholder="Enter Amount"
required>

<button name="deposit">
Deposit
</button>

</form>

<h2>Transaction History</h2>

<table>

<tr>
<th>Type</th>
<th>Amount</th>
<th>Date</th>
</tr>

<?php

$result=$conn->query("SELECT * FROM transactions WHERE user_id=$user_id ORDER BY id DESC");

while($row=$result->fetch_assoc()){

echo "<tr>

<td>".$row['type']."</td>

<td>Rs. ".number_format($row['amount'],2)."</td>

<td>".$row['created_at']."</td>

</tr>";

}

?>

</table>

<br><br>

<a href="withdraw.php">
<button>Withdraw</button>
</a>

<a href="transfer.php">
<button>Transfer</button>
</a>

<a href="transferhistory.php">
<button>History</button>
</a>

<a href="profile.php">
<button>My Profile</button>
</a>

<br><br>

<a class="logout" href="logout.php">Logout</a>

</div>

</body>

</html>
