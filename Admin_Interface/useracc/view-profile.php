<?php

    include 'config.php';
    session_start();
    error_reporting(0);

    $email = $_SESSION['txtEmail'];

    if(!isset($_SESSION['txtEmail'] ))
    {
      header("Location: ../../index.php");
    }

    //DELETE ACCOUNT FROM DATABASE
    if(isset($_POST['deleteacc'])){
    $removed = $_POST['deleteacc'];
    $email = $_GET['email'];

    $conn = mysqli_query ($conn,"UPDATE `registration` SET usertype ='$removed' WHERE email = '$email'");

    echo '<script>alert("You have removed this account")</script>';
  }

  if(isset($_POST['edittype'])){
    $admin = $_POST['edittype'];
    $email = $_GET['email'];

    $conn = mysqli_query ($conn,"UPDATE `registration` SET usertype ='$admin' WHERE email = '$email'");

    echo '<script>alert("You have made this account an Admin")</script>';
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

    <link rel="stylesheet" href="view-profile-style.css">
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
                <i class='bx bx-home-alt' ></i>
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
              <a href="#" class="active">
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
            <span class="dashboard">User Profile</span>
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
        <style>
              .dp{
                border-radius:100% !important;
              }
            </style>
        <div class="home-content">
          <div class="overview-boxes">
            
            <a href="useraccount.php" class="backBton">back</a>
            
          </div>

          <form action="" method="POST">
          <div class="sales-boxes">
            <div class="recent-sales box">

            <style>
              .udp{
                border-radius:100% !important;
                min-height:17vh;
                max-height:17vh;
                border: black solid 2px;
              }
            </style>
                <div class="row-container">
                  <img class="udp" src="<?php echo "../upload/".$_GET['img']; ?>" width="110" alt="">
                  </div>

                  <style>
                      input .form-control {
                      width:95%;                     
                    }
                    .bx-user-check:hover{
                      color:lightgreen;
                    }
                    .bx-user-x:hover{
                      color:red;
                    }
                  </style>
                  <div class="input-group">
                    <label for="">Last Name:</label>
                    <input type="text" name="" class="form-control" placeholder="" value="<?php echo $_GET['lastname'] ?>" style="text-transform:capitalize" disabled>
                    </div>
                    <div class="input-group">
                      <label for="">First Name:</label>
                      <input type="text" name="" class="form-control" placeholder="" value="<?php echo $_GET['firstname'] ?>" style="text-transform:capitalize" disabled>
                      </div>
                      <div class="input-group">
                        <label for="">Middle Name:</label>
                        <input type="text" name="" class="form-control" placeholder="" value="<?php echo $_GET['middlename'] ?>" style="text-transform:capitalize" disabled>
                        </div>
            
                        <div class="input-group">
                            <label for="">Gender:</label>
                            <input type="text" name="" class="form-control" placeholder="" value="<?php echo $_GET['gender'] ?>" disabled>
                        </div>
                        <div class="input-group">
                            <label for="">Suffix:</label>
                            <input type="text" name="" class="form-control" placeholder="" value="<?php echo $_GET['suffix'] ?>" disabled>
                        </div>

                    <div class="right-side">
                        <div class="input-group2">
                            <label for="txtbirthdate">Date of Birth:</label>
                            <input class="form-control" id="txtbirthdate" type="date" name="" placeholder="" value="<?php echo $_GET['dob']; ?>" disabled>
                        </div>
                          
                        <div class="input-group2">
                            <label for="txtage">Age:</label>
                            <input class="form-control" id="txtage" type="text" name=""  placeholder="" value="<?php echo $_GET['age']; ?>" disabled>
                          </div>
                        
                        <div class="input-group2">
                            <label for="">Contact:</label>
                            <input type="text" name="" class="form-control" placeholder="" value="<?php echo $_GET['contact']; ?>" disabled>
                        </div>
                        <div class="input-group2">
                            <label for="">Email:</label>
                            <input type="text" name="" class="form-control" placeholder="" value="<?php echo $_GET['email']; ?>" disabled>
                        </div>
                        <div class="input-group2">
                            <label for="">Address:</label>
                            <input type="text" name="" class="form-control" placeholder="" value="<?php echo $_GET['address']; ?>" disabled>
                        </div>
                        <div class="input-group2">
                            <label for="">Barangay:</label>
                            <input type="text" name="" class="form-control" placeholder="" value="<?php echo $_GET['barangay']; ?>" disabled>
                        </div>  

                       
                        <input type="hidden" name="reference" value="<?php echo $_GET['email'] ?>">
                        <!-- Button trigger modal -->
                        <button type="button" class="delete btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal" style="margin-top:5px; padding:4px 20px; font-size:15.5px; border:black solid 1px">
                          EDIT
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Edit account</h5>
                              <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body" style="text-align: center">
                              What do you want to do with this account?
                            </div>
                            
                            <div class="modal-footer">
                              <span>Make this account an ADMIN</span>
                              <button type="submit" class="bx bx-user-check" name="edittype" value="admin" style="border:none; background:none; font-size:30px;" title="Make this account an Admin?">
                              </button>
                            </div>
                            <div class="modal-footer">
                              <span>Remove this account</span>
                              <button type="submit" class="bx bx-user-x" name="deleteacc" value="removed" style="border:none; background:none; font-size:30px;" title="Delete this account?">
                              </button>
                            </div>

                            </form>
                          </div>
                        </div>
                      </div>
                        
                    </div>
            </div>
          </div>

        </div>
      </section>

<script src="view-profile.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>