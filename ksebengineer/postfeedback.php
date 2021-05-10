<?php
  session_start();
	include 'connection.php';

  $filekey = $_GET['t'];
  $status=2;
  $feedback = $_POST['feedback'];

  $sql2 = "update tb_connectionreg set feedback='".$feedback."',status='".$status."' where filekey='".$filekey."'";
  $ex2=mysqli_query($conn,$sql2);

  if($ex2)
	{
    echo "<SCRIPT type='text/javascript'>alert('Feedback Posted');window.location.replace(\"viewrequests.php\"); </SCRIPT>";
	}
	else
	{
    echo "<SCRIPT type='text/javascript'>alert('Feedback Posting Failed');window.location.replace(\"viewrequests.php\");</SCRIPT>";
  }

?>
