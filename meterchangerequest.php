<?php
 	include 'connection.php';
  	session_start();
	if(isset($_COOKIE['logined']) && $_COOKIE['logined']==1)
	{
    include 'custheader.php'; ?>

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
			               				<input type="text" name="fname" id="first_name" class="form-control input-sm" placeholder="Full Name">
			    					</div>
			    				</div>

			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<select class="form-control bfh-states" data-country="US" data-state="CA" name="section">
			               					<option value="null">Section Code</option>
			               					<option>001 - Mundakayam</option>
			               					<option>002 - Kuttikanm</option>
			               					<option>003 - Perumede</option>
			               					<option>004 - Kanjirampally</option>
			               				</select>
			    					</div>
			    				</div>
			    			</div>
			 
			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			               				<input type="text" name="conno" id="first_name" class="form-control input-sm" placeholder="Consumer Number">
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			               				<input type="text" name="phno" id="first_name" class="form-control input-sm" placeholder="Contact Number">
			    					</div>
			    				</div>
			    			</div>

			    			
			    			<div class="form-group">
			    				<textarea rows="4" class="form-control input-sm" placeholder="Enter the reason for meter change ...!!" name="comdesc"></textarea>
			    			</div>

			    			
			    			
			    			<input type="submit" value="Register" class="btn btn-info btn-block" >
			    		
			  
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