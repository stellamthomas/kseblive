<?php
  session_start();
	include 'connection.php';

  $engkey = $_GET['t'];
	$sql = "select loginid from tb_linemanreg where lmkey='".$engkey."'";
	$ex1=mysqli_query($conn,$sql);

	while ($row=mysqli_fetch_array($ex1))
	{
		$id=$row['loginid'];
	}
	$status =0;

  $sql2 = "update tb_login set delstatus='".$status."' where id='".$id."'";
  $ex2=mysqli_query($conn,$sql2);

  if($ex2)
	{
    echo "<SCRIPT type='text/javascript'>alert('Lineman Details Activated');window.location.replace(\"viewlineman.php\"); </SCRIPT>";
	}
	else
	{
    echo "<SCRIPT type='text/javascript'>alert('Lineman Details Not Activated');window.location.replace(\"viewlineman.php\");</SCRIPT>";
  }

?>
