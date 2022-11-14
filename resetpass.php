<?php
    include 'database/config.php';
    session_start();
    error_reporting(0);

    if (!isset($_GET['code']))
{
    exit("Can't find the page.");
}

$code = $_GET['code'];

$getEmailQuery = mysqli_query($conn, "SELECT email FROM resetpass WHERE code='$code'");
if (mysqli_num_rows($getEmailQuery) == 0)
{
    exit("Can't find the page.");
}

if (isset($_POST['submit'])) {
    $password = md5($_POST['password']);
    $cpassword = md5($_POST['cpassword']);

    $row = mysqli_fetch_array($getEmailQuery);
    $email = $row["email"];

    if(strlen($_POST['password']) < 12){
        echo '<script>alert("Password must be at least 12 characters!\n\nPlease try again.")</script>';
        ?>
         <META HTTP-EQUIV="Refresh" CONTENT ="0">
        <?php
        exit();
    }

    if($password == $cpassword){

    $query = mysqli_query($conn, "UPDATE registration SET password='$password' WHERE email='$email'");

    if ($query) {
        $query = mysqli_query($conn, "DELETE FROM resetpass WHERE email='$email'");
        echo('Your password has been updated successfully <a href="index.php"> login.');
        exit();
    } else {
        exit("Something went wrong.");
    }

    }
    else {
        echo '<script>alert("Password and Confirm password does not match!\n\nPlease try again.")</script>';
    ?>
        <META HTTP-EQUIV="Refresh" CONTENT ="0">
<?php
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style2.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <link href="http://fonts.googleapis.com/css?family=Cookie" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>BMHO</title>
</head>

<body>

    <!--NAVIGATION BAR-->
<div class="homepage" id="home">BMHO</div>
    <nav class="navbar">
        <div class="navbar__container">
            <a href="#home" id="navbar__logo">
              <img src="image/logo.png"> BMHO
            </a>
            <div class="navbar__toggle" id="mobile-menu">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
            <style>
            @media screen and (max-width: 360px){
                .navbar__menu.active{
                background: var(--darkblue);
            }
            }
        
            </style>
            <ul class="navbar__menu">
               <H2>RESET PASSWORD</H2>
            </ul>
        </div>
    </nav>

    <style>
.navbar__menu{
    color: white;
}
.forgotpassword-page2 {
  background-color: rgba(0, 0, 0, 0.7);
  width: 100%;
  height: 100%;
  position: fixed;
  top: 0;
  justify-content: center;
  align-items: center;
  margin-top: 40px;
  display: none;
}
.forgotpassword-container2 {
  height: 450px;
  width: 430px;
  background-color: white;
  padding: 20px;
  position: relative;
  border-radius: 4px;
}
.forgotpassword-form2{
  background: rgba(0, 0, 0, 0.08);
  margin: 0;
  max-width: 400px;
  max-height: 410px;
  padding: 45px 35px;
  border-radius: 4px;
}
.forgotpassword-form2 h2{
  margin-bottom: .75rem;
  color: var(--black);
  margin-top: -30px;
  text-align: center;
  font-size: 20px;
}
.forgotpassword-form2 h3{
  margin-top: 10px;
}
.forgot-input-group{
  margin-top: 1rem;
  margin-bottom: .25rem;
  position: relative;
  width: 100%;
  font-weight: bold;
}
.forgot-input-group input:focus{
  outline: none;
  box-shadow: 0 3px 6px rgba(0,0,0,0.13);
}
.forgotPass-main{
	margin: 20px 0 20px 5px;
	color: black;
  font-size: 14px;
}

.forgotPass-main a{
	font-weight: 600;
	color: black;
  cursor: pointer;
	text-decoration: none;
}

.forgotPass-main a:hover{
	text-decoration: underline;
}
.resetpassbtn{
font-weight: bold;
  margin: 15px 0;
  padding: 10px 20px;
  border-radius: 25px;
  border:none;
  cursor: pointer;
  background: #41b0b0;
  transition:0.3s
}
.resetpassbtn:hover{
    background: #72c9e0;
}
.close5 {
  position: absolute;
  top: -9px;
  right: 1px;
  font-size: 42px;
  color: #333;
  transform: rotate(45deg);
  cursor: pointer;
}
.close5:hover{
  color: #666;
}
.forgotpassword-page5{
    float: center !important;
    margin:auto;
    padding:auto;
}

</style>


<!--RESET PASSWORD PAGE-->
    <div class="forgotpassword-page5">
        <div class="forgotpassword-container1">

            <form class="forgotpassword-form1" method="POST">
                <div class="brand_logo_container">
                    <img src="image/logo.png" class="brand_logo" alt="">
                </div>
                <h2>BALETE MUNICIPAL HEALTH OFFICE</h2>
                <h3>Reset Password</h3>
                <div class="forgot-input-group1">
                    <label>New Password</label>
                    <input id= "resetpass3" type="password" name="password" placeholder="enter your new password" >
                    <button type="button" id="btnToggle3" class="toggle3">
                        <i id="eyeIcon3" class="fa fa-eye"></i>
                    </button>
                </div>
                <div class="forgot-input-group2">
                    <label>Confirm Password</label>
                    <input id= "resetpass4" type="password" name="cpassword" placeholder="enter your confirm password" >
                    <button type="button" id="btnToggle4" class="toggle4">
                        <i id="eyeIcon4" class="fa fa-eye"></i>
                    </button>
                </div>
        
                <button id ="" type="submit" name="submit" class="resetpassbtn1">Reset Password</button>
            </form>

        </div>
    </div>

    <script>
    //RESET PASSWORD SHOW PASS//
let passwordInput3 = document.getElementById('resetpass3'),
    toggle3 = document.getElementById('btnToggle3'),
    icon3 = document.getElementById('eyeIcon3');

function togglePassword3(){
    if (passwordInput3.type === 'password'){
        passwordInput3.type = 'text';
        icon3.classList.add("fa-eye-slash");
    }
    else{
        passwordInput3.type = 'password';
        icon3.classList.remove("fa-eye-slash");
    }
}

function checkInput3(){
}
toggle3.addEventListener('click', togglePassword3, false);
passwordInput3.addEventListener('keypup', checkInput3, false);

// 2nd eye

let passwordInput4 = document.getElementById('resetpass4'),
    toggle4 = document.getElementById('btnToggle4'),
    icon4 = document.getElementById('eyeIcon4');

function togglePassword4(){
    if (passwordInput4.type === 'password'){
        passwordInput4.type = 'text';
        icon4.classList.add("fa-eye-slash");
    }
    else{
        passwordInput4.type = 'password';
        icon4.classList.remove("fa-eye-slash");
    }
}

function checkInput4(){
}
toggle4.addEventListener('click', togglePassword4, false);
passwordInput4.addEventListener('keypup', checkInput4, false);
</script>


    <!--Footer--> 
<footer class="footer-distributed">

    <div class="footer-left">
        <h3>BMHO</h3>
  
        <p class="footer-links">
            <a href="#home">Home</a>
            |
            <a href="#about">About</a>
        </p>
  
        <p class="footer-company-name">Copyright © 2022. All rights reserved</p>
    </div>
  
    <div class="footer-center">
        <div>
            <i class="fa fa-map-marker"></i>
            <a href="https://maps.google.com/?q=Balete Municpal Health Center" target="_blank"><p><span>Poblacion, Balete,</span>
                Batangas</p></a>
            
              
        </div>
        <div>
            <i class="fa fa-phone"></i>
            <p><a href="tel:+639319594014">+63 9319594014</a></p>
        </div>
        <div>
            <i class="fa fa-envelope"></i>
            <p><a href="mailto:sagar00001.co@gmail.com">baletemho@gmail.com</a></p>
        </div>
    </div>

    <div class="footer-right">
        <p class="footer-company-about">
            <span>Services</span>
            <ul>
              <li> &#8226; Book an Appointment</li>
              <li> &#8226; Choose what you want to appoint</li>
              <li> &#8226; Request for medical documents</li>
            </ul>
        </p>
        <div class="footer-icons">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
        </div>
    </div>
  </footer>

</body>

<script src="app.js"></script>

</html>