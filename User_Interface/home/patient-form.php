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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.6.2/animate.min.css" rel="stylesheet">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    
    
    <link rel="stylesheet" href="home-style.css">
    <title>Home</title>
   </head>
<body>
  <nav>
    <div class="navbar">
      <i class='bx bx-menu'></i>
      <div class="logo">
        <img src="../image/logo.png" alt="" class="logo1">
        <a href="#carousel-example-generic"> BMHO </a>
     </div>

      <div class="nav-links">
        <div class="sidebar-logo">
          <span class="logo-name">BMHO</span>
          <i class='bx bx-x' ></i>
        </div>
        <ul class="links">

          <li><a href="#carousel-example-generic"> <span>HOME</span> </a></li>

          <!-- ITO YUNG PAG KOKONEK FROM DATABASE-->
          <?php
          include '../../database/config.php';

          $query = mysqli_query($conn, "SELECT * FROM registration WHERE email = '$email'")
          or die('query failed');

          if(mysqli_num_rows($query) > 0) {
            $items = mysqli_fetch_assoc($query); 
          }
          ?>
          <li><a href="../profile/profile-form.php?lastname=<?php echo $items['lastname']?> &firstname=<?php echo $items['firstname']?> &middlename=<?php echo $items['middlename']?> &gender=<?php echo $items['gender']?> &suffix=<?php echo $items['suffix']?> &dob=<?php echo $items['dob'] ?>&age=<?php echo $items['age']?> &contact=<?php echo $items['contact']?> &email=<?php echo $items['email']?> &address=<?php echo $items['address']?> &barangay=<?php echo $items['barangay']?> &img=<?php echo $items['img'] ?>">PROFILE</a></li>
          <!--END HERE-->

          <li>
            <a href="#" class="sidebar-arrow">APPOINTMENT</a>
            <i class='bx bxs-chevron-down htmlcss-arrow arrow  '></i>
            <ul class="htmlCss-sub-menu sub-menu">

              <?php
              include '../../database/config.php';

              $query = mysqli_query($conn, "SELECT * FROM registration WHERE email = '$email'")
              or die('query failed');

              if(mysqli_num_rows($query) > 0) {
                $items = mysqli_fetch_assoc($query); 
              }
              ?>
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
          
          <li><a href="../aboutus/aboutus.php">ABOUT US</a></li>

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
            }
            .modal-dialog{
              width:40%;
            }
            @media screen (max-width:360px){
              .modal-content{
                width:100%;
              }
            }
            
          </style>
          <li><button type="button" class="btn btn2" data-toggle="modal" data-target="#exampleModalCenter">
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
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Logout</h5>
            </div>
            <div class="modal-body">
              Are you sure you want to logout?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <a href="/capstone2/logout.php" type="button" class="btn btn-primary">Logout</a>
            </div>
          </div>
        </div>
      </div>
  <!--IMAGEA-->
  <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
        <div class="item active">
            <div class="banner" style="background-image: url(../image/pic1.jfif);"></div>
            <div class="carousel-caption">
                <h2 class="animated bounceInRight" style="animation-delay: .5s">Balete Municipal Health Office</h2>
                <h3 class="animated bounceInLeft" style="animation-delay: 1s">Poblacion II, Balete Batangas</h3>
            </div>
        </div>
        <div class="item">
         <style>
          .banner{
            height:100vh;
            width: 100%;
          }
          @media (max-width:414px) {
            .banner{
            height:65vh;
            }
          }
          @media (max-width:360px) {
            .banner{
            height:75vh;
            }
          }
         </style>
            <div class="banner" style="background-image: url(../../image/app-bg2.png);"></div>
            <div class="carousel-caption">
                <h2 class="animated slideInDown" style="animation-delay: .5s">Schedule your appointment</h2>
                <h3 class="animated fadeInUp" style="animation-delay: 1s">Absolute care, Every day.</h3>
                <?php
                  include '../../database/config.php';

                  $query = mysqli_query($conn, "SELECT * FROM registration WHERE email = '$email'")
                  or die('query failed');

                  if(mysqli_num_rows($query) > 0) {
                    $items = mysqli_fetch_assoc($query); 
                  }
                ?>
                <p class="animated zoomIn" style="animation-delay: 1.5s"><a href="../request/request-app.php?lastname=<?php echo $items['lastname']?> &firstname=<?php echo $items['firstname']?> &middlename=<?php echo $items['middlename']?> &suffix=<?php echo $items['suffix']?> &age=<?php echo $items['age']?> &gender=<?php echo $items['gender']?> &contact=<?php echo $items['contact']?> &email=<?php echo $items['email']?> &address=<?php echo $items['address']?> &barangay=<?php echo $items['barangay']?>">Click here</a></p>
            </div>
        </div>
        <div class="item">
            <div class="banner" style="background-image: url(../image/about-bg.jpg);"></div>
            <div class="carousel-caption">
                <h2 class="animated zoomIn" style="animation-delay: .5s">About Us</h2>
                <h3 class="animated fadeInLeft" style="animation-delay: 1s">Balete Municipal Health Office</h3>
                <p class="animated zoomIn" style="animation-delay: 1.8s"><a href="../aboutus/aboutus.php">Learn more</a></p>
            </div>
        </div>

    </div>

    <!-- Controls -->
    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>


</header>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>

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
          <a href="" data-toggle="modal" data-target="#exampleModalCenter">Logout</a>
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
  

<script src="home-style.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>