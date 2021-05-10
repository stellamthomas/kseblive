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
        <div class="row justify-content-center align-items-center"><h2 style="text-align: center;color: white;">Additional Supply Request</h2>
          <div class="col-md-8 col-lg-7">
          		
          	<form role="form" method="POST" action="addsupplyrequest1.php" name="myform">
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
                                      <option value="Mundakayam [5302]">001 - Mundakayam</option>
                                      <option value="Kuttikanam [5303]">002 - Kuttikanm</option>
                                      <option value="Perumede [5304]">003 - Perumede</option>
                                      <option value="Kanjirampally [5305]">004 - Kanjirampally</option>
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

			    			
			    			<div class="row">
							<div class="col-xs-6 col-sm-6 col-md-6">
								<div class="form-group">
									<select class="form-control bfh-states" data-country="US" data-state="CA" name="comdesc">
			               					<option value="null">Purpose - INR/day</option>
			               					<option value="House Construction">House Construction - 100INR</option>
			               					<option value="Agriculture Works">Agriculture Works - 145INR</option>
			               					<option value="Gates and Doors Work">Gates and Doors Works - 70INR</option>
			               					<option value="Roof Works">Roof Works - 90INR</option>
			               				</select>
								</div>
							</div>
							<div class="col-xs-6 col-sm-6 col-md-6">
								<div class="form-group">
									<input type="text" name="tdays"  class="form-control input-sm" placeholder="Total Days">
								</div>
							</div>
						</div>

			    			<div class="row">
							<div class="col-xs-6 col-sm-6 col-md-6">
								<div class="form-group">
									<input type="text" name="fdate" class="form-control input-sm" placeholder="From Date" onfocus="(this.type='date')">
								</div>
							</div>
							<div class="col-xs-6 col-sm-6 col-md-6">
								<div class="form-group">
									<input type="text" name="tdate"  class="form-control input-sm" placeholder="To Date" onfocus="(this.type='date')">
								</div>
							</div>
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