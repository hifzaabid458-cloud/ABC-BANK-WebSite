<?php
include("config.php");

$success = false;
$error = false;

if(isset($_POST['send'])){

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $subject = trim($_POST['subject']);
    $message = trim($_POST['message']);

    $stmt = $conn->prepare("INSERT INTO contact_messages(name,email,subject,message) VALUES(?,?,?,?)");
    $stmt->bind_param("ssss", $name, $email, $subject, $message);

    if($stmt->execute()){
        $success = true;

        // Clear form after successful submission
        $_POST = array();

    }else{
        $error = true;
    }

}   

?>

<!DOCTYPE html>
<html>
<head>

<title>ABC Bank</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:Arial;
}

body{
background:#f4f6f9;
}

header{

background:#003366;
padding:15px 50px;
display:flex;
justify-content:space-between;
align-items:center;

}

.logo{

color:white;
font-size:28px;
font-weight:bold;

}

nav a{

color:white;
text-decoration:none;
margin-left:25px;
font-size:18px;

}

nav a:hover{

color:gold;

}

.hero{

height:500px;
background:linear-gradient(rgba(0,51,102,.7),rgba(0,51,102,.7)),
url('https://images.unsplash.com/photo-1554224155-6726b3ff858f?w=1600');
background-size:cover;
background-position:center;
display:flex;
justify-content:center;
align-items:center;
flex-direction:column;
color:white;
text-align:center;

}

.hero h1{

font-size:55px;

}

.hero p{

margin-top:20px;
font-size:22px;

}

.btn{

display:inline-block;
margin-top:30px;
padding:15px 35px;
background:gold;
color:#003366;
text-decoration:none;
font-weight:bold;
border-radius:5px;

}

.btn:hover{

background:white;

}
.success{
    background:#d4edda;
    color:#155724;
    border-left:6px solid #28a745;
    padding:18px;
    margin-bottom:20px;
    border-radius:8px;
    font-size:18px;
    font-weight:bold;
    box-shadow:0 4px 10px rgba(0,0,0,.1);
}

.error{
    background:#f8d7da;
    color:#721c24;
    border-left:6px solid #dc3545;
    padding:18px;
    margin-bottom:20px;
    border-radius:8px;
    font-size:18px;
    font-weight:bold;
    box-shadow:0 4px 10px rgba(0,0,0,.1);
}
/* ============================= */
/* Responsive Design */
/* ============================= */

@media (max-width: 992px){

header{
    flex-direction:column;
    text-align:center;
    padding:20px;
}

nav{
    margin-top:15px;
}

nav a{
    display:inline-block;
    margin:8px;
}

.hero{
    height:auto;
    padding:80px 20px;
}

.hero h1{
    font-size:40px;
}

.hero p{
    font-size:18px;
}

}

/* Mobile */

@media (max-width:768px){

.container{
    width:95% !important;
    margin:20px auto !important;
    padding:20px !important;
}

h1{
    font-size:30px !important;
}

h2{
    font-size:28px !important;
}

p{
    font-size:16px !important;
}

table{
    display:block;
    overflow-x:auto;
}

button{
    width:100%;
    margin-top:10px;
}

input,
textarea{
    width:100%;
}

}

/* Small Phones */

@media (max-width:480px){

.logo{
    font-size:22px;
}

.hero h1{
    font-size:28px;
}

.hero p{
    font-size:16px;
}

.btn{
    display:block;
    width:100%;
    text-align:center;
}

}

</style>

</head>

<body>

<header>

<div class="logo">
🏦 ABC BANK
</div>

<nav>

<a href="index.php">Home</a>

<a href="#about">About</a>

<a href="#services">Services</a>

<a href="#team">Team</a>

<a href="#contact">Contact</a>

<a href="signin.php">Sign In</a>

<a href="signup.php">Sign Up</a>

</nav>

</header>

<section class="hero">

<h1>Welcome to ABC Bank</h1>

