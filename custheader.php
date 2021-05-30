<?php
  include 'connection.php';

  $lkey = $_COOKIE['lkey'];
  $sql="select fname,lname from tb_customer where loginid='".$lkey."'";

  $result = mysqli_query($conn,$sql);
  while ($row=mysqli_fetch_array($result))
  {
    $fname=$row['fname'];
    $lname=$row['lname'];
    $name=$fname." ".$lname;
  }
?>
<!doctype html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/ico/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/ico/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/ico/favicon-16x16.png">
    <link rel="manifest" href="assets/ico/site.webmanifest">
    <link rel="mask-icon" href="assets/ico/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="shortcut icon" href="assets/ico/favicon.ico">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-config" content="assets/ico/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">

    <!-- Plugins CSS -->
    <link rel="stylesheet" href="assets/libs/flickity/dist/flickity.min.css">
    <link rel="stylesheet" href="assets/libs/flickity-fade/flickity-fade.css">
    <link rel="stylesheet" href="assets/libs/fullpage.js/dist/fullpage.min.css">
    <link rel="stylesheet" href="assets/libs/highlightjs/styles/codepen-embed.css">
    <link rel="stylesheet" href="assets/libs/%40fortawesome/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="assets/libs/incline-icons/style.min.css">

    <!-- Theme CSS -->
    <link rel="stylesheet" href="assets/css/theme.min.css">



    <title>KSEBLive 2020  | Welcome</title>
  </head>
  <body>

    <!-- NAVBAR
    ================================================= -->
    <nav class="navbar navbar-expand-xl navbar-dark  navbar-togglable  fixed-top">
      <div class="container">

        <!-- Brand -->
        <a class="navbar-brand" href="customerhome.php">
          <svg class="navbar-brand-svg" viewBox="0 0 245 80" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
            <path d="M0 0 L 20 10 L 0 20 Z" class="navbar-brand-svg-i" fill="currentColor"></path>
            <path d="M0 30 L 20 40 L 0 50 Z M20 45 L 0 55 L 20 65 Z M0 60 L 20 70 L 0 80 Z" fill="currentColor"></path>
            <text x="40" y="70" font-family="Arial, sans-serif" font-size="40" font-weight="bold" letter-spacing="-.025em" fill="currentColor">KSEBLive.</text>
          </svg>
        </a>

        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="navbarCollapse">

          <!-- Social -->
          <ul class="navbar-nav mr-auto">

            <li class="nav-item-divider">
              <span class="nav-link">
                <span></span>
              </span>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="fab fa-facebook-f"></i>
                <span class="d-xl-none ml-2">
                  Facebook
                </span>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="fab fa-twitter"></i>
                <span class="d-xl-none ml-2">
                  Twitter
                </span>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="fab fa-instagram"></i>
                <span class="d-xl-none ml-2">
                  Instagram
                </span>
              </a>
            </li>
          </ul>

          <!-- Links -->
          <ul class="navbar-nav ml-auto">

            <li class="nav-item ">
              <a href="customerhome.php" class="nav-link">
                <font color="#b894bb">Welcome <?php echo $name; ?></font>
              </a>
            </li>

            <li class="nav-item ">
              <a href="customernotify.php" class="nav-link">Notifications
              </a>
            </li>

            <li class="nav-item ">
              <a href="livecomplaint.php" class="nav-link">Live Complaints
              </a>
            </li>


            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarLandings" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Services
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarLandings">

                <a class="dropdown-item " href="billupload.php">
                  Bill Upload
                </a>
                <a class="dropdown-item " href="custbillview.php">
                  Bill View
                </a>
                <!-- <a class="dropdown-item " href="viewpaymenthistory.php">
                  Transaction History
                </a> -->
                <a class="dropdown-item " href="complaintreg.php">
                  Complaints
                </a>
                 <a class="dropdown-item " href="custcomplaintview.php">
                  Complaints Status
                </a>
                <a class="dropdown-item " href="regioncomplaint.php">
                  Common Complaint
                </a> <!--
                <a class="dropdown-item " href="connectionstatus.php">
                  New Connection Status
                </a>-->
                <a class="dropdown-item " href="addsupplyrequest.php">
                  Additional Supply Request
                </a>
                <a class="dropdown-item " href="viewaddionalsupplystatus.php">
                  Additional Supply Status
                </a>
                <a class="dropdown-item " href="meterchangerequest.php">
                  Meter Change Request
                </a>
                <a class="dropdown-item " href="viewmeterchangestatus.php">
                  Meter Change Status
                </a>
              </div>
            </li>

          <!--    <li class="nav-item ">
              <a href="jobs.php" class="nav-link">
                Jobs
              </a>
            </li>
 -->         <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarLandings" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Profile
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarLandings">
                <a class="dropdown-item " href="editprofile.php">
                  Update
                </a>
                <a class="dropdown-item " href="passchange.php">
                  Change Password
                </a>

              </div>
            </li>

            <li class="nav-item-divider">
              <span class="nav-link">
                <span></span>
              </span>
            </li>
            <li class="nav-item">
              <a  class="nav-link" href="logout.php" style="cursor: pointer;">
               Logout
              </a>
            </li>
          </ul>

        </div> <!-- / .navbar-collapse -->

      </div> <!-- / .container -->
    </nav>
