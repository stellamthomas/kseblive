<?php
session_start();
if(isset($_SESSION['logined']) && $_SESSION['logined']==1)
{ 
    include 'connection.php';
    include 'engheader.php';
    $sql = "select * from tb_connectionreg where conno!='NULL' and loginid='".$_COOKIE['lkey']."'"; //echo $sql;exit;
  $result = mysqli_query($conn,$sql);
?>
<script type="text/javascript">
    function distUser() {

        var f7 = document.getElementById("f7");
        var district = document.getElementById('district').value;

        if(district=="null")
         {
           f7.textContent = "**Select any Consumer Name";
           document.getElementById("district").focus();
           return false;
         }
         else
         {
            f7.textContent = "";
            return true;
         }
    }

    function purpUserz() {
        var f20z = document.getElementById("f20z");
        var purposez = document.getElementById('purposez').value;

        if (!/^[#.0-9a-zA-Z\s,-]{3,50}$/.test(purposez))
         {
           f20z.textContent = "**Invalid Notification Content";
           document.getElementById("purposez").focus();
           return false;
         }
         else
         {
            f20z.textContent = "";
            return true;
         }
    }

    function checkAllsz(){
        if(distUser()&&purpUserz())
         {
           return true;
         }
         else
         {
            return false;
         }
    }
</script>
        <!-- Begin Page Content -->
        <div class="container-fluid">

           

            <!-- DataTales Example -->
            <div class="card shadow mb-4">

            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Consumer Specific Notification - Email</h6>
            </div>
            <div class="card-body" >
                <form role="form" action="postconsumernotify.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <div class="form-group">
                                                    <select class="form-control bfh-states" data-country="US" data-state="CA" name="conno" id="district" onclick="distUser()">
                                                        <option value="null">Select Consumer Number</option>
                                 <?php while ($row=mysqli_fetch_array($result))
                      {  ?>
                                                        <option value="<?php echo $row['conno']; ?>"><?php echo $row['conno']." - ".$row['fname']." ".$row['lname']." - ".$row['address']; ?></option>
                    <?php } ?>
                                                    </select>
<span style="color: red;font-size: 14px" id="f7"></span>

                                                </div>
                    <textarea rows="10" name="feedback" class="form-control input-sm" placeholder="Enter your public notification here..." id="purposez" onkeyup="purpUserz()"></textarea>
                    <span style="color: red;font-size: 14px" id="f20z"></span>

                   
                </div>
            <input type="submit" value="Send Notification Mail" class="btn btn-info btn-block" onclick="return checkAllsz()">

            </form>
            </div>
        </div>
    </div>
<!-- /.container-fluid -->
<?php include 'engfooter.php';  }
  else
  {
  Header("location:../index.php");
  }
?>