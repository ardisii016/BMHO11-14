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

    $conn = mysqli_query ($conn, "UPDATE `registration` SET lastname = '$update_lastname', firstname = '$update_firstname', middlename = '$update_middlename', suffix = '$update_suffix', gender = '$update_gender', dob = '$update_dob', age = '$update_age', contact = '$update_contact', address = '$update_address', barangay = '$update_brgy' WHERE email = '$email'");
    
    echo '<script>alert("Successfully update!")</script>';
  }
  else if($_FILES['update_img']['name']) {
    $conn = mysqli_query ($conn, "UPDATE `registration` SET lastname = '$update_lastname', firstname = '$update_firstname', middlename = '$update_middlename', suffix = '$update_suffix', gender = '$update_gender', dob = '$update_dob', age = '$update_age', contact = '$update_contact', address = '$update_address', barangay = '$update_brgy', img = '$file'  WHERE email = '$email'");

    echo '<script>alert("Successfully update!")</script>';
  }
}

if(isset($_POST['change_pass'])) {
  $update_newpass = md5($_POST['update_newpass']);
  $update_pass = md5($_POST['update_pass']);


  if($update_newpass == $update_pass) {

    if($update_newpass && $update_pass >= 12) {
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

    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
   

    <link rel="stylesheet" href="adminprof-style.css">
    <title>User Account</title>
</head>
<body>
    <div class="sidebar">
        <div class="logo-details">
            <img src="../image/logo.png" alt="" class="logo">
          <span class="logo_name">BMHO</span>
        </div>
          <ul class="nav-links">
            <li>
              <a href="../home_admin/admin-home.php" >
                <i class='bx bx-grid-alt' ></i>
                <span class="links_name">Home</span>
              </a>
            </li>

            <li>
                <a href="../todayssched/todayssched.php">
                  <i class='bx bx-calendar-check' ></i>
                  <span class="links_name">Today's Schedule</span>
                </a>
              </li>

            <li>
              <a href="../listofapp/listofappointment.php">
                <i class='bx bx-list-ul' ></i>
                <span class="links_name">Future Appointment</span>
              </a>
            </li>

            <li>
              <a href="../doneapp/doneappointment.php">
                <i class='bx bx-list-check' ></i>
                <span class="links_name">Done Appointment</span>
              </a>
            </li>

            <li>
              <a href="../cancelledapp/cancelapp.php">
                <i class='bx bx-calendar-x' ></i>
                <span class="links_name">Cancelled</span>
              </a>
            </li>
            
            <li>
              <a href="../useracc/useraccount.php">
                <i class='bx bx-group' ></i>
                <span class="links_name">User Account</span>
              </a>
            </li>
            <li>
              <a href="../archivedacc/archived.php">
                <i class='bx bx-user-x' ></i>
                <span class="links_name">Archived Account</span>
              </a>
            </li>

            <li>
              <a href="../messages/messages.php">
                <i class='bx bx-message' ></i>
                <span class="links_name">Messages</span>
              </a>
            </li>


            <li class="log_out">
              <a href="" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">
                <i class='bx bx-log-out'></i>
                <span class="links_name">Log out</span>
              </a>
            </li>
          </ul>
      </div>

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


      <section class="home-section">
        <nav>
          <div class="sidebar-button">
            <i class='bx bx-menu sidebarBtn'></i>
            <span class="dashboard">Admin Profile</span>
          </div>
          
          <?php
          include '../../database/config.php';

          $query = mysqli_query($conn, "SELECT * FROM registration WHERE email = '$email'")
          or die('query failed');

          if(mysqli_num_rows($query) > 0) {
            $items = mysqli_fetch_assoc($query); 
          }
          ?>
          <li style="list-style: none"><a href="../adminprofile/admin-profile.php?lastname=<?php echo $items['lastname']?> &firstname=<?php echo $items['firstname']?> &middlename=<?php echo $items['middlename']?> &gender=<?php echo $items['gender']?> &suffix=<?php echo $items['suffix']?> &dob=<?php echo $items['dob'] ?>&age=<?php echo $items['age']?> &contact=<?php echo $items['contact']?> &email=<?php echo $items['email']?> &address=<?php echo $items['address']?> &barangay=<?php echo $items['barangay']?> &img=<?php echo $items['img'] ?>" class="profile-details"><img class="dp" src="<?php echo "../../admin_interface/upload/".$items['img']; ?>" alt="">
            <span class="admin_name"><?php echo $email ?></span></a></li>
        </nav>
    
        <div class="home-content">
    
          <div class="sales-boxes">
            <div class="recent-sales box">
            <form action="" method="POST" enctype="multipart/form-data">
            <style>
              .dp{
                border-radius:100% !important;
              }
              .udp{
              border-radius:100% !important;
              min-height:15vh;
              max-height:15vh;
              border: black solid 1px;
            }
            .recent-sales{
              height:65vh;
            }
            </style>
                <div class="row-container">
                    <img class="udp" src="<?php echo "../../admin_interface/upload/".$_GET['img']; ?>" width="100" alt="">

                    <input class="updt_img" type="file" name="update_img" id="" accept=".jpg, .jpeg, .png" >
                  </div>

                    <div class="input-group">
                      <label for="">Last Name:</label>
                      <input type="text" name="update_lastname" class="form-control" placeholder="" value="<?php echo trim($_GET['lastname']) ?>" style="text-transform:capitalize">
                    </div>

                    <div class="input-group">
                      <label for="">First Name:</label>
                      <input type="text" name="update_firstname" class="form-control" placeholder="" value="<?php echo trim($_GET['firstname']) ?>" style="text-transform:capitalize">
                    </div>

                    <div class="input-group">
                      <label for="">Gender:</label>
                      <select class="form-control" name="update_gender">
                        <option selected><?php echo $_GET['gender']?></option>
                        <option>Male</option>
                        <option>Female</option>
                      </select>
                      </div>
                        

                    <div class="right-side">
                        
                        <div class="input-group2">
                            <label for="">Contact:</label>
                            <input type="text" class="form-control" name="update_contact" id="" maxlength="11" onkeypress='return event.charCode >=48 && event.charCode <=57' value="<?php echo trim($_GET['contact'])?>">
                        </div>
                        <div class="input-group2">
                            <label for="">Email:</label>
                            <input type="text" name="" class="form-control" placeholder="" value="<?php echo $_GET['email'] ?>" disabled>
                        </div>
                        

                        <style>
                        .btn-change-pass a {
                          float: right;
                          padding-right: 10px;
                          margin-top:70px;
                            }
                          </style>

                          <div class="btn-change-pass">
                            <a href="" data-bs-toggle="modal" data-bs-target="#exampleModal">Change Password</a>
                          </div>

                      <style>
                        .modal-content {
                          margin-top: 150px !important;
                          margin-left: 55px !important;
                          width: 100% !important;
                        }
                        .input-group{
                          width:450px !important;
                        }
                        </style>

                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
                            </div>
                            
                            <div class="modal-body">
                              <div class="input-group">
                                <label for="">New password:</label>
                                <input type="password" id="myInput" name="update_newpass" class="form-control1" placeholder="" >
                              </div>

                              <div class="input-group">
                                <label for="">Confirm password:</label>
                                <input type="password" id="myInput2" name="update_pass" class="form-control1" placeholder="" >
                              </div>
                              
                              <style>
                              .form-control2{
                                margin-left:2px !important;
                                display:inline-block !important;
                              }
                              .input-group5{
                                display:inline-block !important;
                                line-height:1px !important;
                              }
                              input[type=checkbox], input[type=radio] {
                              margin: 3px !important;
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
                              <div class="input-group5" style="margin:0">
                                <label for="">Show password:</label>
                                <input type="checkbox" onchange="toogleInput(this)" class="form-control2">
                                
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

        </div>
      </section>

<script src="admin-profile.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>