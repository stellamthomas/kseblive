<?php
session_start();
if(isset($_SESSION['logined']) && $_SESSION['logined']==1)
{ 
  include 'connection.php';
    include 'custheader.php'; ?>
    <script src="validation/billview.js"></script>
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
        <div class="row justify-content-center align-items-center"><h2 style="text-align: center;color: white;">Bill Details</h2>
          <div class="col-md-8 col-lg-7">
          		
          	<form role="form" method="post" action="viewbill.php" name="myform">
			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			               				<input type="text" name="conno" class="form-control input-sm" placeholder="Consumer Number" id="pincode" onkeyup="distPin()">
                  <span style="color: red;font-size: 14px" id="f8"></span>
 
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="text" name="phno"  class="form-control input-sm" placeholder="Phone Number" id="phone" onkeyup="phoneUser()">
                  <span style="color: red;font-size: 14px" id="f5"></span>

			    					</div>
			    				</div>
			    			</div>

			    			
			    			<input type="submit" value="View Bill" class="btn btn-info btn-block"  onclick="return checkAll()">
			    		
			    		</form>


          </div>
        </div> <!-- / .row -->
      </div> <!-- / .container -->
<br><br><br>
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