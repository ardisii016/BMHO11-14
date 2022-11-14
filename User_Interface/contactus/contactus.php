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

//CONNECTING TO DATABASE
if (isset($_POST['send'])) {
  $fullname = $_POST['fullname'];
  $email = $_POST['email'];
  $msg = $_POST['msg'];
  $dateofmsg = $_POST['dateofmsg'];
  $anony = $_POST['anony'];

  if (isset($_POST['anony'])){
  $sql1 = "INSERT INTO message (fullname, email, msg, dateofmsg, anony) VALUES ('*****', '*****', '$msg', '$dateofmsg', '$anony')";
  $result1 = mysqli_query($conn, $sql1);

  echo '<script>alert("Your message has been sent via anonymous")</script>';
  }
  else{
  $sql = "INSERT INTO message (fullname, email, msg, dateofmsg, anony) VALUES ('$fullname', '$email', '$msg', '$dateofmsg', '$anony')";
  $result = mysqli_query($conn, $sql);

  echo '<script>alert("Your message has been sent")</script>';
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
    
    <link rel="stylesheet" href="contactus-style.css">
    <title>Contact Us</title>
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
              <li><a href="../contactus/contactus.php?lastname=<?php echo $items['lastname']?> &firstname=<?php echo $items['firstname']?> &middlename=<?php echo $items['middlename']?> &email=<?php echo $items['email']?>"><span>CONTACT US</span></a></li>
    
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
    
          <div class="search-box" style="display: none;">
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

<!--CONTACT US STARTS HERE-->
      <div class="container">
        <div class="content">
          <div class="left-side">
            <div class="address details">
              <a href="https://maps.google.com/?q=Balete Municpal Health Center" target="_blank">
              <i class="fas fa-map-marker-alt"></i>
              <div class="topic">Address</div>
              <p><span>Poblacion II, Balete,</span>
                Batangas</p></a>
            </div>
            <div class="phone details">
              <a href="tel:+639319594014">
              <i class="fas fa-phone-alt"></i>
              <div class="topic">Phone</div>
              <p>+639-319-5940-14</a></p>
            </div>
            <div class="email details">
              <a href="mailto:baletemho01@gmail.com">
              <i class="fas fa-envelope"></i>
              <div class="topic">Email</div>
              <p>baletemho01@gmail.com</a></p>
            </div>
          </div>
          <div class="right-side">
            <div class="topic-text">Send us a message</div>
            <p>Please send us a message if you have any comments or suggestions, thank you.</p>
          <form action="#" method="POST">
          
          <input type="hidden" name="dateofmsg" id="" value="<?php echo date('m/d/y');?>">

            <div class="input-box">
              <input name= "fullname" type="text" style="text-transform:capitalize" value="<?php echo $_GET['lastname'], $_GET['firstname'], $_GET['middlename'] ?>" class="ano">
            </div>
            <div class="input-box">
              <input name="email" type="text" placeholder="" value="<?php echo $_GET['email']?>" class="ano">
            </div>
            <div class="input-box message-box">
              <textarea name="msg" placeholder="Your message" required></textarea>
            </div>

            <style>
              
            </style>
            <script>
              function toogleInput(e) {
                var list = document.getElementsByClassName('ano');
                for (let item of list) {
                  item.type = e.checked ? 'password' : 'text';
                }
              }
            </script>
            <div class="input-box" style="height:3vh;">
              <label for="">Make myself anonymous:</label>
              <input name="anony" type="checkbox" onchange="toogleInput(this)" class="check" style="height:2vh; width:2%; margin-top:5px; cursor:pointer">
            </div>

            <?php
            
            ?>

            <div class="button">
              <button class="submit" name="send" value="">Send Now</button>
            </div>
          </form>
        </div>
        </div>
      </div>

<script src="contactus.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>