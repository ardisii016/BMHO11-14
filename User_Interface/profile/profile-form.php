<?php
include '../../database/config.php';
session_start();
error_reporting(0);
// Restrict the user from accessing this page until they are able to login
$email = $_SESSION['txtEmail'];

if(!isset($_SESSION['txtEmail'] ))
{
	header("Location: ../../index.php");
}

if(isset($_POST['update_prof'])){
  $file = $_FILES['update_img']['name'];
  $update_lastname = $_POST['update_lastname'];
  $update_firstname = $_POST['update_firstname'];
  $update_middlename = $_POST['update_middlename'];
  $update_dob = $_POST['update_dob'];
  $update_age = $_POST['update_age'];
  $update_address = $_POST['update_address'];
  $update_brgy = $_POST['update_brgy'];
  $update_gender =  $_POST['update_gender'];
  $update_suffix = $_POST['update_suffix'];
  $update_contact = $_POST['update_contact'];

  move_uploaded_file($_FILES['update_img']['tmp_name'], "../../admin_interface/upload/" ."$file");


  if(empty($_FILES['update_img']['name'])) {

    $conn = mysqli_query ($conn, "UPDATE `registration` SET lastname='$update_lastname',firstname='$update_firstname',middlename='$update_middlename',suffix='$update_suffix',gender='$update_gender',dob='$update_dob',age='$update_age',contact='$update_contact',address='$update_address',barangay='$update_brgy' WHERE email = '$email'");
    
    echo '<script>alert("Successfully update!")</script>';
  }
  else if($_FILES['update_img']['name']) {
    $conn = mysqli_query ($conn, "UPDATE `registration` SET lastname ='$update_lastname',firstname='$update_firstname',middlename='$update_middlename',suffix='$update_suffix',gender='$update_gender',dob='$update_dob',age='$update_age',contact='$update_contact',address='$update_address',barangay='$update_brgy',img='$file' WHERE email = '$email'");

    echo '<script>alert("Successfully update!")</script>';
    ?>
    <META HTTP-EQUIV="Refresh" CONTENT ="0">
    <?php
  }

}

if(isset($_POST['change_pass'])) {
  $update_newpass = md5($_POST['update_newpass']);
  $update_pass = md5($_POST['update_pass']);


  if($update_newpass == $update_pass) {

    if(strlen($_POST['update_newpass']) > 11) {
      $conn = mysqli_query($conn , "UPDATE `registration` set password = '$update_newpass', confirmpassword = '$update_pass' WHERE email = '$email'");

      echo '<script>alert("Password has been successfully update!")</script>';
    }
    else {
      echo '<script>alert("Password must be at least 12 characters!")</script>';
    }
  }
  else {
    echo '<script>alert("New Password and Confirm Password does not match!")</script>';
  }
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    
    <link rel="stylesheet" href="profile-style.css">
    <title>Profile</title>
</head>
<body>
    <nav>
        <div class="navbar">
          <i class='bx bx-menu'></i>
          <div class="logo">
            <img src="../image/logo.png" alt="" class="logo1">
            <a href=""> BMHO </a>
         </div>
    
          <div class="nav-links">
            <div class="sidebar-logo">
              <span class="logo-name">BMHO</span>
              <i class='bx bx-x' ></i>
            </div>
            <ul class="links">
              <li><a href="../home/patient-form.php">HOME</a></li>
    
              <li><a href=""><span>PROFILE</span> </a></li>
    
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
                background:none !important;
                font-size:18px;
                color:white;
                border:none !important;
                outline:none !important;
              }
              </style>
            
              <li><button type="button" class="btn btn2" data-bs-toggle="modal" data-bs-target="#exampleModalCenter1">
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
    <div class="modal fade" id="exampleModalCenter1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog qwert" role="document">
          <div class="modal-content" >
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

      <!--PROFILE PAGE-->
<div class="profile-body">
  <div class="left-side">
 
  <div class="row">

    <form action="" method="POST" enctype="multipart/form-data">

    <div class="row-container">

    <style>
      .dp{
        border-radius:100% !important;
        min-height:23vh;
        max-height:23vh;
        border: black solid 2px;
      }
      @media screen and (max-width: 414px){
      .modal-content{
        width:200px !important;
      }
      .row{
        width: 80%;
        height: 67vh;
        margin-top: 100px;
        margin-bottom:10px;
      }
      .row-container{
        margin:5px 0;
      }
      .row-container img{
        height: 65px;
        width: 60%;
        margin: 10px 60px;
      }
      .input-group, input{
        font-size: 12px;
      }
      .horizontal{
      height: 430px;
    }
      
      @media screen and (max-width: 360px){
      .row{
        width: 80%;
        height: 67vh;
        margin-top: 100px;
        margin-bottom:10px;
      }
      .row-container{
        margin:5px 0;
      }
      .row-container img{
        height: 65px;
        width: 60%;
        margin: 10px 60px;
      }
      .input-group, input{
        font-size: 12px;
      }
      .horizontal{
      height: 430px;
    }
    
    }
  }
    </style>
      <img class="dp" name = "dpp" src="<?php echo "../../admin_interface/upload/".$_GET['img']; ?>" width="150" alt="">
      
      <input class="updt_img" type="file" name="update_img" id="s" accept=".jpg, .jpeg, .jfif, .pjpeg, .pjp, .svg, .png">
    </div>
      <div class="input-group">
        <label for="">Last Name:</label>
        <input type="text" name="update_lastname" class="form-control" placeholder="" value="<?php echo trim($_GET['lastname'])?>" style="text-transform:capitalize">
        </div>
        <div class="input-group">
          <label for="">First Name:</label>
          <input type="text" name="update_firstname" class="form-control" placeholder="" value="<?php echo trim($_GET['firstname'])?>" style="text-transform:capitalize">
          </div>
          <div class="input-group">
            <label for="">Middle Name:</label>
            <input type="text" name="update_middlename" class="form-control" placeholder="" value="<?php echo trim($_GET['middlename'])?>" style="text-transform:capitalize">
            </div>

            <div class="input-group">
          <label for="">Suffix:</label>
          <select class="form-control" name="update_suffix">
            <option disabled selected><?php echo $_GET['suffix']?></option>
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

        <div class="input-group">
        <label for="">Gender:</label>
        <select class="form-control" name="update_gender">
          <option disabled selected><?php echo $_GET['gender']?></option>
          <option>Male</option>
          <option>Female</option>
        </select>
        </div>

    
  </div>
