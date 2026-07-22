<?php
session_start();
include "config.php";

$message = "";

if(isset($_POST['login'])){

    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
    $stmt->bind_param("s",$username);
    $stmt->execute();

    $result = $stmt->get_result();

    if($result->num_rows > 0){

        $user = $result->fetch_assoc();

        if(password_verify($password,$user['password'])){

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['fullname'] = $user['fullname'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['balance'] = $user['balance'];

            header("Location: dashboard.php");
            exit();

        }else{
            $message = "Incorrect Password!";
        }

    }else{
        $message = "Username not found!";
    }

}
?>

<!DOCTYPE html>
<html>
<head>
<title>ABC Bank - Sign In</title>

<style>
body{
    font-family:Arial;
    background:#f2f6fc;
}

.login-box{
    width:400px;
    margin:60px auto;
    background:white;
    padding:25px;
    border-radius:10px;
    box-shadow:0 0 10px rgba(0,0,0,.2);
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
    font-size:16px;
}

.message{
    background:#ffe5e5;
    color:#b30000;
    padding:10px;
    margin-bottom:10px;
    border-radius:5px;
}

a{
    text-decoration:none;
}
</style>

</head>

<body>

<div class="login-box">

<h2>Sign In</h2>

<?php
if($message!=""){
    echo "<div class='message'>$message</div>";
}
?>

<form method="POST">

<input type="text" name="username" placeholder="Username" required>

<input type="password" name="password" placeholder="Password" required>

<button name="login">Sign In</button>

</form>

<br>

<p>Don't have an account?
<a href="signup.php">Create Account</a></p>

</div>

</body>
</html>