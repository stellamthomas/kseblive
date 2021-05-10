<?php

  include 'custheader.php';
  include 'connection.php';

  $flag=0;
  $trid = $_POST['comid'];
  $phno = $_POST['phno'];
  $sql="select * from tb_complaints where trackid='".$trid."' and phno='".$phno."'";

  $result = mysqli_query($conn,$sql);
  while ($row=mysqli_fetch_array($result))
  {
    $flag=1;
  }

?>

      <section class="section section-top section-full">

      <!-- Cover -->
      <div class="bg-cover" style="background-image: url(assets/img/aa.jpg);"></div>
<br><br>
      <!-- Overlay -->
      <div class="bg-overlay"></div>



      <!-- Content -->
      <div class="container">
        <div class="row justify-content-center align-items-center"><h2 style="text-align: center;color: white;">Complaint Status</h2>
          <div class="col-md-8 col-lg-7">

<?php if($flag==1){ ?>
<table class="table table-sm" style="color: white;width: 100%;">
<?php
        $result = mysqli_query($conn,$sql);
        while ($row=mysqli_fetch_array($result))
              { $cutype=$row['cutype']; ?>
              <thead>
                <tr>

                  <th scope="col">Date</th>
        <?php if($cutype!=2){ ?>          <th scope="col">Name</th> <?php } ?>
                  <th scope="col">Type</th>
                   <th scope="col">Status</th>
                  <th scope="col">Details</th>

                </tr>
              </thead>
        
              <tbody>
                <tr>
                  <td><?php echo $row['curdate']; ?></td>
           <?php if($cutype!=2){ ?>        <td><?php echo $row['name']; ?></td> <?php } ?>
                  <td><?php echo $row['comtype']; ?></td>
                  <td><?php if($row['status']=='0')
                  {
                    echo "Not viewed";
                  }
                  else
                  {
                    echo "Viewed";
                  } ?></td>
                  <td><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalCenter">More
</button><td>

                </tr>
              </tbody>
       <?php       } ?>
            </table> <?php }
else {    echo "<SCRIPT type='text/javascript'>alert('No data found...');
       window.location.replace(\"complaintreg.php\");
       </SCRIPT>";     }?>


<br><br>

          </div>
        </div> <!-- / .row -->
      </div> <!-- / .container -->
<br><br>
    </section>

   <!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle" style="color: green;font-size:30px;">Complaint Feedback</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <?php
        $result = mysqli_query($conn,$sql);
        while ($row=mysqli_fetch_array($result))
              {
                if($row['feedback']=='')
                  echo "No feedback provided";
                else
                  echo $row['feedback'];
      } ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!-- <button type="Submit" class="btn btn-primary">Pay Online</button> -->
      </div>
    </div>
  </div>
</div>

    <!-- SECTIONS -->
<?php
    include 'mainfooter.php';
?>
