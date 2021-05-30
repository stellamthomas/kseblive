<?php
session_start();
if(isset($_SESSION['logined']) && $_SESSION['logined']==1)
{ 
    include 'connection.php';
    include 'engheader.php'; 
    $filekey = $_GET['t'];
?>
<script type="text/javascript">
    function purpUserz() {
        var f20z = document.getElementById("f20z");
        var purposez = document.getElementById('purposez').value;

        if (!/^[#.0-9a-zA-Z\s,-]{10,50}$/.test(purposez))
         {
           f20z.textContent = "**Invalid Feedback, Minimum 10 Characters";
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
        if(purpUserz())
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
                <h6 class="m-0 font-weight-bold text-primary">Feedback Query</h6>
            </div>
            <div class="card-body" >
                <form role="form" action="postcompfeed.php?t=<?php echo $filekey; ?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <textarea rows="10" name="feedback" class="form-control input-sm" placeholder="Enter your feedback here." id="purposez" onkeyup="purpUserz()"></textarea>
                    <span style="color: red;font-size: 14px" id="f20z"></span>
                   
                </div>
            <input type="submit" value="Post Feedback" class="btn btn-info btn-block"  onclick="return checkAllsz()">

            </form>
            </div>
        </div>
    </div>
<!-- /.container-fluid -->
<?php include 'engfooter.php'; }
  else
  {
    Header("location:../index.php");
  }
?>