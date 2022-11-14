<?php

session_start();
error_reporting(0);
// Restrict the user from accessing this page until they are able to login
$email = $_SESSION['txtEmail'];

if(!isset($_SESSION['txtEmail'] ))
{
	header("Location: ../../index.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:wght@300&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    
    <link rel="stylesheet" href="aboutus-style.css">
    <title>About Us</title>
</head>
<body>
    <nav>
        <div class="navbar">
          <i class='bx bx-menu'></i>
          <div class="logo">
            <img src="../image/logo.png" alt="" class="logo1">
            <a href="#home"> BMHO </a>
         </div>
    
          <div class="nav-links">
            <div class="sidebar-logo">
              <span class="logo-name">BMHO</span>
              <i class='bx bx-x' ></i>
            </div>
            <ul class="links">
              <li><a href="../home/patient-form.php">HOME</a></li>

      <?php
          include '../../database/config.php';

          $query = mysqli_query($conn, "SELECT * FROM registration WHERE email = '$email'")
          or die('query failed');

          if(mysqli_num_rows($query) > 0) {
            $items = mysqli_fetch_assoc($query); 
          }
        ?>
          <li><a href="../profile/profile-form.php?lastname=<?php echo $items['lastname']?> &firstname=<?php echo $items['firstname']?> &middlename=<?php echo $items['middlename']?> &gender=<?php echo $items['gender']?> &suffix=<?php echo $items['suffix']?> &dob=<?php echo $items['dob'] ?>&age=<?php echo $items['age']?> &contact=<?php echo $items['contact']?> &email=<?php echo $items['email']?> &address=<?php echo $items['address']?> &barangay=<?php echo $items['barangay']?> &img=<?php echo $items['img'] ?>">PROFILE</a></li>
    
              <li>
                <a href="#" class="sidebar-arrow">APPOINTMENT</a>
                <i class='bx bxs-chevron-down htmlcss-arrow arrow  '></i>

                <?php
                  include '../../database/config.php';

                  $query = mysqli_query($conn, "SELECT * FROM registration WHERE email = '$email'")
                  or die('query failed');

                  if(mysqli_num_rows($query) > 0) {
                    $items = mysqli_fetch_assoc($query); 
                  }
                ?>
                <ul class="htmlCss-sub-menu sub-menu">
                <li><a href="../request/request-app.php?lastname=<?php echo $items['lastname']?> &firstname=<?php echo $items['firstname']?> &middlename=<?php echo $items['middlename']?> &suffix=<?php echo $items['suffix']?> &age=<?php echo $items['age']?> &gender=<?php echo $items['gender']?> &contact=<?php echo $items['contact']?> &email=<?php echo $items['email']?> &address=<?php echo $items['address']?> &barangay=<?php echo $items['barangay']?>">REQUEST APPOINTMENT</a></li>
               
                <?php
                    include '../../database/config.php';

                    $query = mysqli_query($conn, "SELECT * FROM appointment WHERE email = '$email' AND status = 'pending'")
                    or die('query failed');

                    if(mysqli_num_rows($query) == 1) {
                        $items = mysqli_fetch_assoc($query); 
                    }
                  ?>
                <li><a href="../status/my-status.php?reference=<?php echo $items['reference']?> &typeofapp=<?php echo $items['typeofapp']?> &timeofapp=<?php echo $items['timeofapp']?> &dateofapp=<?php echo $items['dateofapp']?>">MY APPOINTMENT (STATUS)</a></li> 
                </ul>
              </li>
              
              <li><a href="#home"><span>ABOUT US</span></a></li>
    
              <?php
              include '../../database/config.php';

              $query = mysqli_query($conn, "SELECT * FROM registration WHERE email = '$email'")
              or die('query failed');

              if(mysqli_num_rows($query) > 0) {
                $items = mysqli_fetch_assoc($query); 
              }
              ?>
              <li><a href="../contactus/contactus.php?lastname=<?php echo $items['lastname']?> &firstname=<?php echo $items['firstname']?> &middlename=<?php echo $items['middlename']?> &email=<?php echo $items['email']?>">CONTACT US</a></li>
    
              <style>
                .btn2{
                  background:none;
                  font-size:18px;
                  border:none !important;
                  outline:none !important;
                  color:white;
                }
              </style>
              <li><button type="button" class="btn btn2" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">
              LOGOUT
              </button></li>
            </ul>
          </div>
    
          <div class="search-box">
            <i class='bx bx-search'></i>
            <div class="input-box">
              <input type="text" placeholder="Search...">
            </div>
          </div>
        </div>
      </nav>

      <!-- Modal -->
      <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Logout</h5>
              </div>
              <div class="modal-body">
                Are you sure you want to logout?
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a href="/capstone2/logout.php" type="button" class="btn btn-primary">Logout</a>
              </div>
            </div>
          </div>
        </div>

      <!--ABOUT US-->
      <section class="home" id="home">

        <div class="container">
     
           <div class="row min-vh-100 align-items-center">
              <div class="content text-center text-md-left">
                 <h3>let us brighten your day</h3>
                 <p>Our health center is ready to give you a quality service, because the health of our fellow citizen is our priority.</p>
                 
                 <?php
                  include '../../database/config.php';

                  $query = mysqli_query($conn, "SELECT * FROM registration WHERE email = '$email'")
                  or die('query failed');

                  if(mysqli_num_rows($query) > 0) {
                    $items = mysqli_fetch_assoc($query); 
                  }
                  ?>
                 <a href="../request/request-app.php?lastname=<?php echo $items['lastname']?> &firstname=<?php echo $items['firstname']?> &middlename=<?php echo $items['middlename']?> &suffix=<?php echo $items['suffix']?> &age=<?php echo $items['age']?> &gender=<?php echo $items['gender']?> &contact=<?php echo $items['contact']?> &email=<?php echo $items['email']?> &address=<?php echo $items['address']?> &barangay=<?php echo $items['barangay']?>" class="link-btn">book an appointment</a>
              </div>
           </div>
     
        </div>
     </section>

     <section class="about" id="">
      <div class="container">
   
         <div class="row align-items-center">
   
            <div class="col-md-6 image">
               <img src="../../image/front.jpg" class="w-100 mb-5 mb-md-0" alt="">
            </div>
   
            <div class="col-md-6 content">
               <span>About us</span>
               <h3>True Healthcare For Your Family</h3>
               <p style="font-size:20px">BMHO are community-based and patient-directed organizations that deliver comprehensive, culturally competent, high-quality primary health care services to the nation's most vulnerable individuals and families, including people experiencing homelessness, agricultural workers, residents of public housing, and veterans.</p>
            </div>
   
         </div>
   
      </div>
   </section>
   <section class="services" id="services">

    <h1 class="heading">Our services</h1>
 
    <div class="box-container container">
 
       <div class="box">
          <img src="../../image/dentist.png" alt="">
          <h3>Dentist</h3>
          <p>A better life starts with a beautiful smile and gentle high quality dental care.</p>
       </div>
 
       <div class="box">
          <img src="../../image/diamond.png" alt="">
          <h3>Pre-marital counseling</h3>
          <p>Make it your goal to create a marriage that feels like the safest place on earth.</p>
       </div>
 
       <div class="box">
          <img src="../../image/prenatal-care.png" alt="">
          <h3>Prenatal</h3>
          <p>Get consultation here throughout your pregnancy. It helps keep you and your future baby healthy.</p>
       </div>
 
       <div class="box">
          <img src="../../image/family.png" alt="">
          <h3>Family planning counseling</h3>
          <p>This will help you and your partner in choosing the method of family planning that best suits for your family.</p>
       </div>
 
       <div class="box">
          <img src="../../image/check-up.png" alt="">
          <h3>General consultation check-up</h3>
          <p>Improve your health, improve your life. Get general consultation check-up</p>
       </div>
 
       <div class="box">
          <img src="../../image/medical-records.png" alt="">
          <h3>Medical Documents </h3>
          <p>If you need medical documents just make an appointment</p>
       </div>
 
    </div>
 </section>

 <!--Footer--> 
 <footer class="footer-distributed">

   <div class="footer-left">
       <h3>BMHO</h3>
 
       <p class="footer-links">
          <?php
            include '../../database/config.php';

            $query = mysqli_query($conn, "SELECT * FROM registration WHERE email = '$email'")
            or die('query failed');

            if(mysqli_num_rows($query) > 0) {
              $items = mysqli_fetch_assoc($query); 
            }
          ?>
           <a href="../profile/profile-form.php?lastname=<?php echo $items['lastname']?> &firstname=<?php echo $items['firstname']?> &middlename=<?php echo $items['middlename']?> &gender=<?php echo $items['gender']?> &suffix=<?php echo $items['suffix']?> &dob=<?php echo $items['dob'] ?>&age=<?php echo $items['age']?> &contact=<?php echo $items['contact']?> &email=<?php echo $items['email']?> &address=<?php echo $items['address']?> &barangay=<?php echo $items['barangay']?> &img=<?php echo $items['img'] ?>">Profile</a>
           |
           <?php
            include '../../database/config.php';

            $query = mysqli_query($conn, "SELECT * FROM registration WHERE email = '$email'")
            or die('query failed');

            if(mysqli_num_rows($query) > 0) {
              $items = mysqli_fetch_assoc($query); 
            }
            ?>
           <a href="../request/request-app.php?lastname=<?php echo $items['lastname']?> &firstname=<?php echo $items['firstname']?> &middlename=<?php echo $items['middlename']?> &suffix=<?php echo $items['suffix']?> &age=<?php echo $items['age']?> &gender=<?php echo $items['gender']?> &contact=<?php echo $items['contact']?> &email=<?php echo $items['email']?> &address=<?php echo $items['address']?> &barangay=<?php echo $items['barangay']?>">Appointment</a>
           |
           <a href="" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">Logout</a>
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
           <p><a href="mailto:baletemho01@gmail.com">baletemho01@gmail.com</a></p>
       </div>
   </div>
 
   <div class="footer-right">
       <p class="footer-company-about">
           <span>Services</span>
           <ul>
             <li> Book an Appointment</li>
             <li> Choose what you want to appoint</li>
             <li> Request for medical documents</li>
           </ul>
       </p>
       <div class="footer-icons">
        <a href="https://www.facebook.com/BaleteBatangasTourism" target="_blank"><i class="fa fa-facebook"></i></a>
        <a href="https://www.baletebatangas.gov.ph" target="_blank"><i class="fa fa-globe"></i></a>
     </div>
   </div>
 </footer>
        
<script src="aboutus.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>