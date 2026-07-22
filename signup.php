<?php
include "config.php";

$message = "";

if(isset($_POST['signup'])){

    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $account = trim($_POST['account']);
    $username = trim($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check username
    $check = $conn->prepare("SELECT id FROM users WHERE username=?");
    $check->bind_param("s",$username);
    $check->execute();
    $check->store_result();

    if($check->num_rows > 0){
        $message = "Username already exists!";
    }else{

        $stmt = $conn->prepare("INSERT INTO users(fullname,email,phone,account_number,username,password)
        VALUES(?,?,?,?,?,?)");

        $stmt->bind_param("ssssss",$fullname,$email,$phone,$account,$username,$password);

        if($stmt->execute()){
            $message = "Account Created Successfully!";
        }else{
            $message = "Something went wrong!";
        }

        $stmt->close();
    }

    $check->close();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>ABC Bank - Sign Up</title>

<style>
body{
font-family:Arial;
background:#f4f7fb;
}

.container{
width:420px;
margin:40px auto;
background:white;
padding:25px;
border-radius:10px;
box-shadow:0 0 10px rgba(0,0,0,.2);
}

input{
width:100%;
padding:12px;
margin:8px 0;
}

button{
width:100%;
padding:12px;
background:#003366;
color:white;
border:none;
cursor:pointer;
}

.success{
background:#d4edda;
color:#155724;
padding:10px;
margin-bottom:10px;
}

.error{
background:#f8d7da;
color:#721c24;
padding:10px;
margin-bottom:10px;
}
</style>

</head>

<body>

<div class="container">

<h2>Create Account</h2>

<?php
if($message!=""){
    if($message=="Account Created Successfully!"){
        echo "<div class='success'>$message</div>";
    }else{
        echo "<div class='error'>$message</div>";
    }
}
?>

<form method="post">

<input type="text" name="fullname" placeholder="Full Name" required>

<input type="email" name="email" placeholder="Email" required>

<input type="text" name="phone" placeholder="Phone Number" required>

<input type="text" name="account" placeholder="Account Number" required>

<input type="text" name="username" placeholder="Username" required>

<input type="password" name="password" placeholder="Password" required>

<button type="submit" name="signup">Create Account</button>

</form>

</div>

</body>
</html>