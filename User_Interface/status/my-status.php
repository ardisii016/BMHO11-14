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

  //CHECKING IF THERES AN APPOINTMENT OR NOT
  $sql2 = "SELECT * FROM appointment WHERE email = '$email' AND status='pending'";
  $result2 = mysqli_query($conn, $sql2);
  if(mysqli_num_rows($result2) < 1){

  echo '<script>alert("You don\'t have an appointment yet")</script>';
  }
  
//CANCELLING APPOINTMENT
if(isset($_POST['cancelapp'])){
  $cancel = $_POST['cancelapp'];
  $reference = $_POST['reference'];

    
    //CANCELLING APPOINTMENT
    $conn = mysqli_query ($conn,"UPDATE `appointment` SET status ='$cancel' WHERE reference = '$reference'");

    echo '<script>alert("You have cancel your appointment")</script>';
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

    <link rel="stylesheet" href="my-status-style.css">
    <title>My Appointment (status) </title>
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
                <a href="#" class="sidebar-arrow"><span>APPOINTMENT</span></a>
                <i class='bx bxs-chevron-down htmlcss-arrow arrow'></i>

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
                <li><a href="../status/my-status.php?reference=<?php echo $items['reference']?> &typeofapp=<?php echo $items['typeofapp']?> &timeofapp=<?php echo $items['timeofapp']?> &dateofapp=<?php echo $items['dateofapp']?>"><span>APPOINTMENT (STATUS)</span></a></li>
                
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

      <!--STATUS TABLE STARTS HERE-->
      <table>
      <form action="" method="POST">
        <thead style="text-align: center">
         <tr>
          <th style="padding-left: 20px">Reference no. </th>
          <th class="toa">Type of Appointment</th>
          <th>Time of Appointment</th>
          <th>Date of Appointment</th>
          <th> </th>
         </tr>
        </thead>
        <tbody style="text-align: center">
         <tr>
          <td class="ref"><?php echo $_GET['reference']?></td>
          <td class="toa2" style="text-transform:capitalize"><?php echo $_GET['typeofapp']?></td>
          <td><?php echo $_GET['timeofapp']?></td>
          <td><?php echo $_GET['dateofapp']?></td>
          <td> 
            
            <input type="hidden" name="reference" value="<?php echo $_GET['reference'] ?>">

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" <?php if (mysqli_num_rows($result2) < 1){ ?> disabled <?php } ?>> <!-- it disabled the button if theres no appo -->
              Cancel
            </button>

          <!-- Modal -->
          <style>
            .modal-content {
              margin-top: 150px !important;
            }
            </style>
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Cancel Appointment</h5>
                  <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  Are you sure you want to cancel this appointment?
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <input type="submit" class="btn btn-primary" name="cancelapp" value="Cancel" title="cancel appointment?">
                </div>
              </div>
            </div>
          </div>

          </td>
         </tr>
        </tbody>
      </form>
       </table>

<script src="my-status.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>