<?php
session_start();
include "config.php";

if(!isset($_SESSION['user_id'])){
    header("Location: signin.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$message = "";
$message_type = "";

if(isset($_POST['transfer'])){

    $receiver = trim($_POST['receiver']);
    $amount = floatval($_POST['amount']);

    // Get Sender
    $stmt = $conn->prepare("SELECT * FROM users WHERE id=?");
    $stmt->bind_param("i",$user_id);
    $stmt->execute();

    $sender = $stmt->get_result()->fetch_assoc();

    // Find Receiver
    $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
    $stmt->bind_param("s",$receiver);
    $stmt->execute();

    $receiverData = $stmt->get_result()->fetch_assoc();

    if(!$receiverData){

        $message="Receiver not found.";
        $message_type="error";

    }
    elseif($receiverData['id']==$user_id){

        $message="You cannot transfer money to yourself.";
        $message_type="error";

    }
    elseif($amount<=0){

        $message="Enter a valid amount.";
        $message_type="error";

    }
    elseif($amount>$sender['balance']){

        $message="Insufficient Balance.";
        $message_type="error";

    }
    else{

        // Deduct Sender Balance
        $stmt=$conn->prepare("UPDATE users SET balance=balance-? WHERE id=?");
        $stmt->bind_param("di",$amount,$user_id);
        $stmt->execute();

        // Add Receiver Balance
        $stmt=$conn->prepare("UPDATE users SET balance=balance+? WHERE id=?");
        $stmt->bind_param("di",$amount,$receiverData['id']);
        $stmt->execute();

        // Save Transaction
        $description="Transferred to ".$receiverData['username'];

        $stmt=$conn->prepare("INSERT INTO transactions(user_id,type,amount,description)
        VALUES(?,?,?,?)");

        $type="Transfer";

        $stmt->bind_param("isds",$user_id,$type,$amount,$description);
        $stmt->execute();

        $message="Money transferred successfully.";
        $message_type="success";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Transfer Money</title>
</head>

<body>
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
<h1>Transfer Money</h1>

<form method="POST">

<input
type="text"
name="receiver"
placeholder="Receiver Username"
required>

<br><br>

<input
type="number"
name="amount"
step="0.01"
placeholder="Enter Amount"
required>

<br><br>

<button type="submit" name="transfer">
Transfer
</button>

</form>
<?php
if($message!=""){
?>
<div style="
padding:15px;
margin-bottom:20px;
border-radius:5px;
background:
<?php
echo ($message_type=="success")?"#d4edda":"#f8d7da";
?>;
color:
<?php
echo ($message_type=="success")?"#155724":"#721c24";
?>;
">

<?php echo $message; ?>

</div>

<?php
}
?>
<?php

$stmt=$conn->prepare("SELECT balance FROM users WHERE id=?");
$stmt->bind_param("i",$user_id);
$stmt->execute();

$balance=$stmt->get_result()->fetch_assoc();

?>

<h3>
Current Balance:
Rs. <?php echo number_format($balance['balance'],2); ?>
</h3>
</body>
</html>