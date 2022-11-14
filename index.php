<?php
    include 'database/config.php';
    session_start();
    error_reporting(0);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendMail($email,$verifycode)
{
  require 'PHPMailer/src/Exception.php';
  require 'PHPMailer/src/PHPMailer.php';
  require 'PHPMailer/src/SMTP.php';
  require 'database/config.php';

  $mail = new PHPMailer(true);
  try {
        //Server settings
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'baletemho01@gmail.com';                     //SMTP username
        $mail->Password   = 'ymdahmqtfwjzlwiw';                               //SMTP password
        $mail->SMTPSecure = 'ssl';                                   //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('baletemho01@gmail.com', 'Email Verification');
        $mail->addAddress($email);                 //Add a recipient
        $mail->addReplyTo('no-reply@baletemho01.com', 'No reply');

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'This is your email verification link';
        $mail->Body    = "Thanks for registration!
          Click the link below to verify the email address
          <a href='https://localhost/capstone2/verify-email.php?&email=$email&verifycode=$verifycode'> Verify</a>";

        $mail->send();
        return true;
        // echo 'Message has been sent';
    } catch (Exception $e) {
        return false;
    }
}
    
    //CONNECTING TO DATABASE
    if (isset($_POST['submit'])) {
        $generateID = $_POST['generate_id'];
        $lastname = $_POST['lastname'];
        $firstname = $_POST['firstname'];
        $middlename = $_POST['middlename'];
        $suffix = $_POST['suffix'];
        $gender = $_POST['gender'];
        $dob = $_POST['txtbirthdate'];
        $age = $_POST['txtage'];
        $barangay = $_POST['barangay'];
        $address = $_POST['address'];
        $contact = $_POST['contact'];
        $email = $_POST['email'];
        $file = $_FILES['img']['name'];
        $password = md5($_POST['txtPass1']);
        $confirmpassword = md5($_POST['txtPass2']);
        $usertype = $_POST['usertype'];
        $verifycode =bin2hex(random_bytes(16));
        $verified = $_POST['verified'];

        $default = "avat.png";

        //FILE OR PROFILE PHOTO UPLOADING TO FOLDER
        move_uploaded_file($_FILES['img']['tmp_name'], "admin_interface/upload/" ."$file");
    
        $default = "avat.png";
        if(empty($file)){
            $file = $default;
        }

        // PASSWORD SHOULD HAVE A MINIMUM OF 12 CHARACTERS
        if(strlen($_POST['txtPass1']) > 12) {
        
        if($password == $confirmpassword) {
            $sql = "SELECT email FROM registration WHERE email='$email'";
            $result = mysqli_query($conn, $sql);

            if (!$result->num_rows > 0) {
                $sql = "INSERT INTO registration (user_id, lastname, firstname, middlename, suffix, gender, dob, age, contact, email, address, barangay, img, password, confirmpassword, usertype, verifycode, verified)
            VALUES ('$generateID', '$lastname', '$firstname', '$middlename', '$suffix', '$gender', '$dob', '$age', '$contact', '$email', '$address', '$barangay', '$file',  '$password', '$confirmpassword', '$usertype', '$verifycode', '0')";
 
            $result = mysqli_query($conn, $sql);
            if ($result && sendMail($_POST['email'], $verifycode)) {
                echo '<script>alert("We have sent a verification email to your email account\n\nPlease check inbox or spam.")</script>';
                ?>
                <META HTTP-EQUIV="Refresh" CONTENT ="0; URL= http://localhost/capstone2/index.php">

<?php
                } else {
                header("Location: index.php?error1=Something went wrong.");
                exit();
                }

            // $sql2 = "INSERT INTO login (email, password, usertype)
            // VALUES ('$email', '$password', '$usertype')";
            // $result = mysqli_query($conn, $sql2);

                
            }
            else {
                echo '<script>alert("Email Address is already exist\n\nPlease try another email")</script>';
            }
        }
        else {
            echo '<script>alert("Password and Confirm Password does not match!")</script>';
        }   
        }
        else {
            echo '<script>alert("Password must be at least 12 characters!")</script>';
        }
      }

    
      //   LOGIN HERE 
    if (isset($_POST['login'])) {
        $email = $_POST['txtEmail'];
        $password = md5($_POST['txtPass']);

        $sql = "SELECT * FROM `registration` WHERE email='$email' AND password='$password'";
        $result = mysqli_query($conn, $sql);
        $usertypes = mysqli_fetch_assoc($result);

        if ($result) {
            if (mysqli_num_rows($result)==1) {

                if ($usertypes['usertype'] == "admin" && $usertypes['verified'] == "1") 
                {
                    $_SESSION['txtEmail'] = $email;
                    header("Location: admin_interface/home_admin/admin-home.php");
                }
                else if ($usertypes['usertype'] == "user" && $usertypes['verified'] == "1") 
                {
                    $_SESSION['txtEmail'] = $email;
                    header("Location: user_interface/home/patient-form.php");
                }
                else if ($usertypes['usertype'] == "user" && $usertypes['verified'] == "0") 
                {
                    $_SESSION['txtEmail'] = $email;
                    echo '<script>alert("Please check your Email first for verification")</script>';
                }    
            }
            else {
                echo '<script>alert("Incorrect Email or Password!")</script>';
            }
        }
    }

    
