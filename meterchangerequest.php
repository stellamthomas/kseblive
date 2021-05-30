<?php
session_start();
if(isset($_SESSION['logined']) && $_SESSION['logined']==1)
{ 
	include 'connection.php';
    include 'custheader.php'; ?>
<script type="text/javascript">
	function firstName() {
		var f1 = document.getElementById("f1");
		var fname = document.getElementById('fname').value;

		if(!/^[A-Za-z ]{3,19}$/.test(fname))
	     {
	       f1.textContent = "**Invalid Full Name";
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

	function distUser()
	{

		var f6 = document.getElementById("f6");
		var district = document.getElementById('district').value;

		if(district=="null")
		{
			f6.textContent = "**Select any Section Code";
			document.getElementById("district").focus();
			return false;
		}
		else
		{
			f6.textContent = "";
			return true;
		}
	}

	function distPin() 
{
	var f8 = document.getElementById("f8");
	var pincode = document.getElementById('pincode').value;

	if(!/^[0-9]{13}$/.test(pincode))
     {
       f8.textContent = "**Enter Correct Consumer Number";
       document.getElementById("pincode").focus();
       return false;
     }
     else
     {
     	f8.textContent = "";
     	return true;
     }
}

function phoneUser() 
{
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

function sectionUserz() 
	{

		var f6sz = document.getElementById("f6sz");
		var districtsz = document.getElementById('districtsz').value;

		if(districtsz=="null")
	     {
	       f6sz.textContent = "**Select Any Purpose Type";
	       document.getElementById("districtsz").focus();
	       return false;
	     }
	     else
	     {
	     	f6sz.textContent = "";
	     	return true;
	     }
	  }

	  function sectionUserzz() 
	{

		var f6szz = document.getElementById("f6szz");
		var districtszz = document.getElementById('districtszz').value;

		if(!/^[a-zA-Z .]{10,50}$/.test(districtszz))
	     {
	       f6szz.textContent = "**Input Valid Description, 10Characters Minimum";
	       document.getElementById("districtszz").focus();
	       return false;
	     }
	     else
	     {
	     	f6szz.textContent = "";
	     	return true;
	     }
	  }

	  

	function checkAllzzz()
	{
		if(firstName()&&distUser()&&distPin()&&phoneUser()&&sectionUserzz())
		{
			return true;
		}
		else
		{
			return false;
		}
	}



</script>

      <section class="section section-top section-full">

      <!-- Cover -->
      <div class="bg-cover" style="background-image: url(assets/img/aa.jpg);"></div>

      <!-- Overlay -->
      <div class="bg-overlay"></div>

      <!-- Triangles -->
      <div class="bg-triangle bg-triangle-light bg-triangle-bottom bg-triangle-left"></div>
      <div class="bg-triangle bg-triangle-light bg-triangle-bottom bg-triangle-right"></div>

      <!-- Content -->
      <div class="container">
        <div class="row justify-content-center align-items-center"><h2 style="text-align: center;color: white;">Meter Change Request</h2>
          <div class="col-md-8 col-lg-7">
          		
          	<form role="form" method="POST" action="meterchangerequest1.php" name="myform">
			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			               				<input type="text" name="fname"  class="form-control input-sm" placeholder="Full Name" id="fname" onkeyup="firstName()">
			               				<span style="color: red;font-size: 14px" id="f1"></span>


			    					</div>
			    				</div>

			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<select class="form-control bfh-states" data-country="US" data-state="CA" name="section" id="district" onclick="distUser()">

			               					<option value="null">Section Code</option>
			               					<option>001 - Mundakayam</option>
			               					<option>002 - Kuttikanm</option>
			               					<option>003 - Perumede</option>
			               					<option>004 - Kanjirampally</option>
			               				</select>
			               				<span style="color: red;font-size: 14px" id="f6"></span>

			    					</div>
			    				</div>
			    			</div>
			 
			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			               				<input type="text" name="conno" class="form-control input-sm" placeholder="Consumer Number" id="pincode" onkeyup="distPin()">
                  <span style="color: red;font-size: 14px" id="f8"></span>

			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			               				<input type="text" name="phno"  class="form-control input-sm" placeholder="Contact Number" id="phone" onkeyup="phoneUser()">
                  <span style="color: red;font-size: 14px" id="f5"></span>
			    					</div>
			    				</div>
			    			</div>

			    			
			    			<div class="form-group">
			    				<textarea rows="4" class="form-control input-sm" placeholder="Enter the reason for meter change ...!!" name="comdesc"  id="districtszz" onkeyup="sectionUserzz()"></textarea>
							<span style="color: red;font-size: 14px" id="f6szz"></span>
			    			</div>

			    			
			    			
			    			<input type="submit" value="Register" class="btn btn-info btn-block" onclick="return checkAllzzz()">
			    		
			  
			    		</form>


          </div>
        </div> <!-- / .row -->
      </div> <!-- / .container -->

    </section>

    <!-- SECTIONS -->
<?php
    include 'mainfooter.php';
}
	else
	{
		Header("location:index.php");
	}
?>