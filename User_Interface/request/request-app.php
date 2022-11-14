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
if (isset($_POST['add_appointment'])) {
    $reference = $_POST['reference'];
    $fullname = $_POST['fullname'];
    $suffix = $_POST['suffix'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $barangay = $_POST['barangay'];
    $typeofapp1 = $_POST['typeofapp1'];
    $typeofapp2 = $_POST['typeofapp2'];
    $typeofapp3 = $_POST['typeofapp3'];
    $typeofapp4 = $_POST['typeofapp4'];
    $typeofapp5 = $_POST['typeofapp5'];
    $typeofapp6 = $_POST['typeofapp6'];
    $typeofapp7 = $_POST['typeofapp7'];
    $timeofapp = $_POST['timeofapp1'];
    $dateofapp = $_POST['dateofapp'];
    $status = $_POST['status'];
    $dateofreq = $_POST['dateofreq'];
    $now = $_POST['now'];

    // Limit the time-slot
    $sql3 = "SELECT dateofapp FROM appointment WHERE dateofapp = '$dateofapp' AND timeofapp = '$timeofapp' AND status='pending'";
    $result3 = mysqli_query($conn, $sql3);
    
    // One appointment only
    $sql2 = "SELECT * FROM appointment WHERE email = '$email' AND status='pending'";
    $result2 = mysqli_query($conn, $sql2);

    if(mysqli_num_rows($result2) == 1){ // One appointment only
    	echo '<script>alert("You still have pending appointment")</script>';
    }
    elseif(mysqli_num_rows($result3) == 13){ // Limit the time-slot
      echo '<script>alert("Time you choose is fully booked \n\nPlease choose another time-slot")</script>';
    }
    else{
    $sql = "INSERT INTO appointment (reference, fullname, suffix, age, gender, contact, email, address, barangay, typeofapp, timeofapp, dateofapp, status, dateofreq, now)
    VALUES ('$reference', '$fullname', '$suffix', '$age', '$gender', '$contact', '$email', '$address', '$barangay', '$typeofapp1 $typeofapp2 $typeofapp3 $typeofapp4 $typeofapp5 $typeofapp6 $typeofapp7', '$timeofapp', '$dateofapp', '$status', '$dateofreq', '$now')";
    $result = mysqli_query($conn, $sql);

    echo '<script>alert("Appointment added successfully \n\nYou may now download your PDF")</script>';
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    
    <link rel="stylesheet" href="request-app-style.css">

    <title>Request Appointment</title>
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
                  <li><a href="../request/request-app.php?lastname=<?php echo $items['lastname']?> &firstname=<?php echo $items['firstname']?> &middlename=<?php echo $items['middlename']?> &suffix=<?php echo $items['suffix']?> &age=<?php echo $items['age']?> &gender=<?php echo $items['gender']?> &contact=<?php echo $items['contact']?> &email=<?php echo $items['email']?> &address=<?php echo $items['address']?> &barangay=<?php echo $items['barangay']?>"><span>REQUEST APPOINTMENT</span></a></li>
                  
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

      <!--APPOINTMENT STARTS HERE-->
      <div class="row">
        <div class="row-container">

          <div class="patient-info">Client's/Patient's Information</div>
        
          <div class="input-group">
            <label for="">Full Name:</label>
            <input type="text" name="" class="form-control" placeholder="" value="<?php echo $_GET['firstname'],$_GET['middlename'],$_GET['lastname'] ?>" style="text-transform:capitalize" disabled>
            </div>
    
            <div class="input-group">
            <label for="">Suffix:</label>
            <input type="text" name="" class="form-control" placeholder="" value="<?php echo $_GET['suffix'] ?>" disabled>
            </div>

            <div class="input-group">
            <label for="">Age:</label>
            <input type="text" id="" name="" class="form-control" placeholder="" value="<?php echo $_GET['age'] ?>" disabled>
            </div>

            <div class="input-group">
                <label for="">Gender:</label>
                <input type="text" id="" name="" class="form-control" placeholder="" value="<?php echo $_GET['gender'] ?>" disabled>
            </div>

            <div class="input-group">
                <label for="">Contact:</label>
                <input type="text" id="" name="" class="form-control" placeholder="" value="<?php echo $_GET['contact'] ?>" disabled>
            </div>

            <div class="input-group">
                <label for="">Email:</label>
                <input type="text" id="" name="" class="form-control" placeholder="" value="<?php echo $_GET['email'] ?>" disabled>
            </div>
    
            <div class="input-group">
                <label for="">Address:</label>
                <input type="text" id="" name="" class="form-control" placeholder="" value="<?php echo $_GET['address'] ?>" disabled>
            </div>

            <div class="input-group">
                <label for="">Barangay:</label>
                <input type="text" id="" name="" class="form-control" placeholder="" value="<?php echo $_GET['barangay'] ?>" disabled>
            </div>

        </div>
      </div>


      <div class="container">
      
        
        <div class="content">  
            <div class="left-side">

                <form action="" method="POST">
                <input type="hidden" name="reference" id="reference" value="">

                <input type="hidden" name="status" id="" value="Pending">

                <input type="hidden" name="dateofreq" id="" value="<?php echo date('y-m-d');?>">

                <input type="hidden" name="fullname" class="form-control" placeholder="" value="<?php echo $_GET['firstname'],$_GET['middlename'],$_GET['lastname'] ?>" style="text-transform:capitalize">

                <input type="hidden" name="suffix" class="form-control" value="<?php echo $_GET['suffix']?>">

                <input type="hidden" name="age" class="form-control" placeholder="" value="<?php echo $_GET['age']?>">

                <input type="hidden" name="gender" class="form-control" placeholder="" value="<?php echo $_GET['gender']?>">

                <input type="hidden" name="contact" class="form-control" placeholder="" value="<?php echo $_GET['contact']?>">

                <input type="hidden" name="email" class="form-control" placeholder="" value="<?php echo $_GET['email']?>">

                <input type="hidden" name="address" class="form-control" placeholder="" value="<?php echo $_GET['address']?>">

                <input type="hidden" name="barangay" class="form-control" placeholder="" value="<?php echo $_GET['barangay']?>">

                <div class="title-left"> Type of Appointment</div>
                <div class="checkbox">
                    <input type="checkbox" name="typeofapp1" class="box" value="&#8226;Dental"><span>Dental</span>
                </div>
                <div class="checkbox">
                    <input type="checkbox" name="typeofapp2" class="box" value="&#8226;Pre-marital Counseling"><span>Pre-marital Counseling</span>
                </div>
                <div class="checkbox">
                    <input type="checkbox" name="typeofapp3" class="box" value="&#8226;Prenatal"><span>Prenatal</span>
                </div>
                <div class="checkbox">
                    <input type="checkbox" name="typeofapp4" class="box" value="&#8226;Family planning counseling"><span>Family planning counseling</span>
                </div>
                <div class="checkbox">
                    <input type="checkbox" name="typeofapp5" class="box" value="&#8226;General consultation check-up"><span>General consultation check-up</span>
                </div>
                <div class="checkbox">
                    <input type="checkbox" name="typeofapp6" class="box" value="&#8226;Medical Certificate"><span>Medical Certificate</span>
                </div>
                <div class="checkbox">
                    <input type="checkbox" name="typeofapp7" class="box" value="&#8226;Sanitary Permit"><span>Sanitary Permit</span>
                </div>

                <div class="note"><p>Note: Maximum of 3 appointments only</p></div>
                
            </div>
            <style>
              @media screen and (max-width: 414px){
                .container{
                  height:120vh;
                }
                .time-btns{
                  margin:3px 47px;
                }
                .time-btns span{
                  font-size:15px;
                }
                .right-side{
                  height:55vh;
                  margin-top:520px;
                }
                .second-btn .btn-primary{
                  position:absolute;
                  left:30px;
                  bottom:30px;
                  margin:5px !important;
                }
                .modal-footer button{
                  margin:0;
                }
                
                .modal-footer .btn-primary{
                  position:absolute;
                  left:10px;
                  bottom:8px;
                  margin:5px !important;
                }
                body{
                  height:205vh;
                }
              }
              @media screen and (max-width: 360px){
                .container{
                  height:140vh;
                }
                .time-btns{
                  margin:3px 47px;
                }
                .right-side{
                  height:70vh;
                  margin-top:470px;
                }
                .second-btn .btn-primary{
                  position:absolute;
                  left:30px;
                  bottom:30px;
                  margin:5px !important;
                }
                .modal-footer button{
                  margin:0;
                }
                
                .modal-footer .btn-primary{
                  position:absolute;
                  left:10px;
                  bottom:8px;
                  margin:5px !important;
                }
                body{
                  height:230vh;
                }
              }
              
            </style>

            <div class="right-side">
                <div class="title-right"> Date of Appointment
                    <div class="date">
                    <input type="date" name="dateofapp" id='txtDate' required>
                    </div>
                </div>
                <div class="title-mid"> Time of Appointment</div>
              
                <div class="time-btns">
                    <input class="boxs" type="checkbox" name="timeofapp1" id="" value='08:00AM to 09:00AM'>
                    <span >08:00AM to 09:00AM</span>
                </div>
                <div class="time-btns">
                    <input class="boxs" type="checkbox" name="timeofapp1" id="" value='09:00AM to 10:00AM'>
                    <span >09:00AM to 10:00AM</span>
                </div>
                <div class="time-btns">
                    <input class="boxs" type="checkbox" name="timeofapp1" id="" value='10:00AM to 11:00AM'>   
                    <span >10:00AM to 11:00AM</span>
                </div>
                <div class="time-btns">
                    <input class="boxs" type="checkbox" name="timeofapp1" id="" value='11:00AM to 12:00PM'>
                    <span >11:00AM to 12:00PM</span>
                </div>
                <div class="time-btns">
                    <input class="boxs" type="checkbox" name="timeofapp1" id="" value='1:00PM to 2:00PM'>
                    <span>1:00PM to 2:00PM</span>
                </div>
                <div class="time-btns">
                    <input class="boxs" type="checkbox" name="timeofapp1" id="" value='2:00PM to 3:00PM'>
                    <span >2:00PM to 3:00PM</span>
                </div>
                <div class="time-btns">
                    <input class="boxs" type="checkbox" name="timeofapp1" id="" value='3:00PM to 4:00PM'>
                    <span>3:00PM to 4:00PM</span>
                </div>
                <div class="time-btns">
                    <input class="boxs" type="checkbox" name="timeofapp1" id="" value='4:00PM to 5:00PM'>
                    <span>4:00PM to 5:00PM</span>
                </div>
                

                <div class="first-btn">
                <button type="button" class="cancel" onClick="window.location.reload();">Cancel</button>
                </div>   

                <div class="second-btn">         
                <!-- Button trigger modal -->
                <style>
                .modal-content {
                  margin-top: 150px !important;
                }
                .modal-body{
                  margin-top: 0px;
                }
                .btn-primary{
                  margin-right: 18px !important;
                }
                </style>

                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                  Submit
                </button>


                <!-- Modal -->
                
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Appointment</h5>
                      <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      Are you sure you want to submit this appointment?
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button class="btn btn-primary" name="add_appointment">Submit</button>
                    </div>
                  </div>
                </div>
              </div>

                </form>
                </div>

                <?php
                include '../../database/config.php';

                $query = mysqli_query($conn, "SELECT * FROM appointment WHERE email = '$email' AND status = 'pending'")
                or die('query failed');

                if(mysqli_num_rows($query) == 1) {
                    $items = mysqli_fetch_assoc($query); 
                }
                ?>
                <div class="second-btns">
                <a href="summary-pdf.php?reference=<?php echo $items['reference']?> &fullname=<?php echo $items['fullname']?> &suffix=<?php echo $items['suffix']?> &age=<?php echo $items['age']?> &gender=<?php echo $items['gender']?> &contact=<?php echo $items['contact']?> &email=<?php echo $items['email']?> &address=<?php echo $items['address']?> &barangay=<?php echo $items['barangay']?> &dateofapp=<?php echo $items['dateofapp']?> &timeofapp=<?php echo $items['timeofapp']?> &typeofapp=<?php echo $items['typeofapp']?> &dateofreq=<?php echo $items['dateofreq']?>" class="dl">Download PDF</a>
                </div>
                

           
        </div>
       
        </div>

        </div>

          

        <script src="request-app.js"></script>
        <script src="time.js"></script>
        <script src="reference.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>