<p>Secure • Trusted • Modern Banking</p>

<a href="signup.php" class="btn">
Open an Account
</a>

</section>
<!-- About Us Section -->

<section id="about" style="padding:70px 10%; background:white;">

<h2 style="text-align:center; color:#003366; font-size:40px; margin-bottom:20px;">
About ABC Bank
</h2>

<p style="text-align:center; color:gray; font-size:20px; margin-bottom:50px;">
Trusted Banking Partner Since 2010
</p>

<div style="display:flex; justify-content:space-between; align-items:center; gap:50px; flex-wrap:wrap;">

<div style="flex:1; min-width:300px;">

<img src="https://images.unsplash.com/photo-1556740749-887f6717d7e4?w=800"
style="width:100%; border-radius:10px;">

</div>

<div style="flex:1; min-width:300px;">

<h3 style="color:#003366; font-size:32px; margin-bottom:20px;">
Who We Are
</h3>

<p style="font-size:18px; line-height:1.8; color:#555;">

ABC Bank is a trusted financial institution dedicated to providing secure,
fast, and reliable banking services to individuals and businesses.

Our goal is to make banking simple, convenient, and accessible through
modern digital solutions. We offer services including deposits,
withdrawals, money transfers, secure online banking, and account
management while ensuring the highest level of customer satisfaction.

</p>

<br>

<p style="font-size:18px; line-height:1.8; color:#555;">

With advanced security, experienced professionals, and innovative
technology, ABC Bank continues to build lasting relationships with
customers and contribute to financial growth and stability.

</p>

</div>

</div>

</section>
<!-- Services Section -->

<section id="services" style="padding:70px 10%; background:#f4f6f9;">

<h2 style="text-align:center; color:#003366; font-size:40px;">
Our Services
</h2>

<p style="text-align:center; color:gray; margin-top:10px; margin-bottom:50px; font-size:20px;">
We provide secure and reliable banking services for our customers.
</p>

<div style="display:flex; justify-content:space-between; flex-wrap:wrap; gap:25px;">

<!-- Deposit -->

<div style="flex:1; min-width:250px; background:white; padding:30px; border-radius:10px; box-shadow:0 0 10px rgba(0,0,0,.1); text-align:center;">

<h1>💰</h1>

<h3 style="color:#003366;">Deposit Money</h3>

<p style="color:#555; line-height:1.7;">
Deposit money securely into your account anytime with our safe banking system.
</p>

</div>

<!-- Withdraw -->

<div style="flex:1; min-width:250px; background:white; padding:30px; border-radius:10px; box-shadow:0 0 10px rgba(0,0,0,.1); text-align:center;">

<h1>🏧</h1>

<h3 style="color:#003366;">Withdraw Money</h3>

<p style="color:#555; line-height:1.7;">
Withdraw your money quickly and securely with real-time balance updates.
</p>

</div>

<!-- Transfer -->

<div style="flex:1; min-width:250px; background:white; padding:30px; border-radius:10px; box-shadow:0 0 10px rgba(0,0,0,.1); text-align:center;">

<h1>🔄</h1>

<h3 style="color:#003366;">Money Transfer</h3>

<p style="color:#555; line-height:1.7;">
Transfer funds instantly to other ABC Bank users with complete security.
</p>

</div>

<!-- History -->

<div style="flex:1; min-width:250px; background:white; padding:30px; border-radius:10px; box-shadow:0 0 10px rgba(0,0,0,.1); text-align:center;">

<h1>📄</h1>

<h3 style="color:#003366;">Transaction History</h3>

<p style="color:#555; line-height:1.7;">
Track every deposit, withdrawal, and transfer through your transaction history.
</p>

</div>

</div>

</section>
<!-- Achievements Section -->

<section id="achievements" style="padding:70px 10%; background:#003366; color:white;">

<h2 style="text-align:center; font-size:40px;">
Our Achievements
</h2>