</div>

<div class="right-side">
  <div class="horizontal">
    <div class="horizontal-container">
      <h3> Your Profile </h3>
    </div>

    <div class="input-group">
      <label for="">Email:</label>
      <input type="text" id="" name="" class="form-control" placeholder="" value="<?php echo $_GET['email'] ?>" disabled>
    </div>

    <div class="input-group">
          <label for="txtbirthdate">Date of Birth:</label>
          <input class="form-control" id="txtbirthdate" type="date" name="update_dob" onkeyup="getAgeVal(0)" onblur="getAgeVal(0);" value="<?php echo $_GET['dob'] ?>" >
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
          </script>
        <div class="input-group">
          <label for="txtage">Age:</label>
          <input class="form-control" id="txtage" type="text" name="update_age" autocomplete="off" maxlength="3" onkeypress='return event.charCode >=48 && event.charCode <=57' placeholder="" value="<?php echo trim($_GET['age']) ?>">
          </div>

          <div class="input-group">
        <label for="">Contact:</label>
        <input type="text" class="form-control" pattern="(0)\d{0}(9)\d{9}" name="update_contact" id="" maxlength="11" onkeypress='return event.charCode >=48 && event.charCode <=57' value="<?php echo trim($_GET['contact'])?>">
        </div>

    <div class="input-group">
      <label for="">Address:</label>
      <input type="text" id="" name="update_address" class="form-control" style="text-transform:capitalize" value="<?php echo trim($_GET['address'])?>">
  </div>
  <div class="input-group">
    <label for="">Barangay:</label>
    <select class="form-control" name="update_brgy" id="address" value="<?php echo $_GET['barangay'] ?>">
      <option disabled selected><?php echo $_GET['barangay']?></option>
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


        <style>
          .btn-change-pass a {
            float: right;
            padding-right: 10px;
          }
        </style>

        <div class="btn-change-pass">
          <a href="" data-bs-toggle="modal" data-bs-target="#exampleModal">Change Password</a>
        </div>

        <style>
          .modal-content {
            margin-top: 150px !important;
            margin-left: -70px !important;
            width: 680px !important;
          }
          @media screen and (max-width: 414px){
            .modal{
              width:80%;
              margin-left:45px;
            }
            .modal-title{
              padding-left:60px;
            }
            .modal-body{
              width:100%;
              margin-left:0px;
              padding-left:65px;
          
            }
            .modal-body input{
              width:24%;
            }
            .modal-footer{
              margin:0px;
              width:20%;
              margin-left:200px;
              height:100px;
            }
            .modal-footer .btn-secondary, .modal-footer .btn-primary{
              height:25px;
              font-size:10px;
            }
            input .form-control1 {
              margin:0 !important;
            }
            .input-group5{
              width:30%;
            }
          }
          @media screen and (max-width: 360px){
            .modal{
              width:80%;
              margin:25px;
            }
            .modal-title{
              padding-left:60px;
            }
            .modal-body{
              width:100%;
              margin-left:0px;
              padding-left:65px;
            }
            .modal-body input{
              width:24%;
            }
            .modal-footer{
              margin:0px;
              width:20%;
              margin-left:200px;
              height:100px;
            }
            .modal-footer .btn-secondary, .modal-footer .btn-primary{
              height:25px;
              font-size:10px;
            }
            input .form-control1 {
              margin:0 !important;
            }
            .input-group5{
              width:30%;
            }
          }
        </style>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
              </div>
              <div class="modal-body">
                <div class="input-group">
                  <label for="">New password:</label>
                  <input type="password" id="" name="update_newpass" class="form-control1" placeholder="" >
                </div>

                <div class="input-group">
                  <label for="" class="form-control1">Confirm password:</label>
                  <input type="password" id="" name="update_pass" class="form-control1" placeholder="" >
                </div>
                
                <style>
                .input-group label{
                  width:21%;
                }
                .form-control1{
                  width:50%;
                  margin-left:5px!important;
                  display:inline-block !important;
                }
                .input-group5{
                  line-height:1px !important;
                }
                input[type=checkbox], input[type=radio] {
                margin: 5px 21px !important;
                }
                .form-control1 input{
                  border-color:lightgray !important;
                  border-radius: 3px !important;
                }
                
                </style>
                <script>
                  function toogleInput(e) {
                    var list = document.getElementsByClassName('form-control1');
                    for (let item of list) {
                      item.type = e.checked ? 'text' : 'password';
                    }
                  }
                </script>
                <div class="input-group5">
                  <label for="" style="font-weight:bold; margin-left:10px">Show password:</label>
                  <input type="checkbox" onchange="toogleInput(this)" class="form-control2"  style="cursor:pointer">
                  
                </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="change_pass">Update Password</button>
              </div>
            </div>
          </div>
        </div>
        
        <input type="submit" value="SAVE CHANGES" class="input-update" name="update_prof">
        </form>
  </div>
</div>
</div>

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
          <a href="" data-bs-toggle="modal" data-bs-target="#exampleModalCenter1">Logout</a>
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

<script src="profile-style.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>