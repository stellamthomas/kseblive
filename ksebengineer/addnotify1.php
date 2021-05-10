<?php
  session_start();
	include 'connection.php';

  $filekey = $_GET['t'];
  $status=1;
  $feedback = $_POST['feedback'];

  $sql2 = "update tb_complaints set feedback='".$feedback."',status='".$status."' where trackid='".$filekey."'";
  $ex2=mysqli_query($conn,$sql2);
  
  if($ex2)
	{
    echo "<SCRIPT type='text/javascript'>alert('Feedback Posted');window.location.replace(\"viewcomplaints.php\"); </SCRIPT>";
	}
	else
	{
    echo "<SCRIPT type='text/javascript'>alert('Feedback Posting Failed');window.location.replace(\"viewcomplaints.php\");</SCRIPT>";
  }

?>
