<?php
session_start();
include 'connection.php';

if(isset($_COOKIE['logined']) && $_COOKIE['logined']==1)
{
    include 'custheader.php'; ?>

      <section class="section section-top section-full">

      <!-- Cover -->
      <div class="bg-cover" style="background-image: url(assets/img/bbb.jpg);"></div>
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

          	<form role="form" action="viewconnectionstatus.php" method="post" name="myform">
			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			               				<input type="text" name="appid" class="form-control input-sm" placeholder="Application ID">
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			               				<input type="text" name="phno" class="form-control input-sm" placeholder="Phone Number">
			    					</div>
			    				</div>

			    			</div>


			    			<input type="submit" value="Check Status" class="btn btn-info btn-block" onclick="return checkNewconn()">

			    		</form>


          </div>
        </div> <!-- / .row -->
      </div> <!-- / .container -->
<br>
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