<p style="text-align:center; font-size:20px; margin-top:10px; margin-bottom:50px;">
Our journey of trust, excellence, and customer satisfaction.
</p>

<div style="display:flex; justify-content:space-between; flex-wrap:wrap; gap:25px;">

<!-- Customers -->

<div style="flex:1; min-width:220px; background:white; color:#003366; padding:30px; text-align:center; border-radius:10px; box-shadow:0 0 15px rgba(0,0,0,.2);">

<h1 style="font-size:50px;">👥</h1>

<h2 style="font-size:38px;">10,000+</h2>

<h3>Happy Customers</h3>

<p>Serving thousands of satisfied customers across the country.</p>

</div>

<!-- Branches -->

<div style="flex:1; min-width:220px; background:white; color:#003366; padding:30px; text-align:center; border-radius:10px; box-shadow:0 0 15px rgba(0,0,0,.2);">

<h1 style="font-size:50px;">🏦</h1>

<h2 style="font-size:38px;">50+</h2>

<h3>Bank Branches</h3>

<p>Expanding our banking services nationwide.</p>

</div>

<!-- Transactions -->

<div style="flex:1; min-width:220px; background:white; color:#003366; padding:30px; text-align:center; border-radius:10px; box-shadow:0 0 15px rgba(0,0,0,.2);">

<h1 style="font-size:50px;">💳</h1>

<h2 style="font-size:38px;">500K+</h2>

<h3>Transactions</h3>

<p>Secure and successful online banking transactions.</p>

</div>

<!-- Experience -->

<div style="flex:1; min-width:220px; background:white; color:#003366; padding:30px; text-align:center; border-radius:10px; box-shadow:0 0 15px rgba(0,0,0,.2);">

<h1 style="font-size:50px;">⭐</h1>

<h2 style="font-size:38px;">15+</h2>

<h3>Years of Trust</h3>

<p>Providing secure and reliable banking services since 2010.</p>

</div>

</div>

</section>
<!-- Team Section -->

<section id="team" style="padding:80px 10%; background:#f4f6f9;">

<h2 style="text-align:center; color:#003366; font-size:42px;">
Meet Our Team
</h2>

<p style="text-align:center; color:gray; font-size:20px; margin-top:10px; margin-bottom:50px;">
Our experienced professionals are committed to providing secure and reliable banking services.
</p>

<div style="display:flex; justify-content:space-between; flex-wrap:wrap; gap:30px;">

<!-- CEO -->

<div style="flex:1; min-width:250px; background:white; border-radius:12px; text-align:center; padding:30px; box-shadow:0 0 15px rgba(0,0,0,.15);">

<img src="https://randomuser.me/api/portraits/men/32.jpg"
style="width:150px; height:150px; border-radius:50%; object-fit:cover; border:5px solid #003366;">

<h3 style="margin-top:20px; color:#003366;">John Smith</h3>

<h4 style="color:#666;">Chief Executive Officer</h4>

<p style="margin-top:15px; color:#555; line-height:1.7;">
Leading ABC Bank with innovation, integrity, and customer satisfaction.
</p>

</div>

<!-- Manager -->

<div style="flex:1; min-width:250px; background:white; border-radius:12px; text-align:center; padding:30px; box-shadow:0 0 15px rgba(0,0,0,.15);">

<img src="https://randomuser.me/api/portraits/women/44.jpg"
style="width:150px; height:150px; border-radius:50%; object-fit:cover; border:5px solid #003366;">

<h3 style="margin-top:20px; color:#003366;">Sarah Ahmed</h3>

<h4 style="color:#666;">Branch Manager</h4>

<p style="margin-top:15px; color:#555; line-height:1.7;">
Managing customer operations and ensuring excellent banking services.
</p>

</div>

<!-- Finance Officer -->

<div style="flex:1; min-width:250px; background:white; border-radius:12px; text-align:center; padding:30px; box-shadow:0 0 15px rgba(0,0,0,.15);">

