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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" crossorigin="anonymous">
    
    <link rel="stylesheet" href="summary-pdf-style.css">

    <title>Summary of Appointment</title>
</head>
<body>
    <!--SUMMARY PDF STARTS HERE-->
    
    <div class="container d-flex justify-content-center mt-50 mb-50">
        <div class="row">
        <style>
            .rounded{
                height:50px
            }
        </style>  

            <div class="col-md-12">
                <div class="card" id="invoice">
                    <div class="card-header bg-transparent header-elements-inline">
                        <h6 class="card-title text-primary">Summary of Appointment</h6>
                        <img src="../image/logo.png" class="rounded float-right" alt="...">
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-4 pull-left">

                                    <ul class="list list-unstyled mb-0 text-left">
                                        <li>Balete Municipal Health Office</li>
                                        <li>Poblacion II, Balete Batangas</li>
                                        <li>+63-9319-594-014</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-4 ">
                                    <div class="text-sm-right">
                                        <h4 class="invoice-color mb-2 mt-md-2">Reference no. </li> <?php echo $_GET['reference']?> </h4>
                                        <ul class="list list-unstyled mb-0">
                                            <li>Date: <span class="font-weight-semibold"><?php echo $_GET['dateofreq']?></span></li>
                                            <li>Appointment date: <span class="font-weight-semibold"><?php echo $_GET['dateofapp']?></span></li>
                                            <li>Appointment time: <span class="font-weight-semibold"><?php echo $_GET['timeofapp']?></span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-md-flex flex-md-wrap">
                            <div class="mb-4 mb-md-2 text-left"> <span class="text-muted">Patient info:</span>
                                <ul class="list list-unstyled mb-0">
                                    <li>
                                        <h5 class="my-2" style="text-transform:capitalize" ><?php echo $_GET['fullname']?> </h5>
                                    </li>
                                    <li style="display: inline-block; width:35%">Suffix:  </li> <?php echo $_GET['suffix']?>  </br>
                                    <li style="display: inline-block; width:35%">Age:     </li> <?php echo $_GET['age']?>     </br>
                                    <li style="display: inline-block; width:35%">Gender:  </li> <?php echo $_GET['gender']?>  </br>
                                    <li style="display: inline-block; width:35%">Contact: </li> <?php echo $_GET['contact']?> </br>
                                    <li style="display: inline-block; width:35%">Email:   </li> <?php echo $_GET['email']?>   </br>
                                    <li style="display: inline-block; width:35%">Address: </li> <?php echo $_GET['address']?> </br>
                                    <li style="display: inline-block; width:35%">Barangay:</li> <?php echo $_GET['barangay']?></br>
                                </ul>
                            </div>
                            <style>
                                @media screen and (max-width: 360px){
                                    .mb-2 span.text-muted{
                                       position:absolute;
                                        
                                        top: 555px
                                    }
                                }
                            </style>
                            <div class="mb-2 ml-auto"> <span class="text-muted">Details:</span>
                                <div class="d-flex flex-wrap wmin-md-400">
                                    <ul class="list list-unstyled mb-0 text-left">
                                        <li>
                                            <h5 class="my-2">Type of Appointment(s):</h5>
                                        </li>
                                        <li class="txt" style="font-size: 18px; text-transform:capitalize"><?php echo $_GET['typeofapp']?>
                                        </li> 
                                    </ul>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-footer"> <span class="text-muted">IMPORTANT NOTE: PLEASE BRING YOUR PHILHEALTH CARD</span> </div>
                </div>
            </div>

            
            <div class="col-md-12 text-right mb-3">
                <button class="btn btn-primary" id="download"> Download pdf <span class="fa">&#xf019;</span></button>
            </div>
            <div class="col-md-12 text-right mb-3">
                <?php
                  include '../../database/config.php';

                  $query = mysqli_query($conn, "SELECT * FROM registration WHERE email = '$email'")
                  or die('query failed');

                  if(mysqli_num_rows($query) > 0) {
                    $items = mysqli_fetch_assoc($query); 
                  }
                ?>
                <a href= "request-app.php?lastname=<?php echo $items['lastname']?> &firstname=<?php echo $items['firstname']?> &middlename=<?php echo $items['middlename']?> &suffix=<?php echo $items['suffix']?> &age=<?php echo $items['age']?> &gender=<?php echo $items['gender']?> &contact=<?php echo $items['contact']?> &email=<?php echo $items['email']?> &address=<?php echo $items['address']?> &barangay=<?php echo $items['barangay']?>" class="btn btn-primary" id="cancel"> Go back </a>
            </div>
            
        </div>
    </div>

      <script src="summary-pdf.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>     
</body>
</html>