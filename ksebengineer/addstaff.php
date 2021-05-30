<?php
session_start();
if(isset($_SESSION['logined']) && $_SESSION['logined']==1)
{  include 'engheader.php'; ?>
<script type="text/javascript">
  function firstName() {
    var f1 = document.getElementById("f1");
    var fname = document.getElementById('fname').value;

    if(!/^[A-Za-z ]{5,16}$/.test(fname))
       {
         f1.textContent = "**Invalid First Name";
         var x = document.getElementById("fname");
         x.focus();
         return false;
       }
       else
       {
        f1.textContent = "";
        return true;
       }
  }

  function lastName() {
    var f2 = document.getElementById("f2");
    var lname = document.getElementById('lname').value;

    if(!/^[A-Za-z ]{1,16}$/.test(lname))
       {
         f2.textContent = "**Invalid Last Name";
         document.getElementById("lname").focus();
         return false;
       }
       else
       {
        f2.textContent = "";
        return true;
       }
  }

  function addrUser() {
    var f3 = document.getElementById("f3");
    var address = document.getElementById('address').value;

    if (!/^[#.0-9a-zA-Z\s,-]{8,50}$/.test(address))
       {
         f3.textContent = "**Invalid Address Format";
         document.getElementById("address").focus();
         return false;
       }
       else
       {
        f3.textContent = "";
        return true;
       }
  }

  function emailUser() {
    var f4 = document.getElementById("f4");
    var email = document.getElementById('email').value;

    if (!/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/.test(email))
       {
         f4.textContent = "**Invalid Email Format";
         document.getElementById("email").focus();
         return false;
       }
       else
       {
        f4.textContent = "";
        return true;
       }
  }

  function phoneUser() {
    var f5 = document.getElementById("f5");
    var phone = document.getElementById('phone').value;

    if(!/^[6-9]{1}[0-9]{9}$/.test(phone))
       {
         f5.textContent = "**Invalid Phone # Format";
         document.getElementById("phone").focus();
         return false;
       }
       else
       {
        f5.textContent = "";
        return true;
       }
  }


  function distUser() {

    var f6 = document.getElementById("f6");
    var district = document.getElementById('district').value;

    if(district=="null")
       {
         f6.textContent = "**Select any District";
         document.getElementById("district").focus();
         return false;
       }
       else
       {
        f6.textContent = "";
        return true;
       }
  }

  function sectionUser() {

    var f6s = document.getElementById("f6s");
    var districts = document.getElementById('districts').value;

    if(districts=="null")
       {
         f6s.textContent = "**Select any Nearest Section";
         document.getElementById("districts").focus();
         return false;
       }
       else
       {
        f6s.textContent = "";
        return true;
       }
  }


  function distPin() {

    var f7 = document.getElementById("f7");
    var pincode = document.getElementById('pincode').value;

    if(!/^[0-9]{6}$/.test(pincode))
       {
         f7.textContent = "**Enter Correct Pincode";
         document.getElementById("pincode").focus();
         return false;
       }
       else
       {
        f7.textContent = "";
        return true;
       }
  }


function checkNewconn() {

    if(firstName()&&lastName()&&emailUser()&&addrUser()&&phoneUser()&&distUser()&&sectionUser()&&distPin())
       {
         return true;
       }
       else
       {
        return false;
       }
  }
</script>
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Add Staff</h1>
                    <p class="mb-4"></p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">

                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Registration Form</h6>
                        </div>
                        <div class="card-body" >


                          <form role="form" action="staffreg.php" method="post" enctype="multipart/form-data" name="myform">
              			    			<div class="row">
              			    				<div class="col-xs-6 col-sm-6 col-md-6">
              			    					<div class="form-group">
              			               				<input type="text" name="fname" class="form-control input-sm" placeholder="First Name" id="fname" onkeyup="firstName()">
                  <span style="color: red;font-size: 14px" id="f1"></span>
              			    					</div>
              			    				</div>
              			    				<div class="col-xs-6 col-sm-6 col-md-6">
              			    					<div class="form-group">
              			    						<input type="text" name="lname" class="form-control input-sm" placeholder="Last Name" id="lname" onkeyup="lastName()">
                  <span style="color: red;font-size: 14px" id="f2"></span>
              			    					</div>
              			    				</div>
              			    			</div>

              			    			<div class="form-group">
              			    				<input type="email" name="email"  class="form-control input-sm" placeholder="Email Address" id="email" onkeyup="emailUser()">
              <span style="color: red;font-size: 14px" id="f4"></span>

              			    			</div>
              			    			<div class="form-group">
              			    				<textarea rows="2" name="address" class="form-control input-sm" placeholder="Address" id="address" onkeyup="addrUser()"></textarea>
              <span style="color: red;font-size: 14px" id="f3"></span>

              			    			</div>

              			    			<div class="row">
              			    				<div class="col-xs-6 col-sm-6 col-md-6">
              			    					<div class="form-group">
              			               				<input type="text" name="phno" class="form-control input-sm" placeholder="Phone Number" id="phone" onkeyup="phoneUser()">
                                          <span style="color: red;font-size: 14px" id="f5"></span>

              			    					</div>
              			    				</div>
              			    				<div class="col-xs-6 col-sm-6 col-md-6">
              			    					<div class="form-group">
              			    						<div class="form-check"><label class="form-check-input" for="exampleRadios1" style="color: Gender;font-weight: bold;">Gender</label><br>
                <input class="form-check-input" type="radio" name="gender" value="Male" checked>
                <label class="form-check-label" for="exampleRadios1" style="color: grey;">
                  Male &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </label>

                <input class="form-check-input" type="radio" name="gender" value="Female">
                <label class="form-check-label" for="exampleRadios2" style="color: grey;">
                  Female
                </label>
              </div>
              			    					</div>
              			    				</div>
              			    			</div>

                              <div class="row">
              			    				<div class="col-xs-6 col-sm-6 col-md-6">
                                  <div class="form-group">
              			               				<select class="form-control bfh-states" data-country="US" data-state="CA" name="district" id="district" onclick="distUser()">

              			               					<option value="null">District</option>
              			               					<option value="Idukki">Idukki</option>
              			               					<option value="Kottayam">Kottayam</option>
              			               				</select>
                                          <span style="color: red;font-size: 14px" id="f6"></span>

              			    					</div>
              			    				</div>
              			    				<div class="col-xs-6 col-sm-6 col-md-6">
                                  <div class="form-group">
                                    <select class="form-control bfh-states" data-country="US" data-state="CA" name="section" id="districts" onclick="sectionUser()">

                                      <option value="null">Section Code</option>
                                      <option value="Mundakayam [5302]">001 - Mundakayam</option>
                                      <option value="Kuttikanam [5303]">002 - Kuttikanm</option>
                                      <option value="Perumede [5304]">003 - Perumede</option>
                                      <option value="Kanjirampally [5305]">004 - Kanjirampally</option>
                                    </select>
                                    <span style="color: red;font-size: 14px" id="f6s"></span>

              			    					</div>
              			    				</div>
              			    			</div>


                              <div class="form-group">
                                <input type="text" name="pincode" class="form-control input-sm" placeholder="Pincode" id="pincode" onkeyup="distPin()">
                  <span style="color: red;font-size: 14px" id="f7"></span>
                              </div>
  			    			<input type="submit" value="Add Staff" class="btn btn-info btn-block" onclick="return checkNewconn()" >

              			    		</form>




                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->
<?php include 'engfooter.php'; }
  else
  {
  Header("location:../index.php");
  }
?>