//RESET PASSWORD

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;
// use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'database/config.php';

if (isset($_POST['email1']))
{
    // $emailTo = $_POST['email'];
    $email1 = mysqli_real_escape_string($conn, $_POST['email1']);
    $code = uniqid(true);

    $check_email = "SELECT email FROM registration WHERE email='$email1' LIMIT 1";
    $check_email_run = mysqli_query($conn, $check_email);

    if(mysqli_num_rows($check_email_run) > 0)
    {
        $row = mysqli_fetch_array($check_email_run);
        $get_email = $row['email'];

        $query = mysqli_query($conn, "INSERT INTO resetpass (email, code) VALUES ('$get_email', '$code')");

        if(!$query)
        {
            exit("Error");

        } else {
    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'baletemho01@gmail.com';                     //SMTP username
        $mail->Password   = 'ymdahmqtfwjzlwiw';                               //SMTP password
        $mail->SMTPSecure = 'ssl';                                   //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('baletemho01@gmail.com', 'Password Recovery');
        $mail->addAddress($get_email);                 //Add a recipient
        $mail->addReplyTo('no-reply@gmail.com', 'No reply');

        //Content
        $url = "http://" . $_SERVER["HTTP_HOST"] . dirname($_SERVER["PHP_SELF"]) . "/resetpass.php?token=&code=$code";
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Your password reset link';
        $mail->Body    = "You requested a password reset
                            Click <a href='$url'> me.</a>";
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        echo '<script>alert("We have sent a password reset link to your email account\n\nPlease check inbox or spam.")</script>';
        ?>
        <META HTTP-EQUIV="Refresh" CONTENT ="0; URL= http://localhost/capstone2/index.php">

<?php
    } catch (Exception $e) {
        header("Location: index.php?error=Message could not be sent, server time-out please try again.");
        exit();
        // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    exit();
        }


    } else {
        header("Location: index.php?email-not-found=Email not found.");
        exit();
    }  

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <link href="http://fonts.googleapis.com/css?family=Cookie" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.6.2/animate.min.css" rel="stylesheet">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <title>BMHO</title>
</head>

<body>

    <!--NAVIGATION BAR-->
    <div id="home"></div>
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
                .navbar{
                    position: fixed;
                }
                
            @media screen and (max-width: 360px){
                .navbar__container #navbar__logo{
                    padding-bottom:8px;
                    font-size:27px;
                }
                .navbar__container #navbar__logo img{
                    height:50px;
                }
                .navbar__menu.active{
                background: var(--darkblue);
            }
            }
        
            </style>
            <ul class="navbar__menu">
                <li class="navbar__item">
                    <a href="#home" class="navbar__links">Home</a>
                </li>
                <li class="navbar__item">
                    <a href="#about" class="navbar__links">About Us</a>
                </li>

                <li class="navbar__item">
                    <button type="button" class="navbar__btn" id="signin">Sign in</button>
                </li>

                <li class="navbar__item">
                    <button type="button" class="navbar__btn" id="signup">Register</button>
                </li>
            </ul>
        </div>
    </nav>


    <!--IMAGE SLIDER (HOME)-->
    <style>
        #navbar__logo{
            height:10vh;
        }
        .d-block{
            height:100vh;
        }
        .bg-modal{
            z-index:99;
        }
        .bg-modal2{
            z-index:99;
        }
        .forgotpassword-page{
            z-index:99;
        }
        .signup_link{
            margin:15px 0;
        }
        .container2{
            height:82vh
        }
        .container2 h2{
            margin:5px;
        }
        .container2 form{
            min-height: 480px;
            margin:0;
        }
        input .input-group .form-control{
            border:none;
        }
        .brand_logo_container img{
            height:70px;
        }
        
    </style>

