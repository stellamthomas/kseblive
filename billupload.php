<?php 
    include 'mainheader.php';
?>
<style>
.textb{
  width: 17%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  margin-left: 300px;
  box-sizing: border-box;
}

.sub {
  width: 34.2%;
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  margin-top: 10px;
  margin-left: 620px;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}
input[type="date"]:before {
    content: attr(placeholder) !important;
  }
  
</style>
   <h1 style="font-size: 25px;padding-top: 110px;margin-left: 848px;">Upload Bill Details</h1>
    <form action="/action_page.php" style="margin-top: 60px;">
        <input  class="textb" type="text" name="conno" placeholder="Consumer Number" style="margin-left: 620px;">
        <input  class="textb" type="date" name="curdate" placeholder="Bill Generated Date &nbsp;" style="margin-left: 0px;">

        <input  class="textb" type="text" name="totunits" placeholder="Total Units Used" style="margin-left: 620px;">
        <input  class="textb" type="text" name="amount" placeholder="Amount" style="margin-left: 0px;">

        <input  class="textb" type="date" name="lastdate" placeholder="Payment without fine date &nbsp;" style="margin-left: 620px;">
        <input  class="textb" type="date" name="finedate" placeholder="Payment with fine date &nbsp;" style="margin-left: 0px;">

        <input class="sub"  type="submit" value="Generate Bill">
    </form>


    <div class="counter01" style="margin-top: 445px;">
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