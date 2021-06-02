<?php
session_start();
if(isset($_SESSION['logined']) && $_SESSION['logined']==1)
{ 
    include 'connection.php';
    include 'engheader.php';
?>
<script type="text/javascript">
    function distUser() {

        var f7 = document.getElementById("f7");
        var district = document.getElementById('district').value;

        if(district=="null")
         {
           f7.textContent = "**Select any Notification User Type";
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

        if (!/^[#.0-9a-zA-Z\s,-]{3,200}$/.test(purposez))
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
                <h6 class="m-0 font-weight-bold text-primary">Public And Consumer Notification</h6>
            </div>
            <div class="card-body" >
                <form role="form" action="postpublicnotify.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <div class="form-group">
                        <select class="form-control bfh-states" data-country="US" data-state="CA" name="typestatus" id="district" onclick="distUser()">
                            <option value="null">Notification Type</option>
                            <option value="0">Public</option>
                            <option value="1">Consumer</option>
                            <option value="2">Staffs</option>
                        </select>
                        <span style="color: red;font-size: 14px" id="f7"></span>
                    </div>
                    <textarea rows="10" name="feedback" class="form-control input-sm" placeholder="Enter your public notification here..." id="purposez" onkeyup="purpUserz()"></textarea>
                    <span style="color: red;font-size: 14px" id="f20z"></span>
                   
                </div>
            <input type="submit" value="Post Notification" class="btn btn-info btn-block" onclick="return checkAllsz()">

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