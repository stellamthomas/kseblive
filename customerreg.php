<?php 
    include 'mainheader.php'; ?>

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
			               				<input type="text" name="fname" id="fname" class="form-control input-sm" placeholder="First Name" >
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="text" name="lname"  class="form-control input-sm" placeholder="Last Name" >
			    					</div>
			    				</div>
			    			</div>

			    			<div class="form-group">
			    				<input type="email" name="email"  class="form-control input-sm" placeholder="Email Address"  >
			    			</div>
			    			<div class="form-group">
			    				<textarea rows="2" class="form-control input-sm" name="address" placeholder="Address" ></textarea>
			    			</div>

			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			               				<input type="text" name="phno" class="form-control input-sm" placeholder="Phone Number" >
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
			               				<select class="form-control bfh-states" name="district" data-country="US" data-state="CA" >
			               					<option value="null">Select District</option>
			               					<option value="Trivandrum">Trivandrum</option>
			               					<option value="Kollam">Kollam</option>
			               					<option value="Idukki">Idukki</option>
			               					<option value="Kottayam">Kottayam</option>
			               				</select>

			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="text" name="pincode" class="form-control input-sm" placeholder="Pincode" >
			    					</div>
			    				</div>
			    			</div>




			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="password" name="pass" class="form-control input-sm" placeholder="Password" >
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="password" name="conpass" class="form-control input-sm" placeholder="Confirm Password" >
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