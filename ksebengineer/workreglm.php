<?php
  session_start();
 // echo $_COOKIE['lkey'];exit;

	include 'connection.php';
  $sql = "select * from tb_linemanreg where lmkey='".$_POST['staffkey']."'";

  $result = mysqli_query($conn,$sql);
  while ($row=mysqli_fetch_array($result))
  {
    $staffid=$row['loginid'];
  }

	$title = $_POST['title'];
	$address = $_POST['address'];

	$status = 0;
  $curdate = date('d-m-y');

  $engkey=md5(microtime());
  $wrkkey=substr($engkey,0,10);

	$sql2="insert into tb_work(wkkey,wktitle,wkdesc,wkdate,wkstatus,staffid,engid) values
	('".$wrkkey."','".$title."','".$address."','".$curdate."','".$status."','".$staffid."','".$_COOKIE['lkey']."')";
  //echo $sql2;exit;

  $ex2=mysqli_query($conn,$sql2);

  if($ex2)
	{
   echo "<SCRIPT type='text/javascript'>alert('Work Added.');window.location.replace(\"viewassignduty.php\");</SCRIPT>";
	}
	else
	{
    echo "<SCRIPT type='text/javascript'>alert('Registration Failed.');window.location.replace(\"viewstaffs.php\");</SCRIPT>";
  }

?>
