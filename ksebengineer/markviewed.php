<?php
  session_start();
	include 'connection.php';

  $filekey = $_GET['t'];
  $status=1;
	

  $sql2 = "update tb_connectionreg set status='".$status."' where filekey='".$filekey."'";
  $ex2=mysqli_query($conn,$sql2);

  if($ex2)
	{
    echo "<SCRIPT type='text/javascript'>alert('Application marked as viewed');window.location.replace(\"viewrequests.php\"); </SCRIPT>";
	}
	else
	{
    echo "<SCRIPT type='text/javascript'>alert('Application marked as viewed failed	 .');window.location.replace(\"viewrequests.php\");</SCRIPT>";
  }

?>