<div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active" data-bs-interval="5000">
      <img src="image/bg1.png" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Balete Municipal Health Office</h5>
      </div>
    </div>
    <div class="carousel-item" data-bs-interval="5000">
      <img src="image/rer.png" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
      </div>
    </div>
    <div class="carousel-item" data-bs-interval="5000">
      <img src="image/bg3.png" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Organizational Chart</h5>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>


    
<!-- POPUP LOGIN FORM -->
<div class="bg-modal" id="bg-modal">
    <div class="modal-contents">
        <div class="close">+</div>

        <form class="login-form" method="POST">
        <div class="brand_logo_container">
            <img src="image/logo.png" class="brand_logo" alt="">
        </div>
        <h2>BALETE MUNICIPAL HEALTH OFFICE</h2>
        <div class="input-group">
            <label for="txtEmail">Email</label>
            <input type="email" name="txtEmail" class="form-control" placeholder="email" >
        </div>
        <div class="input-group">
            <label for="txtPass">Password</label>
            <input type="password" id="txtPass" name="txtPass" class="form-control" placeholder="password" >
            <button type="button" id="btnToggle" class="toggle">
                <i id="eyeIcon" class="fa fa-eye"></i>
            </button>
        </div>
        <div class="forgotPass">
			<a id="forgot-password">Forgot your password?</a>	
		</div>

        <button id ="submit" type="submit" name="login">Login</button>

        <div class="signup_link">
            Don't have an Account? <a id="register">Register here</a>
        </div>
        </form>
    </div>
</div>


