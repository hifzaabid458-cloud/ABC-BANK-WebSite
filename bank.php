<?php
include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ABC Bank - Professional Banking System</title>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial, sans-serif;
}

html{
    scroll-behavior:smooth;
}

body{
    background:#f4f6f9;
}

/* Navigation Bar */
nav{
    background:#003366;
    color:white;
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:15px 50px;
    position:sticky;
    top:0;
}

.logo{
    display:flex;
    align-items:center;
    gap:10px;
}

.logo img{
    width:50px;
}

nav ul{
    display:flex;
    list-style:none;
}

nav ul li{
    margin-left:20px;
}

nav ul li a{
    color:white;
    text-decoration:none;
    font-weight:bold;
}

nav ul li a:hover{
    color:#ffd700;
}

/* Hero Section */
.hero{
    text-align:center;
    color:white;
    padding:80px 20px;
    background:linear-gradient(135deg,#003366,#007BFF);
}

.hero img{
    width:80%;
    max-width:700px;
    border-radius:15px;
    margin-top:20px;
    box-shadow:0 5px 15px rgba(0,0,0,0.3);
}

.hero h1{
    font-size:45px;
}

.hero p{
    margin-top:10px;
    font-size:20px;
}

/* Sections */
section{
    padding:50px;
}

h2{
    text-align:center;
    margin-bottom:20px;
    color:#003366;
}

/* About */
.about{
    background:white;
    border-radius:10px;
    padding:30px;
    box-shadow:0 0 10px rgba(0,0,0,0.1);
}

/* Stats */
.stats{
    display:flex;
    justify-content:space-around;
    flex-wrap:wrap;
    gap:20px;
}

.stat{
    background:white;
    padding:30px;
    width:250px;
    text-align:center;
    border-radius:10px;
    box-shadow:0 0 10px rgba(0,0,0,0.1);
}

.stat h1{
    color:#007BFF;
}

/* Services */
.services{
    display:flex;
    justify-content:center;
    flex-wrap:wrap;
    gap:20px;
}

.card{
    background:white;
    width:250px;
    padding:20px;
    border-radius:10px;
    text-align:center;
    box-shadow:0 0 10px rgba(0,0,0,0.1);
}

.card:hover{
    transform:translateY(-5px);
    transition:0.3s;
}

/* Bank Management */
.bank-box{
    max-width:600px;
    margin:auto;
    background:white;
    padding:25px;
    border-radius:10px;
    box-shadow:0 0 10px rgba(0,0,0,0.1);
}

input, button{
    width:100%;
    padding:12px;
    margin-top:10px;
}

button{
    background:#007BFF;
    color:white;
    border:none;
    cursor:pointer;
}

button:hover{
    background:#0056b3;
}

#accountInfo{
    margin-top:15px;
    padding:15px;
    background:#eef4ff;
    border-radius:5px;
}

/* Team */
.team{
    display:flex;
    justify-content:center;
    gap:30px;
    flex-wrap:wrap;
}

.member{
    background:white;
    padding:20px;
    text-align:center;
    border-radius:10px;
    box-shadow:0 0 10px rgba(0,0,0,0.1);
}

.member img{
    width:120px;
    height:120px;
    border-radius:50%;
}

/* Contact */
.contact{
    max-width:600px;
    margin:auto;
    background:white;
    padding:25px;
    border-radius:10px;
    box-shadow:0 0 10px rgba(0,0,0,0.1);
}

textarea{
    width:100%;
    padding:10px;
    margin-top:10px;
}

/* Footer */
footer{
    background:#003366;
    color:white;
    text-align:center;
    padding:20px;
}
.member img{
    width:140px;
    height:140px;
    border-radius:50%;
    object-fit:cover;
    border:4px solid #003366;
    margin-bottom:15px;
}

.member{
    background:#fff;
    padding:25px;
    border-radius:15px;
    text-align:center;
    box-shadow:0 8px 20px rgba(0,0,0,0.15);
    transition:0.3s;
}

