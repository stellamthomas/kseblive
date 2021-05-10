<?php
  session_start();
  include 'connection.php';

  $name = $_POST['fname'];
  $section = $_POST['section'];
  $conno = $_POST['conno'];
  $phno = $_POST['phno'];
  $desc = $_POST['comdesc'];
  $fdate = $_POST['fdate']; 
  $tdate = $_POST['tdate'];
  $tdays = $_POST['tdays'];

  
  $status = 0;
  $paystatus = 0;
  $k1=md5(microtime());
  $k2=substr($k1,0,8);


  $sql1="insert into tb_addsupplyrequest
  (supname,supconno,supsection,supphno,suppurpose,supstatus,suppaymentstatus,supdate,fdate,tdate,tdays,loginid,supkey) 
  values 
  ('".$name."','".$conno."','".$section."','".$phno."','".$desc."','".$status."','".$paystatus."','".date('Y-m-d')."','".$fdate."','".$tdate."','".$tdays."','".$_COOKIE['lkey']."','".$k2."')";
  $ex1=mysqli_query($conn,$sql1);

  if($ex1)
  {
    echo "<SCRIPT type='text/javascript'>alert('Additional Supply Registration Successfull');
     window.location.replace(\"customerhome.php\");
     </SCRIPT>";
  }
  else
  {
    echo "<SCRIPT type='text/javascript'>alert('Additional Supply Registration Failed');
     window.location.replace(\"addsupplyrequest.php\");
     </SCRIPT>";
  }

?>
