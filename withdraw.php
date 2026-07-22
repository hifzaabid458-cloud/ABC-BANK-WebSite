<?php
session_start();
include "config.php";

if(!isset($_SESSION['user_id'])){
    header("Location: signin.php");
    exit();
}

// Withdraw Money
if(isset($_POST['withdraw'])){

    $amount = floatval($_POST['withdraw_amount']);
$user_id = $_SESSION['user_id'];

// Get current balance
$stmt = $conn->prepare("SELECT balance FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$current_balance = $row['balance'];

if($amount <= 0){

    echo "<p style='color:red;'>Please enter a valid amount.</p>";

}
elseif($amount > $current_balance){

    echo "<p style='color:red;'>Insufficient Balance!</p>";

}
else{

    // Update balance
    $stmt = $conn->prepare("UPDATE users SET balance = balance - ? WHERE id = ?");
    $stmt->bind_param("di", $amount, $user_id);

    if($stmt->execute()){

        // Save transaction
        $stmt2 = $conn->prepare("INSERT INTO transactions(user_id,type,amount,description)
        VALUES(?, 'Withdraw', ?, 'Cash Withdrawal')");

        $stmt2->bind_param("id", $user_id, $amount);
        $stmt2->execute();

       $message = "Withdrawal Successful!";

    }else{

        echo "<p style='color:red;'>Withdrawal Failed.</p>";
    }
}
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Withdraw Money</title>
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

<h1>Withdraw Money</h1>
<?php
if(isset($message)){
?>
<div style="
background:#d4edda;
color:#155724;
padding:15px;
margin-bottom:20px;
border-radius:5px;
font-weight:bold;
">
<?php echo $message; ?>
</div>
<?php
}
?>
<?php

$stmt = $conn->prepare("SELECT balance FROM users WHERE id=?");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();

$user = $stmt->get_result()->fetch_assoc();

?>

<h3>Current Balance: Rs. <?php echo number_format($user['balance'],2); ?></h3>
<form method="POST">

<input
type="number"
name="withdraw_amount"
placeholder="Enter Withdrawal Amount"
required>

<button type="submit" name="withdraw">
Withdraw
</button>

</form>

</body>
</html>