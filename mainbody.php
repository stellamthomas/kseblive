  <section class="section section-top section-full">

      <!-- Cover -->
      <div class="bg-cover" style="background-image: url(assets/img/aa.jpg);"></div>

      <!-- Overlay -->
      <div class="bg-overlay"></div>

      <!-- Triangles -->
      <!-- <div class="bg-triangle bg-triangle-light bg-triangle-bottom bg-triangle-left"></div>
      <div class="bg-triangle bg-triangle-light bg-triangle-bottom bg-triangle-right"></div> -->

      <!-- Content -->

      <?php 

        include 'connection.php'; 
        $sql="select * from tb_notify where notstatus='0' and isview='1'";
        $result = mysqli_query($conn,$sql); ?>
     
          
      <div class="container"><h5 style="text-align: left;color: white;">Notifications</h5>

        <marquee>
          <h6 style="color: white;">
  <?php while ($row=mysqli_fetch_array($result))
        {
  ?>
            <font color="pink"><?php echo $row['notdate']." --> "; ?></font><?php echo $row['notdesc']; 
    ?> &nbsp;&nbsp;&nbsp; <?php     }
  ?>

          </h6>
        </marquee>
        



        <div class="row justify-content-center align-items-center">
          <div class="col-md-8 col-lg-7">
            <!-- Preheading -->
            <p class="font-weight-medium text-center text-xs text-uppercase text-white text-muted" data-toggle="animation" data-animation="fadeUp" data-animation-order="0" data-animation-trigger="load">
             
            </p>
            <!-- Heading -->
            <h1 class="text-white text-center mb-4" data-toggle="animation" data-animation="fadeUp" data-animation-order="1" data-animation-trigger="load" style="
    font-size: 25px;">
              Kerala State Electricity Board.
            </h1>

            <!-- Subheading -->
            <p class="lead text-white text-muted text-center mb-5" data-toggle="animation" data-animation="fadeUp" data-animation-order="2" data-animation-trigger="load">
             Kerala State Electricity Board Ltd (KSEBLtd) is a public sector undertaking under the Government of Kerala, India, that generates,transmits and distributes the electricity supply in the state. Established in 1957, the agency comes under the authority of the Department of Power. It has been registered under Indian companies act during January 2011
            </p>

           <p class="text-center mb-0" data-toggle="animation" data-animation="fadeUp" data-animation-order="3" data-animation-trigger="load">
              <a href="billview.php"  class="btn btn-outline-primary text-white">
                Quick Pay
              </a>
            </p>

          </div>
        </div> <!-- / .row -->
      </div> <!-- / .container -->

    </section>

    <!-- SECTIONS -->
