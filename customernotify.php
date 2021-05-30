<?php
session_start();
if(isset($_SESSION['logined']) && $_SESSION['logined']==1)
{ 
  include 'custheader.php'; 
  include 'connection.php';
  $loginid = $_COOKIE['lkey'];

  $flag=0;
  $sql="select * from tb_notify where notstatus='1' and isview='1'"; 

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
        <div class="row justify-content-center align-items-center"><h2 style="text-align: center;color: white;">Notifications</h2>
          <div class="col-md-8 col-lg-7">
              
<?php if($flag==1){ ?>           
<table class="table table-sm" style="color: white;width: 100%;">

              <thead>
                <tr>
                  <th scope="col">Date</th>
                  <th scope="col">Description</th>
                </tr>
              </thead>
        <?php
        $result = mysqli_query($conn,$sql);      
        while ($row=mysqli_fetch_array($result))
              { ?>
              <tbody>
                <tr>
                  <td><img src="newnotify.jpg" width="30" height="30">&nbsp;&nbsp;<?php echo $row['notdate']; ?></td>
                  <td><marquee scrolldelay="150"><?php echo $row['notdesc']; ?></marquee></td>
                </tr>
              </tbody>
       <?php       } ?>
            </table> <?php } 
else {    echo "<SCRIPT type='text/javascript'>alert('No Notifications');
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