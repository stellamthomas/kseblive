<?php
  session_start();
	include 'connection.php';

  $filekey = $_GET['t'];
  $status=4;
	$_SESSION["filekey"] = $filekey;
  $conno=rand(10000000000000,2000000000000);

  $sql2 = "update tb_connectionreg set status='".$status."',feedback='Approved - Consumer# Generated',conno='".$conno."' where filekey='".$filekey."'";
  $ex2=mysqli_query($conn,$sql2);

  if($ex2)
	{
    echo "<SCRIPT type='text/javascript'>alert('Application Approved');window.location.replace(\"newconnectionmail.php\"); </SCRIPT>";
	}
	else
	{
    echo "<SCRIPT type='text/javascript'>alert('Application Rejected.');window.location.replace(\"viewrequests.php\");</SCRIPT>";
  }

?>
