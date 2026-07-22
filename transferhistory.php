<?php
session_start();
include("config.php");

if(!isset($_SESSION['user_id'])){
    header("Location: signin.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT * FROM transactions WHERE user_id=? ORDER BY created_at DESC");
$stmt->bind_param("i",$user_id);
$stmt->execute();

$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Transaction History</title>

    <style>

    body{
        font-family:Arial, sans-serif;
        background:#f4f6f9;
        margin:0;
    }

    .container{
        width:90%;
        max-width:1000px;
        margin:40px auto;
        background:#fff;
        padding:30px;
        border-radius:10px;
        box-shadow:0 0 10px rgba(0,0,0,0.2);
    }

    h1{
        text-align:center;
        color:#003366;
    }

    table{
        width:100%;
        border-collapse:collapse;
        margin-top:30px;
    }

    table th{
        background:#003366;
        color:white;
        padding:12px;
    }

    table td{
        padding:12px;
        text-align:center;
        border-bottom:1px solid #ddd;
    }

    .deposit{
        color:green;
        font-weight:bold;
    }

    .withdraw{
        color:red;
        font-weight:bold;
    }

    .transfer{
        color:#0066cc;
        font-weight:bold;
    }

    .btn{
        display:inline-block;
        margin-top:25px;
        padding:12px 25px;
        background:#003366;
        color:white;
        text-decoration:none;
        border-radius:5px;
    }

    .btn:hover{
        background:#0055aa;
    }

    </style>

</head>

<body>

<div class="container">

<h1>Transaction History</h1>

<table>

<tr>
<th>ID</th>
<th>Type</th>
<th>Description</th>
<th>Amount</th>
<th>Date</th>
</tr>
<?php

if($result->num_rows > 0){

    while($row = $result->fetch_assoc()){

?>

<tr>

<td><?php echo $row['id']; ?></td>

<td class="<?php echo strtolower($row['type']); ?>">
    <?php echo ucfirst($row['type']); ?>
</td>

<td><?php echo $row['description']; ?></td>

<td>Rs. <?php echo number_format($row['amount'],2); ?></td>

<td><?php echo $row['created_at']; ?></td>

</tr>

<?php

    }

}else{

?>

<tr>
<td colspan="5">No Transactions Found.</td>
</tr>

<?php

}

?>
</table>

<br><br>

<a href="dashboard.php" class="btn">← Back to Dashboard</a>

</div>

</body>
</html>