.member:hover{
    transform:translateY(-8px);
}
.auth-buttons button{width:auto;margin-left:10px;padding:8px 15px;border:none;border-radius:5px;background:#FFD700;color:#003366;font-weight:bold}
.login-popup{display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,.5)}
.login-content{width:350px;background:#fff;margin:120px auto;padding:25px;border-radius:10px}
</style>
</head>
<div id="loginBox" class="login-popup">

    <div class="login-content">

        <span onclick="closeLogin()" class="close">&times;</span>

        <h2>Sign In</h2>

        <input type="text" id="username" placeholder="Username">

        <input type="password" id="password" placeholder="Password">

        <button onclick="login()">Login</button>

    </div>

</div>

<body>

<nav>
    <div class="logo">
        <img src="https://cdn-icons-png.flaticon.com/512/2830/2830284.png">
        <h2>ABC Bank</h2>
    </div>

    <ul>
        <li><a href="#home">Home</a></li>
        <li><a href="#about">About</a></li>
        <li><a href="#services">Services</a></li>
        <li><a href="#bank">Banking</a></li>
        <li><a href="#contact">Contact</a></li>
    </ul><div class="auth-buttons"><button onclick="showLogin()">Sign In</button><button onclick="logout()">Sign Out</button></div></nav>

<section class="hero" id="home">
    <h1>Welcome to ABC Bank</h1>
    <p>Secure • Fast • Reliable Banking Solutions</p>

    <img src="https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?w=1200" alt="Bank">
</section>

<section id="about">
    <h2>About Us</h2>

    <div class="about">
        <p>
            ABC Bank is committed to providing secure, innovative,
            and customer-focused banking services. Our mission is
            to help individuals and businesses achieve financial
            success through trusted banking solutions.
        </p>
    </div>
</section>

<section>
    <h2>Our Achievements</h2>

    <div class="stats">
        <div class="stat">
            <h1>1M+</h1>
            <p>Customers</p>
        </div>

        <div class="stat">
            <h1>500+</h1>
            <p>Branches</p>
        </div>

        <div class="stat">
            <h1>$10B+</h1>
            <p>Transactions</p>
        </div>
    </div>
</section>

<section id="services">
    <h2>Our Services</h2>

    <div class="services">
        <div class="card">
            <h3>Online Banking</h3>
            <p>Manage your account anytime.</p>
        </div>

        <div class="card">
            <h3>Money Transfer</h3>
            <p>Fast and secure transfers.</p>
        </div>

        <div class="card">
            <h3>Loan Services</h3>
            <p>Affordable loans for everyone.</p>
        </div>

        <div class="card">
            <h3>Mobile Banking</h3>
            <p>Bank directly from your phone.</p>
        </div>
    </div>
</section>

<section id="bank">
    <h2>Bank Management System</h2>

    <div class="bank-box">

        <input type="number" id="accNo" placeholder="Account Number">

        <input type="text" id="name" placeholder="Account Holder Name">

        <input type="number" id="balance" placeholder="Initial Balance">

        <button onclick="createAccount()">Create Account</button>

        <div id="accountInfo">No Account Created Yet</div>

        <input type="number" id="amount" placeholder="Enter Amount">

        <button onclick="deposit()">Deposit</button>

        <button onclick="withdraw()">Withdraw</button>

    </div>
</section>


	<section>
    <h2>Management Team</h2>

    <div class="team">

        <div class="member">
            <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?w=300" alt="Chief Executive Officer">
            <h3>Mr. James Anderson</h3>
            <p>Chief Executive Officer (CEO)</p>
        </div>

        <div class="member">
            <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=300" alt="Operations Manager">
            <h3>Ms. Emily Carter</h3>
            <p>Operations Manager</p>
        </div>

        <div class="member">
            <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=300" alt="Finance Director">
            <h3>Mr. Michael Brown</h3>
            <p>Finance Director</p>
        </div>

    </div>
</section> 
<section id="contact">
    <h2>Contact Us</h2>

    <div class="contact">

        <input type="text" placeholder="Your Name">
               <input type="email" placeholder="Your Email">

        <textarea rows="5" placeholder="Your Message"></textarea>

        <button onclick="sendMessage()">Send Message</button>

<script>
function sendMessage() {
    alert("Message submitted successfully!");
}
</script>

    </div>
</section>

<footer>
    <p>© 2026 ABC Bank. All Rights Reserved.</p>
</footer>

<script>
let account = {
    accountNumber:"",
    name:"",
    balance:0
};

function createAccount(){

    account.accountNumber =
    document.getElementById("accNo").value;

    account.name =
    document.getElementById("name").value;

    account.balance =
    parseFloat(document.getElementById("balance").value) || 0;

    displayAccount();
}

function displayAccount(){

    document.getElementById("accountInfo").innerHTML =
    `
    <h3>Account Details</h3>
    <p><strong>Account Number:</strong> ${account.accountNumber}</p>
    <p><strong>Name:</strong> ${account.name}</p>
    <p><strong>Balance:</strong> $${account.balance.toFixed(2)}</p>
    `;
}

function deposit(){

    let amount =
    parseFloat(document.getElementById("amount").value);

    if(amount > 0){

        account.balance += amount;

        displayAccount();
    }
    else{
        alert("Enter a valid amount");
    }
}

function withdraw(){

    let amount =
    parseFloat(document.getElementById("amount").value);

    if(amount > 0){

        if(account.balance >= amount){

            account.balance -= amount;

            displayAccount();
        }
        else{
            alert("Insufficient Funds");
        }
    }
}
function showLogin(){document.getElementById("loginBox").style.display="block";}
function closeLogin(){document.getElementById("loginBox").style.display="none";}
function login(){alert("Login Successful");closeLogin();}
function logout(){alert("Logged Out");}
</script></body>
</html>78