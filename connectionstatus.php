<?php 
    include 'mainheader.php'; ?>

      <section class="section section-top section-full">

      <!-- Cover -->
      <div class="bg-cover" style="background-image: url(assets/img/aa.jpg);"></div>
<br><br>
      <!-- Overlay -->
      <div class="bg-overlay"></div>

      <!-- Triangles -->
      <div class="bg-triangle bg-triangle-light bg-triangle-bottom bg-triangle-left"></div>
      <div class="bg-triangle bg-triangle-light bg-triangle-bottom bg-triangle-right"></div>

      <!-- Content -->
      <div class="container">
        <div class="row justify-content-center align-items-center"><h2 style="text-align: center;color: white;">Connection Status</h2>
          <div class="col-md-8 col-lg-7">
          		
          	<form role="form">
			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			               				<input type="text" name="first_name" id="first_name" class="form-control input-sm" placeholder="Application ID">
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			               				<input type="text" name="first_name" id="first_name" class="form-control input-sm" placeholder="Phone Number">
			    					</div>
			    				</div>
			    				
			    			</div>
			 
			    			
			    			<input type="submit" value="Check Status" class="btn btn-info btn-block">
			    		
			    		</form>


          </div>
        </div> <!-- / .row -->
      </div> <!-- / .container -->
<br>
    </section>

    <!-- SECTIONS -->
<?php
    include 'mainfooter.php';
?>