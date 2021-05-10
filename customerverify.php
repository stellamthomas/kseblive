<?php
    session_start();

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
        <div class="row justify-content-center align-items-center"><h2 style="text-align: center;color: white;">OTP Verification</h2>
          <div class="col-md-8 col-lg-7">
          		
          	<form role="form" method="POST" action="viewconfirm.php">
			    			
			    			<div class="form-group">
			    				<input type="password"  name="otpget""  class="form-control input-sm" placeholder="Enter your OTP here..." required="">
			    			</div>
			    			
			    			
			    			<input type="submit" value="Confirm OTP" class="btn btn-info btn-block">
			    		
			    		</form>


          </div>
        </div> <!-- / .row -->
      </div> <!-- / .container -->

    </section>

    <!-- SECTIONS -->
<?php
    include 'mainfooter.php';
?>