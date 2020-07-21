<?php 
    include 'mainheader.php';
?>
<style>
.textb{
  width: 25%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  margin-left: 710px;
  box-sizing: border-box;
}

.sub {
  width: 25%;
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  margin-left: 710px;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}
</style>
   <h1 style="font-size: 25px;padding-top: 100px;margin-left: 880px;"> Bill Details</h1>
    <form action="/action_page.php" style="margin-top: 250px;">
        <input  class="textb" type="text" id="fname" name="firstname" placeholder="Consumer Number"><br>
        <input class="textb" type="text" id="fname" name="firstname" placeholder="Phone Number"><br>
        <input class="sub"  type="submit" value="View Bill">
    </form>





    <div class="counter01" style="margin-top: 300px;">
				<p>Visit Counter: <span id="counter" class="numcu" >139804426</span> (Since Today)</p>
			</div>
			<!-- banner end -->

			<!-- footer section start -->
			<footer class="site-footer">
				<div class="inner_wrap">	</div>
				<h4>Content owned, updated and maintained by Kerala Electricity Board, Ministry of Power,Government of Kerala.<br> KSEBLive is designed and developed by Stella M Thomas 2020 &copy;</h4>
			</footer>
		</div>
		<!-- footer section end -->	
	</body>
</html>