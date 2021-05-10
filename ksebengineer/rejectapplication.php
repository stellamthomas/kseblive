<?php
  session_start();
	include 'connection.php';

  $filekey = $_GET['t'];
  $status=5;
	

  $sql2 = "update tb_connectionreg set status='".$status."',feedback='".$_POST['feedback']."' where filekey='".$filekey."'";
  $ex2=mysqli_query($conn,$sql2);

  if($ex2)
	{
    echo "<SCRIPT type='text/javascript'>alert('Application Rejected');window.location.replace(\"viewrequests.php\"); </SCRIPT>";
	}
	else
	{
    echo "<SCRIPT type='text/javascript'>alert('Application Rejected Failed.');window.location.replace(\"viewrequests.php\");</SCRIPT>";
  }

?>