<!-- POPUP SIGN-UP FORM -->
<div class="bg-modal2">
    <div class="container2">
        <div class="close2">+</div>
            <h2>Registration </h2>

            <form action="" method ="POST" enctype="multipart/form-data">
                <input type="hidden" name="usertype" value="user">
                <input type="hidden" name="generate_id" id="generate" value="">

                <div class="form first">
                    <div class="details personal">
    
                        <div class="fields">
                            <div class="input-field">
                                <label>Last Name</label>
                                <input type="text" placeholder="Enter your last name" style="text-transform:capitalize" name="lastname" required>
                            </div>
                            <div class="input-field">
                                <label>First Name</label>
                                <input type="text" placeholder="Enter your first name" style="text-transform:capitalize" name="firstname" required>
                            </div>
                            <div class="input-field">
                                <label>Middle Name</label>
                                <input type="text" placeholder="Enter your middle name" style="text-transform:capitalize" name="middlename" required>
                            </div>

                            <div class="input-field">
                                <label for= "suffix">Suffix:</label>
                                <select name="suffix" id="suffix" name="suffix" required>
                                    <option disabled selected>Select suffix</option>
                                    <option value="None">None</option>
                                    <option value="Junior">Jr.</option>
                                    <option value="Senior">Sr.</option>
                                    <option value="I">I</option>
                                    <option value="II">II</option>
                                    <option value="III">III</option>
                                    <option value="IV">IV</option>
                                    <option value="V">V</option>
                                </select>
                            </div>
                            <div class="input-field">
                                <label for="gend">Gender</label>
                                <select name="gender" id="gend" required>
                                    <option disabled selected>Select gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <div class="input-field">
                                <label for="txtbirthdate">Date of Birth:</label>
                                <input class="dob" id="txtbirthdate" type="date" name="txtbirthdate" onkeyup="getAgeVal(0)" onblur="getAgeVal(0);" required>
                            </div>
                            <script type="text/javascript">
                                function formatDate(date){
                                var d = new Date(date),
                                month = '' + (d.getMonth() + 1),
                                day = '' + d.getDate(),
                                year = d.getFullYear();
                                
                                if (month.length < 2) month = '0' + month;
                                if (day.length < 2) day = '0' + day;
                                
                                return [year, month, day].join('-');
                                
                                }
                                
                                function getAge(dateString){
                                var birthdate = new Date().getTime();
                                if (typeof dateString === 'undefined' || dateString === null || (String(dateString) === 'NaN')){
                                // variable is undefined or null value
                                birthdate = new Date().getTime();
                                }
                                birthdate = new Date(dateString).getTime();
                                var now = new Date().getTime();
                                // now find the difference between now and the birthdate
                                var n = (now - birthdate)/1000;
                                if (n < 604800){ // less than a week
                                var day_n = Math.floor(n/86400);
                                if (typeof day_n === 'undefined' || day_n === null || (String(day_n) === 'NaN')){
                                // variable is undefined or null
                                return '';
                                }else{
                                return day_n + ' day' + (day_n > 1 ? 's' : '') + ' old';
                                }
                                } else if (n < 2629743){ // less than a month
                                var week_n = Math.floor(n/604800);
                                if (typeof week_n === 'undefined' || week_n === null || (String(week_n) === 'NaN')){
                                return '';
                                }else{
                                return week_n + ' week' + (week_n > 1 ? 's' : '') + ' old';
                                }
                                } else if (n < 31562417){ // less than 24 months
                                var month_n = Math.floor(n/2629743);
                                if (typeof month_n === 'undefined' || month_n === null || (String(month_n) === 'NaN')){
                                return '';
                                }else{
                                return month_n + ' month' + (month_n > 1 ? 's' : '') + ' old';
                                }
                                }else{
                                var year_n = Math.floor(n/31556926);
                                if (typeof year_n === 'undefined' || year_n === null || (String(year_n) === 'NaN')){
                                return year_n = '';
                                }else{
                                return year_n + ' year' + (year_n > 1 ? 's' : '') + ' old';
                                }
                                }
                                }
                                
                                function getAgeVal(pid){
                                var birthdate = formatDate(document.getElementById("txtbirthdate").value);
                                var count = document.getElementById("txtbirthdate").value.length;
                                if (count=='10'){
                                var age = getAge(birthdate);
                                var str = age;
                                var res = str.substring(0, 1);
                                if (res =='-' || res =='0'){
                                document.getElementById("txtbirthdate").value = "";
                                document.getElementById("txtage").value = "";
                                $('#txtbirthdate').focus();
                                return false;
                                }else{
                                document.getElementById("txtage").value = age;
                                }
                                }else{
                                document.getElementById("txtage").value = "";
                                return false;
                                }
                                }


                            
                                // DISABLE FUTURE DATE ON DATE OF BIRTH
                                $(document).ready(function(){

                                var dtToday = new Date();

                                var month = dtToday.getMonth() + 1;
                                var day = dtToday.getDate();
                                var year = dtToday.getFullYear();

                                if(month < 10)
                                    month = '0' + month.toString();
                                if(day < 10)
                                    day = '0' + day.toString();

                                var maxDate = year + '-' + month + '-' + day;    
                                $('#txtbirthdate').attr('max', maxDate);
                                })

                                </script>
                                
                                <div class="input-field">
                                <label for="txtage">Age:</label>
                                <input id="txtage" type="text" name="txtage" autocomplete="off" placeholder="Age" style="cursor:default" readonly>
                                </div>
                                
                            <div class="input-field">
                                <label for= "contact">Contact Number:</label>
                                <input type="text" pattern="(0)\d{0}(9)\d{9}" name="contact" id="contact" placeholder="09*********" maxlength="11" onkeypress='return event.charCode >=48 && event.charCode <=57' required>
                            </div>

                            <script>

                            $("#contact").mask("0999-999-9999");

                            </script>

                            <div class="input-field">
                                <label>Email</label>
                                <input type="text" placeholder="Enter your email" name="email" required>
                            </div>
    
                            <div class="input-field">
                                <label>Address</label>
                                <input type="text" placeholder="House No./Street/Apartment" style="text-transform:capitalize"name="address" required>
                            </div>
                            <div class="input-field">
                                <label for= "address">Barangay:</label>
                                <select id="address" name="barangay" required>
                                    <option disabled selected>Select Barangay</option>
                                    <option value="Alangilan">Alangilan</option>
                                    <option value="Calawit">Calawit</option>
                                    <option value="Looc">Looc</option>
                                    <option value="Magapi">Magapi</option>
                                    <option value="Makina">Makina</option>
                                    <option value="Malabanan">Malabanan</option>
                                    <option value="Paligawan">Paligawan</option>
                                    <option value="Palsara">Palsara</option>
                                    <option value="Poblacion1">Poblacion 1</option>
                                    <option value="Poblacion2">Poblacion 2</option>
                                    <option value="Sala">Sala</option>
                                    <option value="Sampalocan">Sampalocan</option>
                                    <option value="San Sebastian">San Sebastian</option>
                                    <option value="Solis">Solis</option>
                                </select>
                            </div>
                            <div class="input-field">
                                <label for="img">Profile photo:</label>
                                <input type="file" name="img" id="" accept=".jpg, .jpeg, .png" value="image/userpf.png" >
                            </div>

                            <div class="input-field">
                                <label>Password:</label>
                                <input type="password" id="txtPass1" name="txtPass1" class="form-control1" placeholder="Password" required>
                                
                            </div>
                            <div class="input-field">
                                <label>Confirm Password:</label>
                                <input type="password" id="txtPass2" name="txtPass2" class="form-control1" placeholder="Confirm password" required>
                               
                            <style>
                            .form-control2{
                                position:absolute;
                                bottom:-29px;
                                right:333px;
                                cursor:pointer;
                            }
                            .form-control3{
                                cursor:pointer;
                            }
                            .form-control2:focus{
                                display:none;
                            }
                            @media screen and (max-width: 360px){
                                .form-control2{
                                bottom:59px;
                                right:10px;
                            }
                            .form-control3{
                                margin-left:7px;
                            }
                            }
                            </style>
                            <div class="input-field" style="height:1vh; margin:0; width:50%; margin-left:173px">
                            <label for="checkk" class="form-control3">Show password:</label> 
                            <input type="checkbox" id="checkk" onchange="toogleInput(this)" class="form-control2">
                            </div>
                            
                            </div>

                            <div class="input-field">
                                <button class="reg" id="register" name="submit">Register</button>  
                            </div>
            
                            <div class="signin-link"> 
                                Already have an account? <br> <a id="login" >Sign in</a>
                            </div>
                            
                            <script>
                                function toogleInput(e) {
                                  var list = document.getElementsByClassName('form-control1');
                                  for (let item of list) {
                                    item.type = e.checked ? 'text' : 'password';
                                  }
                                }
                            </script>
                            
                    </div>
                </div>
            </form>
        </div>    
    </div>
