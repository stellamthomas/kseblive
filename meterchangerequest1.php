<?php
  session_start();
  include 'connection.php';

  $name = $_POST['fname'];
  $section = $_POST['section'];
  $conno = $_POST['conno'];
  $phno = $_POST['phno'];
  $desc = $_POST['comdesc'];
  
  $status = 0;
  $delstatus = 1;
  $k1=md5(microtime());
  $k2=substr($k1,0,8);


  $sql1="insert into tb_meterchangerequest(mname,mconno,msection,mphno,mpurpose,mstatus,mdate,loginid,mkey,delstatus) values ('".$name."','".$conno."','".$section."','".$phno."','".$desc."','".$status."','".date('Y-m-d')."','".$_COOKIE['lkey']."','".$k2."','".$delstatus."')"; 
  $ex1=mysqli_query($conn,$sql1);

  if($ex1)
  {
    echo "<SCRIPT type='text/javascript'>alert('Meter Change Request Registration Successfull');
     window.location.replace(\"viewmeterchangestatus.php\");
     </SCRIPT>";
  }
  else
  {
    echo "<SCRIPT type='text/javascript'>alert('Meter Change Request Registration Failed');
     window.location.replace(\"meterchangerequest.php\");
     </SCRIPT>";
  }

?>
