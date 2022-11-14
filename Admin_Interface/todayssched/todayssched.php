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

//GET THE CURRENT DATE
if (isset($_GET['refresh'])) {
  $now = $_GET['now'];
}

$conn = mysqli_query ($conn,"UPDATE appointment SET now = '$now' WHERE now = '' OR '$now' AND !isnull(now)");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/css/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="todayssched-style.css">
    <title>Today's Schedule</title>

    <!-- Search engine -->
    <script> 
        $(document).ready(function(){
          $("#myInput").on("keyup", function(){
            var value =$(this).val().toLowerCase();
            $("#myTable a").filter(function(){
              $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
          });
        });
  </script>
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
                <a href="#" class="active">
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
            <span class="dashboard">Today's Schedule</span>
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
            
          <div class="search-box">
                <input id="myInput" type="text" name="" placeholder="Search..." style="width:510px">
              </div>
              
          </div>
          
          <form action="" method="GET">
          <input type="hidden" name="now" id="" value="<?php echo date('y-m-d');?>">

          <style>
            .refr{
            color: white !important;
            margin-left: 25px !important;
            margin-bottom: 15px !important;
            border-radius: 4px !important;
            border: none !important;
            padding: 5px 10px !important;
            background-color: var(--darkblue) !important;
            box-shadow: 0 5px 10px rgba(0.2, 0.2, 0.2, 0.2) !important;
            transition: 0.3s !important;
          }
          .refr:hover{
            background-color: var(--lightblue) !important;
          }
          </style>
          <input class="refr" type="submit" name="refresh" value="Refresh">

          <div class="sales-boxes">
            <div class="recent-sales box">
              <div class="title">Today's Appointment</div>
              <div class="sales-details">
                <ul class="details">
                  <li class="topic">Reference no.</li>
                  
                  
                  <?php
                    include '../../database/config.php';
                
                    $query = "SELECT * FROM appointment WHERE dateofapp <= now && status = 'pending' ORDER BY timeofapp ";
                    $query_run = mysqli_query($conn, $query);
                   

                    if(mysqli_num_rows($query_run) > 0) {
                      foreach($query_run as $items) {
                        ?>
                        <li id="myTable"><a href='view-todaysapp.php?reference=<?php echo $items['reference']?> &typeofapp=<?php echo $items['typeofapp']?> &timeofapp=<?php echo $items['timeofapp']?> &dateofapp=<?php echo $items['dateofapp']?> &fullname=<?php echo $items['fullname']?>'> <?= ucwords($items['reference']) ?></a></li>
                        <?php
                      }
                    }
                    
                  ?>
                  
                
                </ul>
                
                <ul class="details">
                <li class="topic">Patient's Name</li>
                <?php
                    include '../../database/config.php';

                    $query = "SELECT * FROM appointment WHERE dateofapp <= now && status = 'pending' ORDER BY timeofapp ";
                    $query_run = mysqli_query($conn, $query);

                    if(mysqli_num_rows($query_run) > 0) {
                      foreach($query_run as $items) {
                        ?>
                        <li id="myTable"><a href='view-todaysapp.php?reference=<?php echo $items['reference']?> &typeofapp=<?php echo $items['typeofapp']?> &timeofapp=<?php echo $items['timeofapp']?> &dateofapp=<?php echo $items['dateofapp']?> &fullname=<?php echo $items['fullname']?>'> <?= ucwords($items['fullname']) ?></a></li>
                        <?php
                      }
                    }
                  ?>
                
              </ul>

              <ul class="details">
                <li class="topic">Time of Appointment</li>
                <?php
                    include '../../database/config.php';

                    $query = "SELECT * FROM appointment WHERE dateofapp <= now && status = 'pending' ORDER BY timeofapp";
                    $query_run = mysqli_query($conn, $query);

                    if(mysqli_num_rows($query_run) > 0) {
                      foreach($query_run as $items) {
                        ?>
                        <li class="normal" id="myTable"><a href='view-todaysapp.php?reference=<?php echo $items['reference']?> &typeofapp=<?php echo $items['typeofapp']?> &timeofapp=<?php echo $items['timeofapp']?> &dateofapp=<?php echo $items['dateofapp']?> &fullname=<?php echo $items['fullname']?>'> <?= ucwords($items['timeofapp']) ?></a></li>
                        <?php
                      }
                    }
                  ?>
              </ul>
                
                
                </form>
              </div>

            </div>
          </div>

        </div>
      </section>

<script src="todayssched.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>