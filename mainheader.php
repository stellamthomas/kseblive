<?php
session_start(); // this MUST be called prior to any output including whitespaces and line breaks!

$GLOBALS['ct_recipient']   = 'YOU@EXAMPLE.COM'; // Change to your email address!
$GLOBALS['ct_msg_subject'] = 'Securimage Test Contact Form';

$GLOBALS['DEBUG_MODE'] = 1;
// CHANGE TO 0 TO TURN OFF DEBUG MODE
// IN DEBUG MODE, ONLY THE CAPTCHA CODE IS VALIDATED, AND NO EMAIL IS SENT


// Process the form, if it was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$_POST['do'] == 'contact') {
    // if the form has been submitted

    foreach($_POST as $key => $value) {
        if (!is_array($key)) {
            // sanitize the input data
            if ($key != 'ct_message') $value = strip_tags($value);
            $_POST[$key] = htmlspecialchars(stripslashes(trim($value)));
        }
    }

   
    $captcha = @$_POST['ct_captcha']; // the user's entry for the captcha code

    $errors = array();  // initialize empty error array

    // Only try to validate the captcha if the form has no errors
    // This is especially important for ajax calls
    if (sizeof($errors) == 0) {
        require_once dirname(__FILE__) . '/securimage.php';
        $securimage = new Securimage();

        if ($securimage->check($captcha) == false) {
			$_SESSION["username"] = $_POST['email'];
			$_SESSION["pass"] = $_POST["password"];
			echo $_SESSION["pass"];exit;
            echo "<script type='text/javascript'>alert('Incorrect security code')</script>";
		}
		else
		{
			echo "<script type='text/javascript'>alert('Correct security code')</script>";
		}
    }


}  ?>
<!DOCTYPE html>
<html lang="en">
	<meta http-equiv="content-type" content="text/html;charset=ISO-8859-1" />

	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge" /> 
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>KSEBLive</title>

		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
		<link rel="stylesheet"  href="css/style.css" />
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		
		<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
		

	<!--Font Section starts-->
		<link href="https://fonts.googleapis.com/css2?family=PT+Sans+Caption&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Merienda+One" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" >  
        <link href="https://fonts.googleapis.com/css?family=Abril+Fatface|Source+Serif+Pro|Trade+Winds|Zilla+Slab&amp;display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:wght@700&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Source+Code+Pro:ital,wght@1,700&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Play&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@500&display=swap" rel="stylesheet"> 


	<!--Font Section ends-->
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>	
		<script type='text/javascript'>

			function refreshCaptcha()
			{
				var img = document.images['captchaimg'];
				img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
			}
		</script>

	</head>

	<body>
		<div id="wrapper">

		<!-- header section -->
			<header>
				<div class="inner_wrap">
				<div class="logo">
					<img src="images/kseb.jpg" alt="" height="60" width="100" style="float:left;padding:18px 0px 0px 0px;margin-top:12px ;">
					<p style="font-size:20px;margin-top: 35px;font-family: 'PT Sans Caption', sans-serif;"><a href="index.php" style="text-decoration: none;color:black;">Kerala State Electricty Board<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Live</a></p>
				</div>
				<div class="logo1">
					<img src="images/kseb.jpg" alt="" height="100" width="30" style="float:left;padding:18px 0px 0px 0px;">
					<p style="font-size:20px;margin-top: 35px;font-family: 'PT Sans Caption', sans-serif;">Kerala State Electricty Board<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Live</p>
				</div>
				<nav id="navi" style="margin-top: 38px;">
					<ul id="menu">
						<li><a style="text-decoration: none;" href="#">Registration</a>
						<ul>
							<li style="padding-top: 10px;padding-bottom: 20px;"> <a style="text-decoration: none;"   href="customerreg.php"> Customer</a> </li>
							<li style="padding-top: 10px;padding-bottom: 20px;"> <a style="text-decoration: none;"   href="contractorreg.php"> Contractor</a> </li>
						</ul>
						</li>
						<li><a style="text-decoration: none;" href="#">Services</a>
						<ul>
							<li style="padding-top: 10px;padding-bottom: 20px;"> <a style="text-decoration: none;" href="quickpay.php">Bill View</a> </li>
							<li style="padding-top: 10px;padding-bottom: 20px;"> <a style="text-decoration: none;"   href="publiccomplaintreg.php">Complaints</a> </li>
							<li style="padding-top: 10px;padding-bottom: 20px;"> <a style="text-decoration: none;"   href="newconnection.php">New Connection</a> </li>
							<li style="padding-top: 10px;padding-bottom: 20px;"> <a style="text-decoration: none;"   href="connectionstatus.php">Application Status</a> </li>
						</ul>
						</li>
	<!--
						<li id="upload_image" style="cursor: default;">   <a href="#" class="noclick"  style="cursor: default;">Dashboard</a> <img src="resources/images/uploading.gif" width="35" height="35"></li> -->
						<li><a style="text-decoration: none;" href="jobs.php">Jobs </a></li>
						<li><a style="text-decoration: none;"  href="tenders.php">Tenders</a></li>
						
						<li class="last">   
							<a  style="text-decoration: none;" href="" id="myModal" class="" data-toggle="modal" data-target="#exampleModalCenter">Login</a> 
						</li>		
					</ul>
				</nav>
				<a href="https://www.digitalindia.gov.in/"  target="_blank" class="top_digi"><img src="images/top_digital.png" alt=""></a>
				</div>
			</header>
			<section class="banner_new">
				<div class="inner_wrap"> </div>
			</section>


<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle"><p style="margin-left: 145px; font-family: 'Play', sans-serif; font-size:24px">Login - KSEBLive</p></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left: 0px;">
          <span aria-hidden="true">&times;</span>
        </button>
	  </div>
	  
<form action="" method="POST" id="contact_form" onsubmit="return processForm()">
<input type="hidden" name="do" value="contact" />
      <div class="modal-body">
		<div class="input-group input-group-lg">
			<input type="email" name="email" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Username">
		</div>
<br>
		<div class="input-group input-group-lg">
			<input type="password" name="password" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Password">
		</div>

		<div class="input-group input-group-lg">

<!-- Captcha Start -->	
			<table width="400" border="0" align="center" cellpadding="5" cellspacing="1" class="table">
				<tr>
					<th align="right" valign="top"> Validation Code:</th>
					<td><?php require_once 'securimage.php'; echo Securimage::getCaptchaHtml(array('input_name' => 'ct_captcha')); ?></td>
				</tr>
			</table>
<!-- Captcha End -->


		</div>

	   </div>
       <div class="modal-footer">
		
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<!--	<a style="text-decoration: none; cursor:pointer;" >
		Forgot Password
		</a> -->
		&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <button name="Submit" type="submit"  value="Submit" class="btn btn-primary" style="cursor:pointer" >Log In</button>
	  </div>
	  
	</form>  

    </div>
  </div>
</div>


		<!-- end header section -->