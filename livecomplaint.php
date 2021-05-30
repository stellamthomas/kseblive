<?php
session_start();
if(isset($_SESSION['logined']) && $_SESSION['logined']==1)
{ 
	include 'connection.php';
    include 'custheader.php'; ?>
    <script>
    	function distUser() {

		var f6 = document.getElementById("f6");
		var district = document.getElementById('district').value;

		if(district=="null")
	     {
	       f6.textContent = "**Select any Complaint Type";
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
	       f6s.textContent = "**Select Your Section";
	       document.getElementById("districts").focus();
	       return false;
	     }
	     else
	     {
	     	f6s.textContent = "";
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

	function addrUser() {
		var f3 = document.getElementById("f3");
		var address = document.getElementById('address').value;

		if (!/^[#.0-9a-zA-Z\s,-]{10,100}$/.test(address))
	     {
	       f3.textContent = "**Invalid Complaint Description. Minimum 10 Characters Format";
	       document.getElementById("address").focus();
	       return false;
	     }
	     else
	     {
	     	f3.textContent = "";
	     	return true;
	     }
	}

function checkAll()
{
	if(distUser()&&sectionUser()&&phoneUser()&&addrUser())
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
        <div class="row justify-content-center align-items-center"><h2 style="text-align: center;color: white;">Live Complaint Registration</h2>
          <div class="col-md-8 col-lg-7">
          		
          	<form role="form" method="POST" action="complaintreg3.php" name="myform">
			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			               				<select class="form-control bfh-states" data-country="US" data-state="CA" name="comtype" id="district" onclick="distUser()">
			               					<option value="null">Complaint Type</option>
			               					<option>Cable Broken</option>
			               					<option>No Power Supply</option>
			               					<option>Voltage High/Low</option>
			               					<option>Broken Wires</option>
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
			    				<input type="text" name="phno" class="form-control input-sm" placeholder="Phone Number" id="phone" onkeyup="phoneUser()">
									<span style="color: red;font-size: 14px" id="f5"></span>

			    				<input type="hidden" name="email" class="form-control input-sm" placeholder="Email" value="<?php echo $_COOKIE['email']; ?>"> 
			    			</div>
			    			
			    			<div class="form-group">
			    				<textarea rows="4" class="form-control input-sm" placeholder="Enter your complaint description here ...!!!" name="comdesc" id="address" onkeyup="addrUser()"></textarea>
							<span style="color: red;font-size: 14px" id="f3"></span>

			    			</div>

			    			
			    			
			    			<input type="submit" value="Register" class="btn btn-info btn-block" onclick="return checkAll()" >
			    		
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