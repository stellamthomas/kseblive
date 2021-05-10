<?php
session_start();
if(isset($_COOKIE['logined']) && $_COOKIE['logined']==1)
  {
  include 'custheader.php';
  include 'connection.php';

  $flag=0;
  $appid = $_POST['appid'];
  $phno = $_POST['phno'];
  $sql="select * from tb_connectionreg where filekey='".$appid."' and phno='".$phno."'";

  $result = mysqli_query($conn,$sql);
  while ($row=mysqli_fetch_array($result))
  {
    $flag=1;
  }

?>

      <section class="section section-top section-full">

      <!-- Cover -->
      <div class="bg-cover" style="background-image: url(assets/img/bbb.jpg);"></div>
<br><br>
      <!-- Overlay -->
      <div class="bg-overlay"></div>



      <!-- Content -->
      <div class="container">
        <div class="row justify-content-center align-items-center"><h2 style="text-align: center;color: white;">Connection Status</h2>
          <div class="col-md-8 col-lg-7">

<?php if($flag==1){ ?>
<table class="table table-sm" style="color: white;width: 100%;">

              <thead>
                <tr>
                  <th scope="col">Date</th>
                  <th scope="col">Name</th>
                  <th scope="col">Email</th>
                   <th scope="col">Status</th>
                  <th scope="col">Details</th>

                </tr>
              </thead>
        <?php
        $result = mysqli_query($conn,$sql);
        while ($row=mysqli_fetch_array($result))
              { ?>
              <tbody>
                <tr>
                  <td><?php echo $row['curdate']; ?></td>
                  <td><?php echo $row['fname']." ".$row['lname']; ?></td>
                  <td><?php echo $row['email']; ?></td>
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
       window.location.replace(\"connectionstatus.php\");
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
        <h5 class="modal-title" id="exampleModalLongTitle" style="color: green;font-size:30px;">Connection Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body"> <?php
      $result = mysqli_query($conn,$sql);
      while ($row=mysqli_fetch_array($result))
            { ?>
        <b>Date : </b><?php echo $row['curdate']; ?><br>
        <b>Application ID : </b><?php echo $row['filekey']; ?><br>
        <b>Name : </b><?php echo $row['fname']." ".$row['lname']; ?><br>
        <b>Address : </b><?php echo $row['address']; ?><br>
        <b>Gender : </b><?php echo $row['gender']; ?><br>
        <b>District : </b><?php echo $row['district']; ?><br>
        <b>Pincode : </b><?php echo $row['pincode']; ?><br>
        <b>Section : </b><?php echo $row['section']; ?><br>
        <b>Supply Type : </b><?php echo $row['supplytype']; ?><br>
        <b>Total Loads : </b><?php echo $row['totalloads']; ?><br>
        <b>Category : </b><?php echo $row['category']; ?><br>
        <b>Aadhar Number : </b><?php echo $row['aadhar']; ?><br>
        <b><font color="red">Feedback : <?php   if($row['feedback']=='')
            echo "No feedback provided";
          else
            echo $row['feedback'];



      } ?></font></b>
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
  }
  else
  {
    Header("location:index.php");
  }
?>