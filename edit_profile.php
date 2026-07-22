<?php
session_start();
include("config.php");

if(!isset($_SESSION['user_id'])){
    header("Location: signin.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$message = "";

if(isset($_POST['update'])){

    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);

    $stmt = $conn->prepare("UPDATE users SET fullname=?, email=?, phone=? WHERE id=?");
    $stmt->bind_param("sssi",$fullname,$email,$phone,$user_id);

    if($stmt->execute()){
        $message = "Profile Updated Successfully!";
    }else{
        $message = "Failed to Update Profile.";
    }
}

$stmt = $conn->prepare("SELECT * FROM users WHERE id=?");
$stmt->bind_param("i",$user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>

<title>Edit Profile</title>

<style>

body{
    background:#f4f6f9;
    font-family:Arial;
}

.container{
    width:600px;
    margin:50px auto;
    background:white;
    padding:30px;
    border-radius:10px;
    box-shadow:0 0 10px rgba(0,0,0,.2);
}

h1{
    text-align:center;
    color:#003366;
}

input{
    width:100%;
    padding:12px;
    margin:10px 0;
}

button{
    width:100%;
    padding:12px;
    background:#003366;
    color:white;
    border:none;
    cursor:pointer;
}

button:hover{
    background:#0055aa;
}

.success{
    background:#d4edda;
    color:#155724;
    padding:12px;
    margin-bottom:15px;
    border-radius:5px;
}

.btn{
    display:inline-block;
    margin-top:20px;
    text-decoration:none;
    background:#003366;
    color:white;
    padding:10px 20px;
    border-radius:5px;
}

</style>

</head>

<body>

<div class="container">

<h1>Edit Profile</h1>

<?php
if($message!=""){
    echo "<div class='success'>$message</div>";
}
?>

<form method="POST">

<label>Full Name</label>
<input type="text" name="fullname" value="<?php echo $user['fullname']; ?>" required>

<label>Email</label>
<input type="email" name="email" value="<?php echo $user['email']; ?>" required>

<label>Phone</label>
<input type="text" name="phone" value="<?php echo $user['phone']; ?>" required>

<button type="submit" name="update">Update Profile</button>

</form>

<br>

<a href="profile.php" class="btn">Back to Profile</a>

</div>

</body>
</html>
