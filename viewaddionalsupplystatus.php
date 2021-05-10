<?php
  session_start();
if(isset($_COOKIE['logined']) && $_COOKIE['logined']==1)
{
  include 'custheader.php'; 
  include 'connection.php';
  $loginid = $_COOKIE['lkey'];

  $flag=0;
  $sql="select * from tb_addsupplyrequest where loginid='".$loginid."' order by supid desc";// echo $sql;exit;

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
        <div class="row justify-content-center align-items-center"><h2 style="text-align: center;color: white;">Additional Supply Status</h2>
          <div class="col-md-8 col-lg-7">
              
<?php if($flag==1){ ?>           
<table class="table table-sm" style="color: white;width: 100%;">

              <thead>
                <tr>
                  <th scope="col">Date</th>
                  <th scope="col">Consumer #</th>
                  <th scope="col">Purpose</th>
                  <th scope="col">Amount</th
                  <th scope="col">Status</th>
                  <th scope="col">Links</th>
                </tr>
              </thead>
        <?php
        $result = mysqli_query($conn,$sql);      
        while ($row=mysqli_fetch_array($result))
              { ?>
              <tbody>
                <tr>
                  <td><?php echo $row['supdate']; ?></td>
                  <td><?php echo $row['supconno']; ?></td>
                  <td><?php echo $row['suppurpose']; ?></td>
                  <td><?php echo $row['total']; ?></td>
                  <td><?php 

                  $t=$row['supstatus'];
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
          <?php  $t=$row['suppaymentstatus'];
          if($temp==1){
                  if($t==0){ ?>
                     <a href="billpiy/index.php?t=<?php echo $row['supkey']; ?>" style="text-decoration: none;">  <button class="btn btn-primary btn-sm">Pay</button></a>
              <?php     } 



              if($t==1){ ?>
                     <a href="fpdf/additionalsupply.php?t=<?php echo $row['supkey']; ?>" style="text-decoration: none;" download>  <button class="btn btn-success btn-sm">Print</button></a>
              <?php     } }
              else
                { ?>

<font color="red"><b>Not Available</b></font>

               <?php }
                ?>


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