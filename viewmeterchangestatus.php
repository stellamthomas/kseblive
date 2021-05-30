<?php
session_start();
if(isset($_SESSION['logined']) && $_SESSION['logined']==1)
{ 
  include 'connection.php';
  include 'custheader.php'; 
  $loginid = $_COOKIE['lkey'];

  $flag=0;
  $sql="select * from tb_meterchangerequest where loginid='".$loginid."' and delstatus='1'";

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
        <div class="row justify-content-center align-items-center"><h2 style="text-align: center;color: white;">Meter Change Status</h2>
          <div class="col-md-8 col-lg-7">
              
<?php if($flag==1){ ?>           
<table class="table table-sm" style="color: white;width: 100%;">

              <thead>
                <tr>
                  <th scope="col">Date</th>
                  <th scope="col">Consumer #</th>
                  <th scope="col">Reason</th>
                  <th scope="col">Status</th>
                  <th scope="col">More Links</th>
                </tr>
              </thead>
        <?php
        $result = mysqli_query($conn,$sql);      
        while ($row=mysqli_fetch_array($result))
              { ?>
              <tbody>
                <tr>
                  <td><?php echo $row['mdate']; ?></td>
                  <td><?php echo $row['mconno']; ?></td>
                  <td><?php echo $row['mpurpose']; ?></td>
                  <td><?php 

                  $t=$row['mstatus'];
                  $temp=$t;
                  if($t==0){ ?>
                     <font color="grey"><b>Not Viewed</b></font>
              <?php     }  
              if($t==1){ ?>
                     <font color="green"><b>Approved</b></font>
              <?php     }  
              if($t==2){ ?>
                     <font color="red"><b>Rejected</b></font>
              <?php     }   ?>

                  </td>
                  <td>
<?php if($t==0){ ?>
                    <a href="deletemeterchange.php?t=<?php echo $row['mkey']; ?>" ><button type="button" class="btn btn-danger btn-sm">Delete</button></a>  <?php } 
                    else {?>

<font color="blue"><b>Not Available</b></font>
                    <?php } ?>


                  </td>
                </tr>
              </tbody>
       <?php       } ?>




            </table> 







          <?php } 
else {    echo "<SCRIPT type='text/javascript'>alert('No Requests Found');
       window.location.replace(\"customerhome.php\");
       </SCRIPT>";     }?>


<br><br>

          </div>
        </div> <!-- / .row -->
      </div> <!-- / .container -->
<br><br>
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