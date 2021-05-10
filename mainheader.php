<!doctype html>
<html lang="en">
  
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <script src="validateForm.js"></script>
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
    <script>
   
    function checkAll()
    {
      var fname = document.forms["myform"]["fname"].value;
      var lname = document.forms["myform"]["lname"].value;
      var email = document.forms["myform"]["email"].value;
      var address = document.forms["myform"]["address"].value;
      var phno = document.forms["myform"]["phno"].value;
      var district = document.forms["myform"]["district"].value;
      var pincode = document.forms["myform"]["pincode"].value;
      var pass = document.forms["myform"]["pass"].value;
      var conpass = document.forms["myform"]["conpass"].value;

      if(!/^[A-Za-z ]{3,16}$/.test(fname))
      {
        alert('Enter Correct First Name [A-Z or a-z]');
        return false;
      } 
      
      if(!/^[A-Za-z ]{1,16}$/.test(lname))
      {
        alert('Enter Correct Last Name [A-Z or a-z]');
        return false;
      }  

      if (!/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/.test(email)) 
      {
        alert("You have entered an invalid email address!")
        return false;
      }

      if(address=="")
      {
        alert('Enter Correct Address');
        return false;
      } 

      if(!/^[6-9]{1}[0-9]{9}$/.test(phno))
      {
        alert('Enter Correct Phone starting with 6 7 8 9 digits [10-characters]');
        return false;
      }

      if(district=="null") 
      {
        alert('Select any District');
        return false;
      }

      if(!/^[0-9]{6}$/.test(pincode))
      {
        alert('Enter Correct Pincode [1-9 6-characters]');
        return false;
      }

      if(pass==conpass)
      {
        if(!/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/.test(pass))
        {
          alert("Password must have atleast 1 uppercase 1 lowercase 1 digit and 6 to 20 character length");
          return false;
        }
      }
      else
      {
        alert("Password Mismatch");
        return false
      }

    }


    function checkNewconn()
    {
      var fname = document.forms["myform"]["fname"].value;
      var lname = document.forms["myform"]["lname"].value;
      var email = document.forms["myform"]["email"].value;
      var address = document.forms["myform"]["address"].value;
      var phno = document.forms["myform"]["phno"].value;

      var district = document.forms["myform"]["district"].value;
      var section = document.forms["myform"]["section"].value;

      var pincode = document.forms["myform"]["pincode"].value;
      var supplytype = document.forms["myform"]["supplytype"].value;

      var totalloads = document.forms["myform"]["totalloads"].value;
      var category = document.forms["myform"]["category"].value;

      var aadhar = document.forms["myform"]["aadhar"].value;
      var aadharfile = document.forms["myform"]["aadharfile"].value;

      if(!/^[A-Za-z ]{3,16}$/.test(fname))
      {
        alert('Enter Correct First Name [A-Z or a-z]');
        return false;
      } 
      
      if(!/^[A-Za-z ]{1,16}$/.test(lname))
      {
        alert('Enter Correct Last Name [A-Z or a-z]');
        return false;
      }  

      if (!/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/.test(email)) 
      {
        alert("You have entered an invalid email address!")
        return false;
      }

      if(address=="")
      {
        alert('Enter Correct Address');
        return false;
      } 

      if(!/^[6-9]{1}[0-9]{9}$/.test(phno))
      {
        alert('Enter Correct Phone starting with 6 7 8 9 digits [10-characters]');
        return false;
      }

      if(district=="null") 
      {
        alert('Select any District');
        return false;
      }

      if(section=="null") 
      {
        alert('Select any Section');
        return false;
      }

      if(!/^[0-9]{6}$/.test(pincode))
      {
        alert('Enter Correct Pincode [1-9 6-characters]');
        return false;
      }

      if(supplytype=="null") 
      {
        alert('Select any Supply Type');
        return false;
      }

      if(!/^[0-9]{4}$/.test(totalloads))
      {
        alert('Enter any valid total loads needed.');
        return false;
      }

      if(category=="null") 
      {
        alert('Select any Category');
        return false;
      }

      if(!/^[0-9]{12}$/.test(aadhar))
      {
        alert('Enter 12 digit Aadhar number..');
        return false;
      }

      if(aadharfile=="") 
      {
        alert('Select any documents');
        return false;
      }
     

    }



    function checkBill()
    {
      var conno = document.forms["myform"]["conno"].value;
      var phno = document.forms["myform"]["phno"].value;
      if(!/^[0-9]{13}$/.test(conno))
      {
        alert('Enter 13 digit Consumer Number');
        return false;
      }
      if(!/^[6-9]{1}[0-9]{9}$/.test(phno))
      {
        alert('Enter Correct Phone starting with 6 7 8 9 digits [10-characters]');
        return false;
      }
    }

    function checkpConstatus()
    {
      var appid = document.forms["myform"]["appid"].value;
      var phno = document.forms["myform"]["phno"].value;
      if(!/^[A-Za-z0-9]{8}$/.test(appid))
      {
        alert('Enter 8 digit Application Number');
        return false;
      }
      if(!/^[6-9]{1}[0-9]{9}$/.test(phno))
      {
        alert('Enter Correct Phone starting with 6 7 8 9 digits [10-characters]');
        return false;
      }
    }


    </script>
    <title>KSEBLive 2020  | Welcome</title>
  </head>
  <body>

    <!-- NAVBAR
    ================================================= -->
    <nav class="navbar navbar-expand-xl navbar-dark  navbar-togglable  fixed-top">
      <div class="container">

        <!-- Brand -->
        <a class="navbar-brand" href="index.php">
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
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarWelcome" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Registration
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarWelcome">
                <a class="dropdown-item  active " href="customerreg.php">
                  Customer
                </a>
               
              </div>
            </li>


            

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarLandings" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Services
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarLandings">
                <a class="dropdown-item " href="billview.php">
                  Bill View
                </a>
               
                <a class="dropdown-item " href="publicnewconnection.php">
                  New Connection
                </a>
                <a class="dropdown-item " href="publicconnectionstatus.php">
                  New Connection Status
                </a>
                
              </div>
            </li>

            <!-- <li class="nav-item ">
              <a href="jobs.php" class="nav-link">
                Jobs
              </a>
            </li> 

             <li class="nav-item ">
              <a href="tenders.php" class="nav-link">
                Tenders
              </a>
            </li> -->

           <!--  <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarPages" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Pages
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarPages">
                <li class="dropright">
                  <a class="dropdown-item dropdown-toggle" href="#" id="pagesBlog" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Blog
                  </a>
                  <div class="dropdown-menu" aria-labelledby="pagesBlog">
                    <a class="dropdown-item " href="blog.html">
                      Blog
                    </a>
                    <a class="dropdown-item " href="blog-post.html">
                      Blog: Post
                    </a>
                  </div>
                </li>
                <li class="dropright">
                  <a class="dropdown-item dropdown-toggle" href="#" id="pagesShop" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Shop
                  </a>
                  <div class="dropdown-menu" aria-labelledby="pagesShop">
                    <a class="dropdown-item " href="shop.html">
                      Shop
                    </a>
                    <a class="dropdown-item " href="shop-item.html">
                      Shop: Item
                    </a>
                    <a class="dropdown-item " href="cart.html">
                      Shop: Cart
                    </a>
                    <a class="dropdown-item " href="checkout.html">
                      Shop: Checkout
                    </a>
                  </div>
                </li>
                <li>
                  <a class="dropdown-item " href="about.html">
                    About
                  </a>
                </li>
                <li>
                  <a class="dropdown-item " href="contact.html">
                    Contact
                  </a>
                </li>
                <li>
                  <a class="dropdown-item " href="faq.html">
                    FAQ
                  </a>
                </li>
                <li>
                  <a class="dropdown-item " href="pricing.html">
                    Pricing
                  </a>
                </li>
                <li>
                  <a class="dropdown-item " href="sign-in.html">
                    Sign In
                  </a>
                </li>
                <li>
                  <a class="dropdown-item " href="sign-up.html">
                    Sign Up
                  </a>
                </li>
                <li>
                  <a class="dropdown-item " href="404.html">
                    404
                  </a>
                </li>
              </ul>
            </li> -->
           
           <!--  <li class="nav-item ">
              <a href="documentation.html" class="nav-link">
                Documentation
              </a>
            </li> -->
            <li class="nav-item-divider">
              <span class="nav-link">
                <span></span>
              </span>
            </li>
            <li class="nav-item">
              <a  class="nav-link"  data-toggle="modal" data-target="#exampleModalCenter" style="cursor: pointer;">
                Login
              </a>
            </li>
          </ul>

        </div> <!-- / .navbar-collapse -->
  
      </div> <!-- / .container -->    
    </nav>


<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle" style="text-align: center;">KSEBLive - Login</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="logincheck.php" method="POST">
          <div class="form-group">
            <input type="email" class="form-control" name="email" required="" placeholder="Email">
          </div>
          <div class="form-group">
            <input type="password" class="form-control" name="pass" required="" placeholder="password">
          </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-success">Login</button></form>
      </div>
    </div>
  </div>
</div>
<!-- Modal End -->
