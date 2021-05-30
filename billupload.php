<?php
session_start();
if(isset($_SESSION['logined']) && $_SESSION['logined']==1)
{ 
  include 'custheader.php'; 
  include 'connection.php';
  $loginid = $_COOKIE['lkey'];

  $flag=0;
  $sql="select * from tb_login where id='".$loginid."'";
  $result = mysqli_query($conn,$sql);
  while ($row=mysqli_fetch_array($result))
  {
    $email=$row['username'];
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
        <div class="row justify-content-center align-items-center"><h2 style="text-align: center;color: white;">Pending Bill Uploads</h2>
          <div class="col-md-8 col-lg-7">
                       
<table class="table table-sm" style="color: white;width: 100%;text-align: center;">

              <thead>
                <tr>
                  <th scope="col">Date</th>
                  <th scope="col">Status</th>
                  <th scope="col">Link</th>
                </tr>
              </thead>
        <?php
          $sql="select * from tb_noncontactbill where username='".$email."' order by conbillid desc";
          //echo $sql;exit;
        $result = mysqli_query($conn,$sql);      
        while ($row=mysqli_fetch_array($result))
              { ?>
              <tbody>
                <tr>
                  <td><img src="newnotify.jpg" width="30" height="30">&nbsp;&nbsp;<?php echo $row['curdate']; ?></td>
                  <td><?php 
$s=$row['constatus'];
if($s==0)
{
  echo "<font color='violet'><b>Upload Pending</b></font>";
}
else if($s==2)
{
  echo "<font color='violet'><b>Uploaded</b></font>";
}
else if($s==1)
{
  echo "<font color='red'><b>Rejected</b></font>";
}
else
{
  echo "<font color='green'><b>Approved</b></font>";
}
?></td>
<td><?php 
$s=$row['constatus'];
if($s==0)
{ ?>
  <a href="addbill.php?t=<?php echo $row['conbillkey'] ?>"><button class="btn btn-sm btn-danger">Upload</button></a>
<?php }
else
{
  echo "<font color='green'><b>-- NA --</b></font>";
}
?></td>
   </tr>
              </tbody>
       <?php       } ?>
            </table> 


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