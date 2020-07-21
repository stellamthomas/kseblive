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
</style>
   <h1 style="font-size: 25px;padding-top: 110px;margin-left: 860px;">Post Feedback</h1>
    <form action="/action_page.php" style="margin-top: 60px;">
        
        <textarea rows="25" cols="25" name="notify" class="textb" style="margin-left: 620px;width: 34.2%;" placeholder="Enter your feedback here..."></textarea>

        <input class="sub"  type="submit" value="Send Feedback">
    </form>

    <div class="counter01" style="margin-top: 280px;">
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