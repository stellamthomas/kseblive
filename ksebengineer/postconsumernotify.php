<?php
  session_start();
	include 'connection.php';
  $lkey = $_COOKIE['lkey'];

  $k1=md5(microtime());
  $filekey=substr($k1,0,8);

  $notify=$_POST['feedback'];
  $conno=$_POST['conno'];

  $isview = 1;
  $curdate = date('d-m-y');

  $feedback = $_POST['feedback'];

  $sql2 = "insert into tb_connotify(connotkey,connotdesc,connotdate,conno,loginid) values ('".$filekey."','".$notify."','".$curdate."','".$conno."','".$lkey."')";//echo $sql2;exit;
  $ex2=mysqli_query($conn,$sql2);
  
  if($ex2)
	{
    echo "<SCRIPT type='text/javascript'>alert('Consumer Notification Mailed Successfully');window.location.replace(\"connotifymail.php?t=$filekey\"); </SCRIPT>";
	}
	else
	{
    echo "<SCRIPT type='text/javascript'>alert('Consumer Notification Mail Failed');window.location.replace(\"consumernotify.php\");</SCRIPT>";
  }

?>