</div>

<!-- FORGOT PASSWORD -->
    <div class="forgotpassword-page">
        <div class="forgotpassword-container">
            <div class="close3">+</div>
            <form class="forgotpassword-form" action="" method="POST">
                <div class="brand_logo_container">
                    <img src="image/logo.png" class="brand_logo" alt="">
                </div>
                <h2>BALETE MUNICIPAL HEALTH OFFICE</h2>
                <h3>Forgot Password?</h3>
                <div class="forgot-input-group">
                    <label>Email</label>
                    <input type="email" name="email1" placeholder="enter your email" required>
                </div>
        
                <input type="submit" name="sendcode" class="resetpassbtn" value="Send Link">
                
                <div class="forgotPass-main">
                    Remembered your account? <a id="backtologin">Go back to Login</a>	
                </div>
            </form>

        </div>
    </div>

    <style>
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
    margin:0;
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
    </style>
<!-- SEND CODE -->
 

<style>
    @media (max-width:414px) {
        .navbar__links, .navbar__btn{
            font-size:20px;
        }
        .navbar__menu.active{
            height:42vh;
            padding:0;
        }
        .form-control2{
            bottom:60px;
            right:38px;
        }
        .form-control3{
            width:160px;
          margin-left:15px;  
        }
        .container2{
            height:60vh;
        }
        .d-block{
            height:55vh;
        }
        #navbar__logo{
            height:7vh;
        }
   #about{
    height:190vh;
   }
    .services{
        flex-direction: column;
        width:100%;
        align-items:center;
        display:block;
    }
}
    @media (max-width:360px) {
    .fields{
        width:90%;
    }
    .navbar__links, .navbar__btn{
        font-size:20px;
    }
    .navbar__menu.active{
        padding:0;
        height:50vh;
    }
    #navbar__logo{
        margin-top:8px;
    }
   #about{
    height:230vh;
   }
   .signin-link{
    right:40px;
    font-size:13px;
   }
   .signin-link a{
    font-size:13px;
   }
   .form-control2{
        bottom:58px;
        right:31px;
        }
   .form-control3{
        width:160px;
        margin-left:10px;  
    }
   .container2{
        height:71vh;
    }
    .services{
        flex-direction: column;
        width:100%;
        align-items:center;
        display:block;
    }
    }
    .services{
        height:90vh;
        height:90vh;
    }
    
