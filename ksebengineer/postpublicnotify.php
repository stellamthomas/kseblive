<?php
  session_start();
	include 'connection.php';
  $lkey = $_COOKIE['lkey'];

  $k1=md5(microtime());
  $filekey=substr($k1,0,8);
  $notify=$_POST['feedback'];
  $notstatus=$_POST['typestatus'];

  $isview = 1;
  $curdate = date('d-m-y');

  $feedback = $_POST['feedback'];

  $sql2 = "insert into tb_notify(notkey,notdesc,notdate,notstatus,isview,loginid) values ('".$filekey."','".$notify."','".$curdate."','".$notstatus."','".$isview."','".$lkey."')"; //echo $sql2;exit;
  $ex2=mysqli_query($conn,$sql2);
  
  if($ex2)
	{
    echo "<SCRIPT type='text/javascript'>alert('Public Notification Posted');window.location.replace(\"viewpublicnotify.php\"); </SCRIPT>";
	}
	else
	{
    echo "<SCRIPT type='text/javascript'>alert('Public Notification Posting Failed');window.location.replace(\"viewpublicnotify.php\");</SCRIPT>";
  }

?>
