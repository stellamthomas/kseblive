<?php 
    include 'mainheader.php'; ?>
    <script src="validation/consumerreg.js"></script>
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
        <div class="row justify-content-center align-items-center"><h2 style="text-align: center;color: white;">Customer Registration</h2>
          <div class="col-md-8 col-lg-7">
          		
          	<form role="form" method="POST" action="customerreg1.php" name="myform">
			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			               				<input type="text" name="fname" id="fname" class="form-control input-sm" placeholder="First Name" 
			               				id="fname" onkeyup="firstName()">
									<span style="color: red;font-size: 14px" id="f1"></span>
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="text" name="lname"  class="form-control input-sm" placeholder="Last Name" id="lname" onkeyup="lastName()">
									<span style="color: red;font-size: 14px" id="f2"></span>
			    					</div>
			    				</div>
			    			</div>

			    			<div class="form-group">
			    				<input type="email" name="email"  class="form-control input-sm" placeholder="Email Address"   id="email" onkeyup="emailUser()">
							<span style="color: red;font-size: 14px" id="f3"></span>
			    			</div>
			    			<div class="form-group">
			    				<textarea rows="2" class="form-control input-sm" name="address" placeholder="Address" id="address" onkeyup="addrUser()"></textarea>
							<span style="color: red;font-size: 14px" id="f4"></span>
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
			    						<div class="form-check"><label class="form-check-input" for="exampleRadios1" style="color: white;font-weight: bold;">Gender</label><br>
										  <input class="form-check-input" type="radio" name="gender" value="Male" checked>
										  <label class="form-check-label" for="exampleRadios1" style="color: white;">
										    Male &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										  </label>

										  <input class="form-check-input" type="radio" name="gender" value="Female" >
										  <label class="form-check-label" for="exampleRadios2" style="color: white;">
										    Female
										  </label>
										</div>
			    					</div>
			    				</div>
			    			</div>


			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			               				<select class="form-control bfh-states" name="district" data-country="US" data-state="CA" id="district" onclick="distUser()">
			               					<option value="null">Select District</option>
			               					<option value="Trivandrum">Trivandrum</option>
			               					<option value="Kollam">Kollam</option>
			               					<option value="Idukki">Idukki</option>
			               					<option value="Kottayam">Kottayam</option>
			               				</select>
			               							    					<span style="color: red;font-size: 14px" id="f7"></span>
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="text" name="pincode" class="form-control input-sm" placeholder="Pincode" id="pincode" onkeyup="distPin()">
									<span style="color: red;font-size: 14px" id="f8"></span>
			    					</div>
			    				</div>
			    			</div>




			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="password" name="pass" class="form-control input-sm" placeholder="Password" id="pass" onkeyup="passUser()">
									<span style="color: red;font-size: 14px" id="f9"></span>

			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="password" name="conpass" class="form-control input-sm" placeholder="Confirm Password" id="conpass" onkeyup="conpassUser()">
									<span style="color: red;font-size: 14px" id="f10"></span>

			    					</div>
			    				</div>
			    			</div>
			    			
			    			<input type="submit" value="Register" class="btn btn-info btn-block" onclick="return checkAll()"> 
			    		
			    		</form>
						
          </div>
        </div> <!-- / .row -->
      </div> <!-- / .container -->

    </section>

    <!-- SECTIONS -->
<?php
    include 'mainfooter.php';
?>