</style>
    <!-- About us -->
    <div class="services" id="about">
    <div class="box-container">
        <div class="box-item">
            <div class="flip-box">
                <div class="flip-box-front text-center"
                    style="background-image: url(image/mission.png);">
                    <div class="inner color-white">
                        <img src="https://s25.postimg.cc/65hsttv9b/cta-arrow.png" alt="arrow" class="flip-box-img">
                    </div>
                </div>
                <div class="flip-box-back text-center" style="background-image:url(image/flippedd.png);">
                    <div class="">
                        <!-- Button trigger modal -->
                        <button type="button" class="flip-box-button" data-bs-toggle="modal" data-bs-target="#exampleModalLong">Mission</button>
                    </div>
                </div>
            </div>
        </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">           
            </div>
            <div class="modal-body" style="text-align:center">
            <h3>MISSION</h3>
            THE MUNICIPAL HEALTH SERVICES OF BALETE SHALL RENDER EFFECTIVE MEDICAL AND DENTAL SERVICES </br> TO ALL ITS CONSTITUENTS IN ORDER TO PROMOTE SOCIAL AND MENTAL WELLBEING; LIKEWISE, IT WILL ALSO FOCUS ON ERADICATION AND PREVENTION OF POTENTIAL PATHOGENS CAUSING DISEASES TOWARD THE REALIZATION OF GOVERNMENT SHARED VISION.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
        </div>

        <div class="box-container">
        <div class="box-item">
            <div class="flip-box">
                <div class="flip-box-front text-center"
                    style="background-image: url(image/vision.png);">
                    <div class="inner color-white">
                        <img src="https://s25.postimg.cc/65hsttv9b/cta-arrow.png" alt="arrow" class="flip-box-img">
                    </div>
                </div>
                <div class="flip-box-back text-center"
                    style="background-image:url(image/flippedd2.png);">
                    <div class="">                       
                    <button type="button" class="flip-box-button" data-bs-toggle="modal" data-bs-target="#exampleModalLong2">Vision</button>
                    </div>
                </div>
            </div>
        </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModalLong2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">         
            </div>
            <div class="modal-body" style="text-align:center">
            <h3>VISION</h3>
            BALETE, A GOD LOVING MUNICIPALITY SHALL BE A TOURISM HAVEN. A SOCIO ECONOMICALLY PROGRESSIVE AND SAFE WHOSE NATURAL RESOURCES AND ENVIRONMENT ARE CONSERVED FOR THE SUSTENANCE OF ITS PRESENCE AND FUTURE GENERATION.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
        </div>

        <div class="box-container">
        <div class="box-item">
            <div class="flip-box">
                <div class="flip-box-front text-center"
                    style="background-image: url(image/core.png);">
                    <div class="inner color-white">
                        <img src="https://s25.postimg.cc/65hsttv9b/cta-arrow.png" alt="arrow" class="flip-box-img">
                    </div>
                </div>
                <div class="flip-box-back text-center"
                    style="background-image:url(image/flippedd3.png);">
                    <div class="">
                    <button type="button" class="flip-box-button" data-bs-toggle="modal" data-bs-target="#exampleModalLong3">HISTORY</button>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModalLong3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body" style="text-align:center">
            <h3>HISTORY</h3>
            Balete was a former barrio of the City of Lipa. Based on the stories handed down by old folks, BALETE trees were very abundant in this place during the early days when there were still few settlers therein. <br/> On June 21, 1969 the Congress of the Philippines enacted Republic Act No. 5659 creating Balete into a municipality with 13 barangays comprising it namely: Alangilan, Calawit, Looc, San Sebastian, Solis, Makina, Sala, Sampalocan, Magapi, Malabanan, Paligawan, Palsara & Poblacion.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
        </div>

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
            <a href="https://maps.google.com/?q=Balete Municpal Health Center" target="_blank"><p><span>Poblacion II, Balete,</span>
                Batangas</p></a>
            
              
        </div>
        <div>
            <i class="fa fa-phone"></i>
            <p><a href="tel:+639319594014">+639-319-5940-14</a></p>
        </div>
        <div>
            <i class="fa fa-envelope"></i>
            <p><a href="mailto:baletemho01@gmail.com">baletemho01@gmail.com</a></p>
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
            <a href="https://www.facebook.com/BaleteBatangasTourism" target="_blank"><i class="fa fa-facebook"></i></a>
            <a href="https://www.baletebatangas.gov.ph" target="_blank"><i class="fa fa-globe"></i></a>
        </div>
    </div>
  </footer>

</body>

<script src="app.js"></script>
<script src='resetpass.js'></script>
<script src='generate_id.js'></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>

</html>