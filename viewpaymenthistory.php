<?php
session_start();
if(isset($_SESSION['logined']) && $_SESSION['logined']==1)
{ 
  include 'connection.php';
  include 'custheader.php'; 
  $loginid = $_COOKIE['lkey'];

  $flag=0;
  $sql="select * from tb_billpayreport inner join tb_bill on tb_billpayreport.paybillkey=tb_bill.billkey where tb_billpayreport.loginid='".$loginid."'"; 

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
        <div class="row justify-content-center align-items-center"><h2 style="text-align: center;color: white;">Transaction History</h2>
          <div class="col-md-8 col-lg-7">
              
<?php if($flag==1){ ?>           
<table class="table table-sm" style="color: white;width: 100%;">

              <thead>
                <tr>
                  <th scope="col">Date</th>
                  <th scope="col">Consumer #</th>
                  <th scope="col">Phone #</th>
                  <th scope="col">Bill Date</th>
                  <th scope="col">Amount</th>
                   <th scope="col">Transaction ID</th>
                </tr>
              </thead>
        <?php
        $result = mysqli_query($conn,$sql);      
        while ($row=mysqli_fetch_array($result))
              { ?>
              <tbody>
                <tr>
                  <td><?php echo $row['paydate']; ?></td>
                  <td><?php echo $row['payconno']; ?></td>
                  <td><?php echo $row['payphno']; ?></td>
                  <td><?php echo $row['billdate']; ?></td>
                  <td><?php echo $row['payamt']; ?></td>
                  <td><?php echo $row['paybillkey']; ?></td>
                </tr>
              </tbody>
       <?php       } ?>
            </table> <?php } 
else {    echo "<SCRIPT type='text/javascript'>alert('No data found...');
       window.location.replace(\"customerhome.php\");
       </SCRIPT>";     }?>


<br><br>

          </div>
        </div> <!-- / .row -->
      </div> <!-- / .container -->
<br><br>
    </section>
<?php
        $result = mysqli_query($conn,$sql);      
        while ($row=mysqli_fetch_array($result))
              { ?>  
   <!-- Modal -->
<div class="modal fade" id="exampleModalCenter<?php echo $row['id'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle" style="color: green;">Bill Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         
        <b>Bill Date :</b> <?php echo $row['billdate']; ?> <br>
        <b>Due Date :</b> <?php echo $row['duedate']; ?> <br>
        <b>DC Date :</b> <?php echo $row['dcdate']; ?> <br>
        <b>Initial Reading :</b> <?php echo $row['initialread']; ?> <br>
        <b>Final Reading :</b> <?php echo $row['finalread']; ?> <br>
        <b>Units Used :</b> <?php echo $row['unitsused']; ?> <br>
        <b>Fixed Charge :</b> <?php echo $row['fixedcharge']; ?> <br>
        <b>Energy Charge :</b> <?php echo $row['energycharge']; ?> <br>
        <b>Total Amount :</b> <?php echo $row['total']; ?> <br>
        <b>Consumer Number :</b> <?php echo $row['consumerno']; ?> <br>
        <b>Phone Number :</b> <?php echo $row['phno']; ?> <br>
        <b>Status :</b> <?php if($row['status']=='0')
                  {
                    echo "Not Paid";
                  }
                  else
                  {
                    echo "Paid";
                  } ?> <br>

      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a href="fpdf/toPdfBill.php?conno=<?php echo $conno; ?>&phno=<?php echo $phno ?>" download><button type="button" class="btn btn-info">Print PDF</button></a>
        <?php if($row['status']=='0') {?><a href="billpaycust.php?t=<?php echo $row['billkey'];?>" style="text-decoration: none;">  <button class="btn btn-primary">Pay Online</button></a> <?php } 
        else
        { ?>
          <a href="fpdf/toPdfBillReciept.php?t=<?php echo $row['billkey']; ?>" style="text-decoration: none;" download>  <button class="btn btn-primary">Print Reciept</button></a>
       <?php } ?>
      </div>
    </div>
  </div>
</div>
<?php } ?>

    <!-- SECTIONS -->
    <?php
    include 'mainfooter.php';
  }
  else
  {
	Header("location:index.php");
  }
?>