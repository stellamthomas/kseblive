<?php
session_start();
if(isset($_SESSION['logined']) && $_SESSION['logined']==1)
{  include 'engheader.php'; ?>

<script type="text/javascript">
  function firstName() {
    var f1 = document.getElementById("f1");
    var fname = document.getElementById('fname').value;

    if(!/^[A-Za-z. ]{5,50}$/.test(fname))
       {
         f1.textContent = "**Invalid Work Title, Minimum 5 Characters";
         var x = document.getElementById("fname");
         x.focus();
         return false;
       }
       else
       {
        f1.textContent = "";
        return true;
       }
  }

  function lastName() {
    var f2 = document.getElementById("f2");
    var lname = document.getElementById('lname').value;

    if(!/^[A-Za-z. ]{10,50}$/.test(lname))
       {
         f2.textContent = "**Invalid Work Details, Minimum 10 Characters";
         document.getElementById("lname").focus();
         return false;
       }
       else
       {
        f2.textContent = "";
        return true;
       }
  }

function checkNewconn() {

    if(firstName()&&lastName()&&emailUser()&&addrUser()&&phoneUser()&&distUser()&&sectionUser()&&distPin())
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

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Staff Duty Allocation</h1>
                    <p class="mb-4"></p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">

                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Work Details</h6>
                        </div>
                        <div class="card-body" >


                          <form role="form" action="workreg.php" method="post" enctype="multipart/form-data" name="myform">
              			    			

              			    			<div class="form-group">
              			    				<input type="text" name="title"  class="form-control input-sm" placeholder=" Work Title" id="fname" onkeyup="firstName()">
                        <span style="color: red;font-size: 14px" id="f1"></span>

                                <input type="hidden" name="staffkey" value="<?php echo $_GET['t']; ?>">
              			    			</div>
              			    			<div class="form-group">
              			    				<textarea rows="2" name="address" class="form-control input-sm" placeholder="Work Details" id="lname" onkeyup="lastName()"></textarea>
                              <span style="color: red;font-size: 14px" id="f2"></span>

              			    			</div>
                          <input type="submit" value="Add Duty" class="btn btn-info btn-block" onclick="return checkNewconn()" >
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