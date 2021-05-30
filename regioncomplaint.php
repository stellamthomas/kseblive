<?php
session_start();
if(isset($_SESSION['logined']) && $_SESSION['logined']==1)
{ 
	include 'connection.php';
    include 'custheader.php'; ?>

      <section class="section section-top section-full">
<script type="text/javascript">

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
	
	function sectionUser() 
	{

		var f6s = document.getElementById("f6s");
		var districts = document.getElementById('districts').value;

		if(districts=="null")
	     {
	       f6s.textContent = "**Select Your Complaint Type";
	       document.getElementById("districts").focus();
	       return false;
	     }
	     else
	     {
	     	f6s.textContent = "";
	     	return true;
	     }
	}


	function addrUser() 
	{
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
		if(sectionUser()&&distUser()&&addrUser())
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
        <div class="row justify-content-center align-items-center"><h2 style="text-align: center;color: white;">Complaint Registration</h2>
          <div class="col-md-8 col-lg-7">
          		
          	<form role="form" method="POST" action="complaintreg2.php" name="myform">
			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			               				<select class="form-control bfh-states" data-country="US" data-state="CA" name="comtype" id="districts" onclick="sectionUser()">
			               					<option value="null">Complaint Type</option>
			               					<option>Cable Broken</option>
			               					<option>No Power Supply</option>
			               					<option>Voltage High/Low</option>
			               					<option>Broken Wires</option>
			               				</select>
			               				<span style="color: red;font-size: 14px" id="f6s"></span>
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

			    			
			    			<div class="form-group">
			    				<textarea rows="4" class="form-control input-sm" placeholder="Enter your complaint description here ...!!!" name="comdesc" name="comdesc" id="address" onkeyup="addrUser()"></textarea>
<span style="color: red;font-size: 14px" id="f3"></span>
		    			</div>

			    			
			    			
			    			<input type="submit" value="Register" class="btn btn-info btn-block" onclick="return checkAll()" >	
			    		>
			    		
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