<img src="https://randomuser.me/api/portraits/men/68.jpg"
style="width:150px; height:150px; border-radius:50%; object-fit:cover; border:5px solid #003366;">

<h3 style="margin-top:20px; color:#003366;">Ali Khan</h3>

<h4 style="color:#666;">Finance Officer</h4>

<p style="margin-top:15px; color:#555; line-height:1.7;">
Handling financial operations with transparency, security, and accuracy.
</p>

</div>

<!-- IT Administrator -->

<div style="flex:1; min-width:250px; background:white; border-radius:12px; text-align:center; padding:30px; box-shadow:0 0 15px rgba(0,0,0,.15);">

<img src="https://randomuser.me/api/portraits/women/63.jpg"
style="width:150px; height:150px; border-radius:50%; object-fit:cover; border:5px solid #003366;">

<h3 style="margin-top:20px; color:#003366;">Emma Wilson</h3>

<h4 style="color:#666;">IT Administrator</h4>

<p style="margin-top:15px; color:#555; line-height:1.7;">
Maintaining secure digital banking systems and protecting customer information.
</p>

</div>

</div>

</section>
<!-- Contact Section -->

<section id="contact" style="padding:80px 10%; background:#003366; color:white;">

<h2 style="text-align:center; font-size:42px;">
Contact Us
</h2>

<p style="text-align:center; font-size:20px; margin-top:10px; margin-bottom:50px;">
We're here to help. Contact us anytime!
</p>

<div style="display:flex; justify-content:space-between; flex-wrap:wrap; gap:40px;">

<!-- Contact Information -->

<div style="flex:1; min-width:300px;">

<h3 style="margin-bottom:25px;">📍 Our Office</h3>

<p style="font-size:18px; line-height:2;">
<strong>Address:</strong><br>
123 Main Boulevard,<br>
Lahore, Punjab, Pakistan
</p>

<br>

<p style="font-size:18px; line-height:2;">
<strong>Phone:</strong><br>
+92 300 1234567
</p>

<br>

<p style="font-size:18px; line-height:2;">
<strong>Email:</strong><br>
info@abcbank.com
</p>

<br>

<p style="font-size:18px; line-height:2;">
<strong>Working Hours:</strong><br>
Monday - Friday<br>
9:00 AM – 5:00 PM
</p>

</div>

<!-- Contact Form -->

<div style="flex:1; min-width:350px; background:white; padding:30px; border-radius:10px;">
<?php
if(isset($_GET['sent'])){
    echo "<div class='success'>
    ✅ <strong>Message Sent Successfully!</strong><br><br>
    Thank you for contacting <strong>ABC Bank</strong>.<br>
    Our customer support team will contact you as soon as possible.
    </div>";
}

if($error){
    echo "<div class='error'>
    ❌ Something went wrong. Please try again later.
    </div>";
}
?>

<form method="POST" action="#contact">

<input
type="text"
name="name"
placeholder="Your Name"
required
style="width:100%; padding:12px; margin-bottom:15px; border:1px solid #ccc; border-radius:5px;">

<input
type="email"
name="email"
placeholder="Your Email"
required
style="width:100%; padding:12px; margin-bottom:15px; border:1px solid #ccc; border-radius:5px;">

<input
type="text"
name="subject"
placeholder="Subject"
required
style="width:100%; padding:12px; margin-bottom:15px; border:1px solid #ccc; border-radius:5px;">

<textarea
name="message"
rows="6"
placeholder="Your Message"
required
style="width:100%; padding:12px; border:1px solid #ccc; border-radius:5px;"></textarea>

<br><br>

<button
type="submit"
name="send"
style="width:100%; padding:14px; background:#003366; color:white; border:none; border-radius:5px; font-size:18px; cursor:pointer;">
Send Message

</button>

</form>

</div>

</div>

</section>

</body>
</html>