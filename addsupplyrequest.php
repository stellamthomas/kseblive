<?php
session_start();
if(isset($_SESSION['logined']) && $_SESSION['logined']==1)
{ 
	include 'connection.php';
    include 'custheader.php'; ?>

      <section class="section section-top section-full">
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

		if(!/^[1-9]{1}$/.test(districtszz))
	     {
	       f6szz.textContent = "**Input Total Days Needed, Min : 9Days";
	       document.getElementById("districtszz").focus();
	       return false;
	     }
	     else
	     {
	     	f6szz.textContent = "";
	     	return true;
	     }
	  }

	  function startDate() {

		var s1 = document.getElementById("s1");
		var sdate = document.getElementById('sdate').value;

		if(sdate=="")
	     {
	       s1.textContent = "**Select Any Start Date";
	       document.getElementById("sdate").focus();
	       return false;
	     }
	     else
	     {
	     	s1.textContent = "";
	     	return true;
	     }
	}

	function endDate() {

		var e1 = document.getElementById("e1");
		var edate = document.getElementById('edate').value;

		if(edate=="")
	     {
	       e1.textContent = "**Select Any End Date";
	       document.getElementById("edate").focus();
	       return false;
	     }
	     else
	     {
	     	e1.textContent = "";
	     	return true;
	     }
	}

	function checkAllzzz()
	{
		if(firstName()&&distUser()&&distPin()&&phoneUser()&&sectionUserz()&&sectionUserzz()&&startDate()&&endDate())
		{
			return true;
		}
		else
		{
			return false;
		}
	}



</script>
      <!-- Cover -->
      <div class="bg-cover" style="background-image: url(assets/img/aa.jpg);"></div>

      <!-- Overlay -->
      <div class="bg-overlay"></div>

      <!-- Triangles -->
      <div class="bg-triangle bg-triangle-light bg-triangle-bottom bg-triangle-left"></div>
      <div class="bg-triangle bg-triangle-light bg-triangle-bottom bg-triangle-right"></div>

      <!-- Content -->
      <div class="container">
        <div class="row justify-content-center align-items-center"><h2 style="text-align: center;color: white;">Additional Supply Request</h2>
          <div class="col-md-8 col-lg-7">
          		
          	<form role="form" method="POST" action="addsupplyrequest1.php" name="myform">
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
                                      <option value="Mundakayam [5302]">001 - Mundakayam</option>
                                      <option value="Kuttikanam [5303]">002 - Kuttikanm</option>
                                      <option value="Perumede [5304]">003 - Perumede</option>
                                      <option value="Kanjirampally [5305]">004 - Kanjirampally</option>
			               				</select>
														<span style="color: red;font-size: 14px" id="f6"></span>
			    					</div>
			    				</div>
			    			</div>
			 
			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			               				<input type="text" name="conno"  class="form-control input-sm" placeholder="Consumer Number" id="pincode" onkeyup="distPin()">
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

			    			
			    			<div class="row">
							<div class="col-xs-6 col-sm-6 col-md-6">
								<div class="form-group">
									<select class="form-control bfh-states" data-country="US" data-state="CA" name="comdesc" id="districtsz" onclick="sectionUserz()">
			               					<option value="null">Purpose - INR/day</option>
			               					<option value="House Construction">House Construction - 100INR</option>
			               					<option value="Agriculture Works">Agriculture Works - 145INR</option>
			               					<option value="Gates and Doors Work">Gates and Doors Works - 70INR</option>
			               					<option value="Roof Works">Roof Works - 90INR</option>
			               				</select>
			               				<span style="color: red;font-size: 14px" id="f6sz"></span>
								</div>
							</div>
							<div class="col-xs-6 col-sm-6 col-md-6">
								<div class="form-group">
									<input type="text" name="tdays"  class="form-control input-sm" placeholder="Total Days" id="districtszz" onkeyup="sectionUserzz()">
<span style="color: red;font-size: 14px" id="f6szz"></span>
								</div>
							</div>
						</div>

			    			<div class="row">
							<div class="col-xs-6 col-sm-6 col-md-6">
								<div class="form-group">
									<input type="text" name="fdate" class="form-control input-sm" placeholder="From Date" onfocus="(this.type='date')" id="sdate" onfocusout="startDate()">
									<span style="color: red;font-size: 14px" id="s1"></span>

								</div>
							</div>
							<div class="col-xs-6 col-sm-6 col-md-6">
								<div class="form-group">
									<input type="text" name="tdate"  class="form-control input-sm" placeholder="To Date" onfocus="(this.type='date')" id="edate" onfocusout="endDate()">
									<span style="color: red;font-size: 14px" id="e1"></span>
								</div>
							</div>
						</div>

			    			
			    			
			    			<input type="submit" value="Register" class="btn btn-info btn-block" onclick="return checkAllzzz()" >
			    		
			  
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